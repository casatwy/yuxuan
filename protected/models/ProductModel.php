<?php

/**
 * This is the model class for table "product".
 *
 * The followings are the available columns in table 'product':
 * @property integer $id
 * @property string $color_name
 * @property integer $color_number
 * @property string $goods_number
 * @property string $size
 * @property integer $order_id
 * @property integer $price
 * @property integer $total_count
 * @property integer $client_id
 * @property integer $status
 * @property integer $create_time
 * @property integer $finished_time
 * @property integer $finished_count
 * @property integer $product_part_id
 * @property string $gang_number
 * @property integer $deadline_time
 * @property string $diaoxian
 * @property integer $plan_id
 */
class ProductModel extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProductModel the static model class
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
		return 'product';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('color_name, color_number, goods_number, size, status, create_time, gang_number, diaoxian, plan_id', 'required'),
			array('color_number, order_id, price, total_count, client_id, status, create_time, finished_time, finished_count, product_part_id, deadline_time, plan_id', 'numerical', 'integerOnly'=>true),
			array('color_name, size', 'length', 'max'=>10),
			array('goods_number, diaoxian', 'length', 'max'=>30),
			array('gang_number', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, color_name, color_number, goods_number, size, order_id, price, total_count, client_id, status, create_time, finished_time, finished_count, product_part_id, gang_number, deadline_time, diaoxian, plan_id', 'safe', 'on'=>'search'),
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
			'color_name' => 'Color Name',
			'color_number' => 'Color Number',
			'goods_number' => 'Goods Number',
			'size' => 'Size',
			'order_id' => 'Order',
			'price' => 'Price',
			'total_count' => 'Total Count',
			'client_id' => 'Client',
			'status' => 'Status',
			'create_time' => 'Create Time',
			'finished_time' => 'Finished Time',
			'finished_count' => 'Finished Count',
			'product_part_id' => 'Product Part',
			'gang_number' => 'Gang Number',
			'deadline_time' => 'Deadline Time',
			'diaoxian' => 'Diaoxian',
			'plan_id' => 'Plan',
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
		$criteria->compare('color_name',$this->color_name,true);
		$criteria->compare('color_number',$this->color_number);
		$criteria->compare('goods_number',$this->goods_number,true);
		$criteria->compare('size',$this->size,true);
		$criteria->compare('order_id',$this->order_id);
		$criteria->compare('price',$this->price);
		$criteria->compare('total_count',$this->total_count);
		$criteria->compare('client_id',$this->client_id);
		$criteria->compare('status',$this->status);
		$criteria->compare('create_time',$this->create_time);
		$criteria->compare('finished_time',$this->finished_time);
		$criteria->compare('finished_count',$this->finished_count);
		$criteria->compare('product_part_id',$this->product_part_id);
		$criteria->compare('gang_number',$this->gang_number,true);
		$criteria->compare('deadline_time',$this->deadline_time);
		$criteria->compare('diaoxian',$this->diaoxian,true);
		$criteria->compare('plan_id',$this->plan_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}