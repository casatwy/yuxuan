<?php

/**
 * This is the model class for table "silk".
 *
 * The followings are the available columns in table 'silk':
 * @property integer $id
 * @property integer $goods_number
 * @property string $color_name
 * @property integer $color_number
 * @property integer $gang_number
 * @property integer $order_id
 */
class Silk extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Silk the static model class
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
        return 'silk';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('goods_number, color_name, color_number, gang_number, order_id', 'required'),
            array('goods_number, color_number, gang_number, order_id', 'numerical', 'integerOnly'=>true),
            array('color_name', 'length', 'max'=>20),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, goods_number, color_name, color_number, gang_number, order_id', 'safe', 'on'=>'search'),
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
            'goods_number' => 'Goods Number',
            'color_name' => 'Color Name',
            'color_number' => 'Color Number',
            'gang_number' => 'Gang Number',
            'order_id' => 'Order',
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
        $criteria->compare('goods_number',$this->goods_number);
        $criteria->compare('color_name',$this->color_name,true);
        $criteria->compare('color_number',$this->color_number);
        $criteria->compare('gang_number',$this->gang_number);
        $criteria->compare('order_id',$this->order_id);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    public static function getProductId($data){
        $gangNumber = null;
        if(isset($data['gang_number'])){
            $gangNumber = $data['gang_number'];
        }else{
            $gangNumber = "0";
        }

        $condition = "goods_number = :goods_number and color_number = :color_number and gang_number = :gang_number";
        $params = array(
            ":goods_number" => $data['goods_number'],
            ":color_number" => $data['color_number'],
            ":gang_number" => $gangNumber,
        );
        $silk = self::model()->find($condition, $params);
        if(is_null($silk)){
            $silk = new Silk;
            $silk->goods_number = $data['goods_number'];
            $silk->color_name = $data['color_name'];
            $silk->color_number = $data['color_number'];
            $silk->gang_number = $gangNumber;
            $silk->order_id = 0;
            $silk->save();
        }
        return $silk->id;
    }

    public static function getByGoodsNumber($goods_number){
        $condition = "goods_number=:goods_number";
        $params = array(
            ":goods_number" => htmlspecialchars($goods_number)
        );
        $silks = Silk::model()->findAll($condition,$params);
        return $silks;
    }
}
