<?php

class AjaxStorageController extends Controller
{
    const OUT_RECORD = 1;
    const IN_RECORD = 2;

    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionSaveoutstock(){
        $this->saveRecord(self::OUT_RECORD);
        Yii::app()->end();
    } 

    public function actionSaveinstock(){
        $this->saveRecord(self::IN_RECORD);
        Yii::app()->end();
    }

    public function actionSelectprovider(){
        $providerArray = array();
        $providerList = Client::model()->findAll();

        foreach($providerList as $provider){
            $providerArray[$provider->location] = array();
        }
        foreach($providerList as $provider){
            array_push($providerArray[$provider->location], array(
                'id' => $provider->id,
                'name' => $provider->name,
            ));
        }
        $html = $this->renderPartial("selectProvider", array(
            'providerArray' => $providerArray,
        ));
        echo $html;
        Yii::app()->end();
    }

    private function getItemId($item){
        $silk_id = Silk::findExistSilk($item);
        if(!$silk_id){
            $silk_id = Silk::createNew($item);
        }
        if($item["type"] == 1){
            return $silk_id;
        }

        $product_id = Product::findExistedProduct($item);
        if(!$product_id){
            $product_id = Product::createNew($item, $silk_id);
        }
        return $product_id;
    }

    public function actionSaveprovider(){
        $condition = "name=:name and location=:location;";
        $params = array(
            ":name" => htmlspecialchars($_POST["data"]["providerName"]),
            ":location" => htmlspecialchars($_POST["data"]["providerLocation"]),
        );
        $provider = Client::model()->find($condition, $params);

        if(is_null($provider)){
            $provider = new Client;
            $provider->name = htmlspecialchars($_POST["data"]["providerName"]);
            $provider->location = htmlspecialchars($_POST["data"]["providerLocation"]);
            $provider->save();
        }

        echo CJSON::encode(array(
            'id' => $provider->id,
            'name' => $provider->name,
            'location' => $provider->location,
        ));
        Yii::app()->end();
    }

    private function saveRecord($saveType){
        $record = null;
        if($saveType == self::IN_RECORD){
            $record = new ReceiveRecord;
        }
        if($saveType == self::OUT_RECORD){
            $record = new DeliverRecord;
        }

        $record->record_time = time();
        $record->record_maker = Yii::app()->user->getState('name');
        if($_POST['data'][0]['type'] !== '1' and !isset($_POST['data']['0']['needle_type'])){
            $result = array(
                "success" => 0,
                'msg' => "此页面已经过期，请刷新后重试。",
                'id' => $record->id,
            );
            echo CJSON::encode($result);
            return;
        }
        $record->provider_id = $_POST['data'][0]['provider_id'];
        $record->save();

        foreach($_POST['data'] as $item){
            $recordItem = null;
            if($saveType == self::IN_RECORD){
                $recordItem = new ReceiveRecordItem;
            }
            if($saveType == self::OUT_RECORD){
                $recordItem = new DeliverRecordItem;
            }

            if($item['type'] !== '1' and !isset($item['needle_type'])){
                $record->delete();
                $result = array(
                    "success" => 0,
                    'msg' => "此页面已经过期，请刷新后重试。",
                    'id' => $record->id,
                );
                echo CJSON::encode($result);
                return;
            }
            $recordItem->item_id = $this->getItemId($item);
            $recordItem->type = $item['type'];
            $recordItem->weight = $item['weight'];
            $recordItem->quantity = $item['type'];
            $recordItem->goods_number = $item['goods_number'];
            $recordItem->record_id = $record->id;
            $recordItem->record_time = $record->record_time;
            $recordItem->record_maker = $record->record_maker;
            $recordItem->provider_id = $record->provider_id;

            //storage is also saved in the afterSave() of ReceiveRecordItem.
            if(!$recordItem->save()){
                $record->delete();
            }
        }

        $result = array(
            "success" => 1,
            'type' => $saveType,
            'id' => $record->id,
        );
        echo CJSON::encode($result);
    }

    //based on the record id
    public function actionGetRecordContent(){
        if(isset($_GET['record_id'])){
            $recordContent = new RecordContent();
            $recordList = $recordContent->getRecordContent($_GET['record_id'],$_GET['record_type']);

            //echo "record id is ".htmlspecialchars($_GET['record_id']);
            echo $this->renderPartial("recordContent", array(
                "recordList" => $recordList,
                "record_id" => $_GET['record_id'],
                "record_type" => $_GET['record_type']
            ));
        }
    }

    public function actionSearchRecord(){
        /*
            data:
                goods_number
                recordId
                providerId
                start_time
                end_time
            type:
        */
        $criteria = null;
        if(empty($_GET['data']['recordId'])){
            $criteria = $this->setupCriteria($_GET['data'], $_GET['type']);
        }else{
            $criteria = new CDbCriteria();
            $criteria->condition = "id=".$_GET['data']['recordId'];
        }
        $criteria->order = "id desc";
        $count = ($_GET['type'] == self::OUT_RECORD)?(DeliverRecord::model()->count($criteria)):(ReceiveRecord::model()->count($criteria));
        $pages = new CPagination($count);

        $pages->pageSize = 10;
        $pages->applyLimit($criteria);
        $recordList = ($_GET['type'] == self::OUT_RECORD)?(DeliverRecord::model()->findAll($criteria)):(ReceiveRecord::model()->findAll($criteria));


        $html = $this->renderPartial("recordList", array(
            "recordList" => $recordList,
            "pages" => $pages,
            "type" => $_GET['type']    
        ), true);
        echo $html;
    }

    public static function setupCriteria($data, $type){
        $criteria = new CDbCriteria();
        $criteria->order = "id desc";

        $searchCriteria = new CDbCriteria();
        $searchCriteria->distinct = true;
        $searchCriteria->select = "record_id";
        $searchCriteria->condition = "1=1";

        $recordIdList = array();
        if(!empty($data['goodsNumber'])){
            $searchCriteria->condition .= " and goods_number=";
            $searchCriteria->condition .= $data['goodsNumber'];
        }

        if($data['providerId'] != 'none'){
            $searchCriteria->condition .= " and provider_id=";
            $searchCriteria->condition .= $data['providerId'];
        }

        if(!empty($data["start_time"])){
            $searchCriteria->condition .= " and record_time>";
            $searchCriteria->condition .= $this->getTime($data['start_time']);
        }

        if(!empty($data["end_time"])){
            $searchCriteria->condition .= " and record_time<";
            $searchCriteria->condition .= $this->getTime($data['end_time']) + 60*60*24;
        }

        $searchedRecordList = null;
        if($type == self::OUT_RECORD){
            $searchedRecordList = DeliverRecordItem::model()->findAll($searchCriteria); 
        }
        if($type == self::IN_RECORD){
            $searchedRecordList = ReceiveRecordItem::model()->findAll($searchCriteria); 
        }

        foreach($searchedRecordList as $searchedRecord){
            array_push($recordIdList, $searchedRecord->record_id);
        }
        $recordIdList = implode(",", $recordIdList);

        if(empty($recordIdList)){
            $criteria->condition = "1=2";
        }else{
            $criteria->condition = "id in (".$recordIdList.")";
        }

        return $criteria;
    }

    private function getTime($date){
        $year=((int)substr($date,0,4));
        $month=((int)substr($date,5,2));
        $day=((int)substr($date,8,2));
        return (string)mktime(0,0,0,$month,$day,$year);
    }

    public function getStockTable(){
        var_dump($_GET);
    }
}
