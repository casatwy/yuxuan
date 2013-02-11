<?php 

class RecordContent extends CController
{
    const OUT_RECORD = 1;
    const IN_RECORD = 2;
    const PLAN = 3;

    public function __construct(){
    }
    
    public function getRecordContent($record_id,$type){
        $recordList = array();
        $condition = "record_id=:record_id";
        $params = array(
            ":record_id" => htmlspecialchars($record_id)
        );

        $recordData = null;
        if($type == self::OUT_RECORD){
            $recordData = DeliveredRecordItem::model()->findAll($condition, $params);
        }else if($type == self::IN_RECORD){
            $recordData = ReceivedRecordItem::model()->findAll($condition, $params);
        }

        $product = null;
        $silk = null;
        foreach($recordData as $recordItem){
            if($recordItem->type == 1){//silk
                $silk = Silk::model()->findByPk($recordItem->item_id);
            }else{//product
                $product = Product::model()->findByPk($recordItem->item_id);
                $silk = Silk::model()->findByPk($product->silk_id);
            }
            $record = array(
                'type' => Type::model()->findByPk($recordItem->type)->name,
                'goods_number' => $recordItem->goods_number, 
                'color_number' => $silk->color_number, 
                'color_name' => $silk->color_name,
                'gang_number' => $silk->gang_number,
                'zhi_count' => $silk->zhi_count,
                'needle_type' => isset($product->needle_type)?$product->needle_type:"无",
                'size' => isset($product->size)?$product->size:"无",
                'weight' => $recordItem->weight,
                'quantity' => $recordItem->quantity
            );
            array_push($recordList, $record);
        }
        return $recordList;
    }

    public function getPlanContent($plan_id){
        $planList = array();
        $condition = "delivered_plan_id=:plan_id";
        $params = array(
            ":plan_id" => htmlspecialchars($plan_id)
        );
        $planData = DeliveredPlanItem::model()->findAll($condition,$params);

        $condition = "name=:name";
        $params = array(
            ":name" => $planData[0]->plan_maker
        );
        $user = Users::model()->find($condition, $params);

        $product = null;
        $silk = null;
        foreach($planData as $planItem){
            $product = Product::model()->findByPk($planItem->product_id);
            $silk = Silk::model()->findByPk($product->silk_id);
            
            $plan = array(
                'plan_id' => $plan_id,
                'provider' => $planItem->provider->name,
                'plan_maker' => $planItem->plan_maker,
                'telephone' => $user->telephone,
                'goods_number' => $planItem->goods_number,
                'color_number' => $silk->color_number,
                'color_name' => $silk->color_name,
                'needle_type' => $product->needle_type,
                'size' => $product->size,
                'type' => $product->getTypeName(),
                'quantity' => $planItem->quantity
            );
            array_push($planList,$plan);
        }
        return $planList;
    }

    public function printInfomation($id,$type){
        $record = null;
        if($type == self::IN_RECORD){
            $record = ReceivedRecord::model()->findByPk($id);
        }elseif($type == self::OUT_RECORD){
            $record = DeliveredRecord::model()->findByPk($id);
        } 

        $condition = "name=:name";
        $params = array(
            ":name" => $record->record_maker,
        );
        $user = Users::model()->find($condition, $params);
        $info = array(
            "type" => $type,
            "record" => $record,
            "user" => $user
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
            $searchCriteria->condition .= " and provider_id=";
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
        if($type == self::OUT_RECORD){
            $searchedRecordList = DeliveredRecordItem::model()->findAll($searchCriteria); 
        }
        if($type == self::IN_RECORD){
            $searchedRecordList = ReceivedRecordItem::model()->findAll($searchCriteria); 
        }
        if($type == self::PLAN){
            $searchedRecordList = DeliveredPlanItem::model()->findAll($searchCriteria); 
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

    public static function getSilkByGoodsNumber($goods_number){
        $condition = "goods_number=:goods_number";
        $params = array(
            ":goods_number" => htmlspecialchars($goods_number)
        );
        $silks = Silk::model()->findAll($condition,$params);
        return $silks;
    }

    public static function getProductByGoodsNumber($goods_number){
        $table = array();
        $condition = "goods_number=:goods_number";
        $params = array(
            ":goods_number" => htmlspecialchars($goods_number)
        );
        $products = Product::model()->findAll($condition,$params);
        foreach($products as $product){
            $table[$product->color_name][] = $product->size;
        }
        return $table;
    }
}
?>
