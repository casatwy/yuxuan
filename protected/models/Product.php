<?php

/**
 * This is the model class for table "product".
 *
 * The followings are the available columns in table 'product':
 * @property string $id
 * @property integer $silk_id
 * @property string $needle_type
 * @property string $size
 * @property integer $goods_number
 * @property string $diaoxian
 * @property int $total_count
 */
class Product extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Product the static model class
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
			array('silk_id, needle_type, size, goods_number', 'required'),
			array('silk_id, goods_number, total_count', 'numerical', 'integerOnly'=>true),
			array('needle_type', 'length', 'max'=>10),
			array('size, diaoxian', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, silk_id, needle_type, size, goods_number, diaoxian, total_count', 'safe', 'on'=>'search'),
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
			'silk_id' => 'Silk',
			'needle_type' => 'Needle Type',
			'size' => 'Size',
			'goods_number' => 'Goods Number',
			'diaoxian' => 'Diaoxian',
			'total_count' => 'Total Count',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('silk_id',$this->silk_id);
		$criteria->compare('needle_type',$this->needle_type,true);
		$criteria->compare('size',$this->size,true);
		$criteria->compare('goods_number',$this->goods_number);
		$criteria->compare('diaoxian',$this->diaoxian,true);
		$criteria->compare('total_count',$this->total_count);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    /*
     * info is a array which inculde:
     *  goods_number color_number needle_type size
     *
     * */
    public static function findExistedProduct($info){
        $sql = "SELECT * 
                FROM (
                    SELECT silk.color_number, silk.color_name, product.needle_type, product.size, product.id
                    FROM silk, product
                    WHERE  `silk`.goods_number =  `product`.goods_number
                    AND  `product`.goods_number =".htmlspecialchars($info["goods_number"])."
                ) AS sb
                WHERE color_number =".htmlspecialchars($info["color_number"])."
                AND needle_type =".htmlspecialchars($info["needle_type"])."
                AND size =".htmlspecialchars($info["size"]).";";
        $result = Yii::app()->db->createCommand($sql)->queryRow();
        if(isset($result['id'])){
            return $result['id'];
        }else{
            return $result;
        }
    }

    public static function createNew($info, $silk_id=false){
        $product = new Product;
        if($silk_id){
            $product->silk_id = $silk->id;
        }else{
            $product->silk_id = Silk::findExistSilk($info);
        }
        $product->needle_type = $info["needle_type"];
        $product->size = $info["size"];
        $product->goods_number = $info["goods_number"];
        $product->save();
        return $product->id;
    }
}
