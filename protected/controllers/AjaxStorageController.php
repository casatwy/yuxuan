<?php

class AjaxStorageController extends Controller
{
    const SAVE_IN_STOCK = 1;
    const SAVE_OUT_STOCK = 2;

	public function actionIndex()
	{
		$this->render('index');
	}

    public function actionSaveoutstock(){
        $this->saveRecord(self::SAVE_OUT_STOCK);
        Yii::app()->end();
    } 

    public function actionSaveinstock(){
        $this->saveRecord(self::SAVE_IN_STOCK);
        Yii::app()->end();
    }

    public function actionSelectprovider(){
        $providerArray = array();
        $providerList = Provider::model()->findAll();

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
        $condition = 'color_number=:color_number and '
            .'gang_number=:gang_number and '
            .'color_name=:color_name and '
            .'goods_number=:goods_number and '
            .'zhi_count=:zhi_count';
        $params = array(
            ":color_number" => $item['color_number'],
            ":color_name" => $item['color_name'],
            ":gang_number" => $item['gang_number'],
            ":zhi_count" => $item['zhi_count'],
            ":goods_number" => $item['goods_number'],
        );
        $silk = Silk::model()->find($condition, $params);
        if(is_null($silk)){
            $silk = new Silk;
            $silk->color_number = $item['color_number'];
            $silk->color_name = $item['color_name'];
            $silk->gang_number = $item['gang_number'];
            $silk->goods_number = $item['goods_number'];
            $silk->zhi_count = $item['zhi_count'];
            $silk->save();
        }
        if($item["type"] == 1){
            return $silk->id;
        }

        $condition = 'goods_number=:goods_number and '
                    .'silk_id=:silk_id and '
                    .'needle_type=:needle_type and '
                    .'size=:size';
        $params = array(
            ":silk_id" => $silk->id,
            ":needle_type" => $item["needle_type"],
            ":size" => $item["size"],
            ":goods_number" => $item["goods_number"],
        );
        $product = Product::model()->find($condition, $params);
        if(is_null($product)){
            $product = new Product;
            $product->silk_id = $silk->id;
            $product->needle_type = $item["needle_type"];
            $product->size = $item["size"];
            $product->goods_number = $item["goods_number"];
            $product->save();
        }
        return $product->id;
    }

    public function actionSaveprovider(){
        $condition = "name=:name and location=:location;";
        $params = array(
            ":name" => htmlspecialchars($_POST["data"]["providerName"]),
            ":location" => htmlspecialchars($_POST["data"]["providerLocation"]),
        );
        $provider = Provider::model()->find($condition, $params);

        if(is_null($provider)){
            $provider = new Provider;
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
        if($saveType == self::SAVE_IN_STOCK){
            $record = new ReceiveRecord;
        }
        if($saveType == self::SAVE_OUT_STOCK){
            $record = new DeliverRecord;
        }

        $record->record_time = time();
        $record->record_maker = Yii::app()->user->getState('name');
        $record->provider_id = $_POST['data'][0]['provider_id'];
        $record->save();

        foreach($_POST['data'] as $item){
            $recordItem = null;
            if($saveType == self::SAVE_IN_STOCK){
                $recordItem = new ReceiveRecordItem;
            }
            if($saveType == self::SAVE_OUT_STOCK){
                $recordItem = new DeliverRecordItem;
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
            $recordItem->save();
        }

        $result = array(
            "success" => 1,
            'content' => '可打印的回执单',
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
				"record_id" => $_GET['record_id']
            ));
        }
    }

    public function actionSearchRecord(){
        var_dump($_GET);
    }
}
