<?php

class AjaxStorageController extends Controller
{

    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionSaveoutstock(){
        $this->saveRecord(Record::OUT_RECORD);
        Yii::app()->end();
    } 

    public function actionSaveinstock(){
        $this->saveRecord(Record::IN_RECORD);
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
        $record = new Record($saveType);
        $record->saveRecord($_POST);
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
        $count = ($_GET['type'] == Record::OUT_RECORD)?(DeliveredRecord::model()->count($criteria)):(ReceivedRecord::model()->count($criteria));
        $pages = new CPagination($count);

        $pages->pageSize = 10;
        $pages->applyLimit($criteria);
        $recordList = ($_GET['type'] == Record::OUT_RECORD)?(DeliveredRecord::model()->findAll($criteria)):(ReceivedRecord::model()->findAll($criteria));


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
            $searchCriteria->condition .= " and client_id=";
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

        $searchedRecordList = array();
        if($type == Record::OUT_RECORD){
            $searchedRecordList = DeliveredRecordItem::model()->findAll($searchCriteria); 
        }
        if($type == Record::IN_RECORD){
            $searchedRecordList = ReceivedRecordItem::model()->findAll($searchCriteria); 
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

    public function actionGetStockTable(){
        $data_type = $_GET['data_type'];
        $goods_number = $_GET['goods_number'];
        $attributeList = Resource::getAttributesByGoodsNumber($goods_number, $data_type);

        if(is_null($attributeList) && $data_type != Record::SILK){
            echo 0;
            Yii::app()->end();
        }

        if($data_type == Record::SILK){
            echo $this->renderPartial("silkStock", array("attributeList" => $attributeList));
        }

        if($data_type == Record::PRODUCT){
            echo $this->renderPartial("productStock", array("attributeList" => $attributeList));
        }
    }
}
