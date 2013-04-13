<?php

/**
 * This is the model class for table "delivered_record_item".
 *
 * The followings are the available columns in table 'delivered_record_item':
 * @property integer $id
 * @property string $record_id
 * @property double $weight
 * @property integer $count
 * @property integer $goods_number
 * @property integer $type
 * @property integer $record_time
 * @property integer $record_maker_id
 * @property integer $product_id
 * @property integer $client_id
 */
class RecordItem extends RecordItemModel
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return DeliveredRecordItem the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    private $saveType;
    public function __construct($saveType){
        $this->saveType = $saveType;
        $this->_md = new CActiveRecordMetaData($this);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        if($this->saveType == Record::IN_RECORD){
            return 'received_record_item';
        }
        if($this->saveType == Record::OUT_RECORD){
            return 'delivered_record_item';
        }
    }

    public function saveItem($item, $record){
        $this->_new = true;
        $this->record_id = $record->id;
        $this->weight = $item['weight'];
        $this->actural_weight = $item['actural_weight'];
        if(isset($item['count'])){
            $this->count = $item['count'];
        }else{
            $this->count = 0;
        }
        $this->goods_number = $item['goods_number'];
        $this->type = $item['itemType'];
        $this->record_time = $record->record_time;
        $this->record_maker_id = $record->record_maker_id;
        $this->product_id = $this->getProductId($item);
        $this->client_id = $record->client_id;
        return $this->save();
    }

    public function getProductId($itemData){
        $product_id = null;
        if($itemData['itemType'] == Record::SILK){
            $product_id = Silk::getProductId($itemData);
        }
        if($itemData['itemType'] == Record::PRODUCT){
            $product_id = Product::getProductId($itemData);
        }
        return $product_id;
    }
}
