<?php

class AjaxStorageController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

    public function actionSaveoutstock(){
        $data = CJSON::decode($_POST['data']);

        $deliverRecord = new DeliverRecord;
        $deliverRecord->record_time = time();
        $deliverRecord->record_maker = Yii::app()->user->getState('name');
        $deliverRecord->provider_id = $data[0]['provider_id'];
        $deliverRecord->save();

        foreach($data as $item){
            $deliverRecordItem = new DeliverRecordItem;
            $deliverRecordItem->item_id = $this->getItemId($item);
            $deliverRecordItem->type = $item['type'];
            $deliverRecordItem->weight = $item['weight'];
            $deliverRecordItem->quantity = $item['type'];
            $deliverRecordItem->goods_number = $item['goods_number'];
            $deliverRecordItem->record_id = $deliverRecord->id;
            $deliverRecordItem->record_time = $deliverRecord->record_time;
            $deliverRecordItem->record_maker = $deliverRecord->record_maker;
            $deliverRecordItem->provider_id = $deliverRecord->provider_id;
        }

        $result = array(
            "success" => 1,
            'content' => 'out stock success',
        );
        echo CJSON::encode($result);
    } 

    public function actionSaveinstock(){
        $data = CJSON::decode($_POST['data']);

        //$result = array(
        //    "success" => 1,
        //    "content" => "可打印表单"
        //);
        //echo CJSON::encode($result);
        //Yii::app()->end();

        $receiveRecord = new ReceiveRecord;
        $receiveRecord->record_time = time();
        $receiveRecord->record_maker = Yii::app()->user->getState('name');
        $receiveRecord->provider_id = $data[0]["provider_id"];
        $receiveRecord->save();

        foreach($data as $item){
            $receiveRecordItem = new ReceiveRecordItem;
            $receiveRecordItem->item_id = $this->getItemId($item);
            $receiveRecordItem->type = $item['type'];
            $receiveRecordItem->weight = $item['weight'];
            $receiveRecordItem->quantity = $item['type'];
            $receiveRecordItem->goods_number = $item['goods_number'];
            $receiveRecordItem->record_id = $receiveRecord->id;
            $receiveRecordItem->record_time = $receiveRecord->record_time;
            $receiveRecordItem->record_maker = $receiveRecord->record_maker;
            $receiveRecordItem->provider_id = $receiveRecord->provider_id;

            //storage is also saved in the afterSave() of ReceiveRecordItem.
            $receiveRecordItem->save();
        }

        $result = array(
            "success" => 1,
            //@todo render partial
            "content" => "here i am"
        );

        echo CJSON::encode($result);
    }

    private function getItemId($item){
        $condition = 'color_number=:color_number and '
            .'color_name=:color_name and '
            .'gang_number=:gang_number and '
            .'goods_number=:goods_number';
        $params = array(
            ":color_number" => $item['color_number'],
            ":color_name" => $item['color_name'],
            ":gang_number" => $item['gang_number'],
            ":goods_number" => $item['goods_number'],
        );
        $silk = Silk::model()->find($condition, $params);
        if(is_null($silk)){
            $silk = new Silk;
            $silk->color_number = $item['color_number'];
            $silk->color_name = $item['color_name'];
            $silk->gang_number = $item['gang_number'];
            $silk->goods_number = $item['goods_number'];
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
}
