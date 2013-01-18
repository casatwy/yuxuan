<?php 

class RecordContent extends CController
{
    const SAVE_IN_STOCK = 1;
    const SAVE_OUT_STOCK = 2;

    const OUT_RECORD = 1;
    const IN_RECORD = 2;

	public function __construct(){
	}
	
    public function getRecordContent($record_id,$type){
        $recordList = array();
        $condition = "record_id=:record_id";
        $params = array(
            ":record_id" => htmlspecialchars($record_id)
        );
        if($type == self::SAVE_IN_STOCK){
        	$recordData = DeliverRecordItem::model()->findAll($condition, $params);
        }else if($type == self::SAVE_OUT_STOCK){
        	$recordData = ReceiveRecordItem::model()->findAll($condition, $params);
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

    public function printInfomation($id,$type){
		if($type == self::IN_RECORD){
			$record = ReceiveRecord::model()->findByPk($id);
		}elseif($type == self::OUT_RECORD){
			$record = DeliverRecord::model()->findByPk($id);
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
}
?>
