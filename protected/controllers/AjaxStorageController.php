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
        $this->renderPartial("selectProvider", array(
            'providerArray' => $providerArray,
        ));
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
        if(!$record->saveRecord($_POST['data'])){
            echo 0;
        }
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
                goodsNumber
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
        $record = new Record($_GET['type']);
        $count = $record->count($criteria);

        $pages = new CPagination($count);
        $pages->pageSize = 10;
        $pages->applyLimit($criteria);

        $recordList = $record->findAll($criteria);

        $showingSummary = false;
        $goods_number = null;
        $client_id = null;

        if (!empty($_GET['data']['goodsNumber']) && !empty($_GET['data']['providerId'])){
            $showingSummary = true;
            $goods_number = $_GET['data']['goodsNumber'];
            $client_id = $_GET['data']['providerId'];
        }

        $this->renderPartial("recordList", array(
            "recordList" => $recordList,
            "showingSummary" => $showingSummary,
            "goods_number" => $goods_number,
            "client_id" => $client_id,
            "pages" => $pages,
            "type" => $_GET['type']    
        ));
    }

    public static function setupCriteria($data, $type){
        $criteria = new CDbCriteria();
        $criteria->order = "id desc";

        $recordIdList = array();
        $searchedRecordList = self::getSearchedRecordItemList($data, $type);

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

    public static function getSearchedRecordItemList($data, $type){
        $searchCriteria = new CDbCriteria();
        $searchCriteria->distinct = true;
        $searchCriteria->select = "*";
        $searchCriteria->condition = "1=1";

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
            $searchCriteria->condition .= self::getTime($data['start_time']);
        }

        if(!empty($data["end_time"])){
            $searchCriteria->condition .= " and record_time<";
            $searchCriteria->condition .= self::getTime($data['end_time']) + 60*60*24;
        }

        $searchedRecordList = array();

        if($type == Record::OUT_RECORD){
            $searchedRecordList = DeliveredRecordItem::model()->findAll($searchCriteria); 
        }
        if($type == Record::IN_RECORD){
            $searchedRecordList = ReceivedRecordItem::model()->findAll($searchCriteria); 
        }

        return $searchedRecordList;
    }

    public static function getTime($date){
        $year=((int)substr($date,0,4));
        $month=((int)substr($date,5,2));
        $day=((int)substr($date,8,2));
        return (string)mktime(0,0,0,$month,$day,$year);
    }

    public function actionGetStockTable(){
        $data_type = $_GET['data_type'];
        $goods_number = $_GET['goods_number'];
        $attributeList = Resource::getAttributesByGoodsNumber($goods_number, $data_type);

        //check if product exists in database
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

    public function actionDeleteRecordById(){
        $record = new Record($_POST['type']);
        $record->deleteByPk($_POST['record_id']);
        $recordItem = new RecordItem($_POST['type']);
        $condition = "record_id = :record_id";
        $params = array(
            ':record_id' => $_POST['record_id']
        );
        $recordItem->deleteAll($condition, $params);
    }

    public function actionCreateNewRecord(){
        echo '
                <div class="J_record J_note" data-id="">
                    <span class="span-6">货号:<input type="text" class="J_goodsNumber J_goodsNum"></input></span>
                    <span class="span-2"><span data-id="" class="J_selector select_b active" data-type="0">毛纱</span></span>
                    <span class="span-2"><span data-id="" class="J_selector select_b" data-type="1">产品</span></span>
                    <span class=" span-2"><button class="J_continue J_goOnButton" disabled>继续</button></span> 
                    <span class=" span-2 last"><button class="J_del">删除</button></span>
                    <div class="J_recordContent" data-id=""></div>
                </div>
            ';
    }

    public function actionRecordSummary(){
        $searchedRecordList = $this->getSearchedRecordItemList($_GET, $_GET['type']);

        $recordSummary = new RecordSummary();

        $client_name = Client::getClientNameById($_GET['providerId']); 
        $goods_number = $_GET['goodsNumber']; 

        foreach($searchedRecordList as $record){
            $product = Product::model()->findByPk($record->product_id);

            $item['product_type'] = $product->product_type;
            $item['color_name'] = $product->color_name;
            $item['color_number'] = $product->color_number;
            $item['gang_number'] = $product->gang_number;
            $item['size'] = $product->size;
            $item['weight'] = $record->weight;
            $item['actural_weight'] = $record->actural_weight;
            $item['count'] = $record->count;

            $recordSummary->addToResult($item);
        }

        $this->renderPartial("recordSummary", array(
            "resultArray" => $recordSummary->getResult(),
            "client_name" => $client_name,
            "goods_number" => $goods_number
        ));
    }
}
