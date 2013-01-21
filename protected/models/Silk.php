<?php

/**
 * This is the model class for table "silk".
 *
 * The followings are the available columns in table 'silk':
 * @property string $id
 * @property integer $color_number
 * @property string $color_name
 * @property string $gang_number
 * @property integer $goods_number
 * @property integer $zhi_count
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
			array('color_number, color_name, gang_number, goods_number, zhi_count', 'required'),
			array('color_number, goods_number, zhi_count', 'numerical', 'integerOnly'=>true),
			array('color_name, gang_number', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, color_number, color_name, gang_number, goods_number, zhi_count', 'safe', 'on'=>'search'),
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
			'color_number' => 'Color Number',
			'color_name' => 'Color Name',
			'gang_number' => 'Gang Number',
			'goods_number' => 'Goods Number',
			'zhi_count' => 'Zhi Count',
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
		$criteria->compare('color_number',$this->color_number);
		$criteria->compare('color_name',$this->color_name,true);
		$criteria->compare('gang_number',$this->gang_number,true);
		$criteria->compare('goods_number',$this->goods_number);
		$criteria->compare('zhi_count',$this->zhi_count);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    /*
     * info is an array which includes:
     *  goods_number color_name color_number
     * */
    public static function findExistSilk($info){
        $sql = "
            SELECT * from (
                SELECT * from silk where goods_number=".htmlspecialchars($info['goods_number'])."
            ) as temp
            where color_name =".htmlspecialchars($info['color_name'])."
            and color_number =".htmlspecialchars($info['color_number']);
        $result = Yii::app()->db->createCommand($sql)->queryRow();
        if(isset($result['id'])){
            return $result['id'];
        }else{
            return $result;
        }
    }

    public static function createNew($info){
        $silk = new Silk;
        $silk->color_number = $info['color_number'];
        $silk->color_name = $info['color_name'];
        $silk->gang_number = $info['gang_number'];
        $silk->goods_number = $info['goods_number'];
        $silk->zhi_count = $info['zhi_count'];
        $silk->save();
        return $silk->id;
    } 
}
