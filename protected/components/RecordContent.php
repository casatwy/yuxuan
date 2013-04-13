<?php 

class RecordContent extends CController
{
    const PLAN = 3;

    public function __construct(){
    }
    
    public function getRecordContent($record_id,$type){
        $recordList = array();
        $condition = "record_id=:record_id";
        $params = array(
            ":record_id" => htmlspecialchars($record_id)
        );

        $recordItemList = new RecordItem($type);
        $recordData = $recordItemList->findAll($condition, $params);

        $product = null;
        $recordType = null;
        foreach($recordData as $recordItem){
            if($recordItem->type == Record::SILK){
                $product = Silk::model()->findByPk($recordItem->product_id);
                $recordType = "毛纱";
            }else{
                $product = Product::model()->findByPk($recordItem->product_id);
                $recordType = "成品";
            }

            $gang_number = "无";
            if(isset($product->gang_number)){
                $gang_number = $product->gang_number;
            }

            $record = array(
                'recordType' => $recordType,
                'type' => $recordItem->type,
                'goods_number' => $recordItem->goods_number, 
                'color_number' => $product->color_number, 
                'color_name' => $product->color_name,
                'gang_number' => $gang_number,
                'needle_type' => isset($product->needle_type)?$product->needle_type:"无",
                'size' => isset($product->size)?$product->size:"无",
                'weight' => $recordItem->weight,
                'actural_weight' => $recordItem->actural_weight,
                'count' => isset($product->size)?$recordItem->count:"无",
                'product_type' => ($recordItem->type == Record::SILK)?"毛纱":$product->getPartName(),
            );
            array_push($recordList, $record);
        }
        return $recordList;
    }

    public function printInfomation($id,$type){
        $record = new Record($type);
        $record = $record->findByPk($id);

        $condition = "name=:name";
        $params = array(
            ":name" => $record->getMaker(),
        );
        $user = User::model()->find($condition, $params);
        $info = array(
            "type" => $type,
            "record" => $record,
            "user" => $record->getUser(),
        );
        return $info;
    }

    public static function getDailyData($product_id){
        $product = Product::model()->findByPk($product_id);
        $silk = Silk::model()->findByPk($product->silk_id);
        $finished_sum = DailyProduct::getFinishedSum($product_id);
        $dailyData = array(
            'finished_sum' => $finished_sum['finished'],
            'total_count' => $product->total_count,
            'type' => $product->getTypeName(),
            'diaoxian' => $product->diaoxian,
            'goods_number' => $product->goods_number,
            'color_number' => $silk->color_number,
            'needle_type' => $product->needle_type,
            'color_name' => $silk->color_name,
            'size' => $product->size,
        );
        return $dailyData;
    }

    public static function getCriteria($data, $type){
        $criteria = new CDbCriteria();
        $criteria->order = "id desc";

        $searchCriteria = new CDbCriteria();
        $searchCriteria->distinct = true;
        $searchCriteria->select = "record_id";
        if($type == self::PLAN){
            $searchCriteria->select = "delivered_plan_id";
        }
        $searchCriteria->condition = "1=1";

        $recordIdList = array();
        if(!empty($data['goodsNumber'])){
            $searchCriteria->condition .= " and goods_number=";
            $searchCriteria->condition .= $data['goodsNumber'];
        }

        if(isset($data['providerId']) and $data['providerId'] != 'none'){
            $searchCriteria->condition .= " and client_id=";
            $searchCriteria->condition .= $data['providerId'];
        }

        if(!empty($data["start_time"])){
            $searchCriteria->condition .= " and record_time>";
            $searchCriteria->condition .= self::getTime($data['start_time']);
        }

        if(!empty($data["end_time"])){
            $searchCriteria->condition .= " and record_time<";
            $searchCriteria->condition .= self::getTime($data['end_time']) + 60*60*24;
        }

        $searchedRecordList = null;
        if($type == Record::OUT_RECORD){
            $searchedRecordList = DeliveredRecordItem::model()->findAll($searchCriteria); 
        }
        if($type == Record::IN_RECORD){
            $searchedRecordList = ReceivedRecordItem::model()->findAll($searchCriteria); 
        }
        if($type == self::PLAN){
            $searchedRecordList = DeliveredPlanItem::model()->findAll($searchCriteria); 
        }

        if(is_null($searchedRecordList)){
            $searchedRecordList = array();
        }

        foreach($searchedRecordList as $searchedRecord){
            if($type == self::PLAN){
                array_push($recordIdList, $searchedRecord->delivered_plan_id);
            }else{
                array_push($recordIdList, $searchedRecord->record_id);
            }
        }
        $recordIdList = implode(",", $recordIdList);

        if(empty($recordIdList)){
            $criteria->condition = "1=2";
        }else{
            $criteria->condition = "id in (".$recordIdList.")";
        }

        return $criteria;
    }

    public static function getTime($date){
        $year=((int)substr($date,0,4));
        $month=((int)substr($date,5,2));
        $day=((int)substr($date,8,2));
        return (string)mktime(0,0,0,$month,$day,$year);
    }
}
?>
