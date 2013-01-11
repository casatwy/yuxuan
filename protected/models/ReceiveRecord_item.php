<?php

/**
 * This is the model class for table "receive_record_item".
 *
 * The followings are the available columns in table 'receive_record_item':
 * @property integer $id
 * @property integer $type
 * @property string $item_id
 * @property double $weight
 * @property integer $quantity
 * @property integer $goods_number
 * @property string $record_id
 * @property string $record_time
 * @property string $record_maker
 * @property integer $provider_id
 */
class ReceiveRecord_item extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ReceiveRecord_item the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'receive_record_item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, type, item_id, weight, quantity, goods_number, record_id, record_time, record_maker, provider_id', 'required'),
			array('id, type, quantity, goods_number, provider_id', 'numerical', 'integerOnly'=>true),
			array('weight', 'numerical'),
			array('item_id, record_id, record_maker', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, type, item_id, weight, quantity, goods_number, record_id, record_time, record_maker, provider_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'type' => 'Type',
			'item_id' => 'Item',
			'weight' => 'Weight',
			'quantity' => 'Quantity',
			'goods_number' => 'Goods Number',
			'record_id' => 'Record',
			'record_time' => 'Record Time',
			'record_maker' => 'Record Maker',
			'provider_id' => 'Provider',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('type',$this->type);
		$criteria->compare('item_id',$this->item_id,true);
		$criteria->compare('weight',$this->weight);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('goods_number',$this->goods_number);
		$criteria->compare('record_id',$this->record_id,true);
		$criteria->compare('record_time',$this->record_time,true);
		$criteria->compare('record_maker',$this->record_maker,true);
		$criteria->compare('provider_id',$this->provider_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function afterSave(){
        $condition = "type=:type and item_id=:item_id";
        $params = array(
            ":type" => $this->type,
            ":item_id" => $this->item_id
        );
        $storage = Storage::model()->find($condition, $params);
        if(is_null($storage)){
            $storage = new Storage;
            $storage->item_id = $this->item_id;
            $storage->type = $this->type;
            $storage->goods_number = $this->goods_number;
            $storage->total_weight = $this->weight;
            $storage->total_count = $this->quantity;
        }
        $storage->received_weight += $this->weight;
        $storage->received_count += $this->quantity;
        $storage->save();
    }
}
