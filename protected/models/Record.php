<?php

/**
 * This is the model class for table "received_record".
 *
 * The followings are the available columns in table 'received_record':
 * @property string $id
 * @property integer $record_time
 * @property integer $record_maker_id
 * @property integer $client_id
 */
class Record extends CActiveRecord
{

    public $saveType;
    const IN_RECORD = 0;
    const OUT_RECORD = 1;

    const SILK = 0;
    const PRODUCT = 1;

    public $maker = null;

    public function __construct($saveType){
        $this->saveType = $saveType;
        $this->_md = new CActiveRecordMetaData($this);
    }
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ReceivedRecord the static model class
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
        if($this->saveType == self::IN_RECORD){
		    return 'received_record';
        }

        if($this->saveType == self::OUT_RECORD){
		    return 'delivered_record';
        }
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('record_time, record_maker_id, client_id', 'required'),
			array('record_time, record_maker_id, client_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, record_time, record_maker_id, client_id', 'safe', 'on'=>'search'),
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
			'record_time' => 'Record Time',
			'record_maker_id' => 'Record Maker',
			'client_id' => 'Client',
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
		$criteria->compare('record_time',$this->record_time);
		$criteria->compare('record_maker_id',$this->record_maker_id);
		$criteria->compare('client_id',$this->client_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function saveRecord($data){
        $this->_new = true;
        $this->record_time = time();
        $this->record_maker_id = Yii::app()->user->getState("user_id");
        $this->client_id = $data['client_id'];
        if($this->save()){
            $this->saveItem($data['data']);
        }
    }

    private function saveItem($data){
        foreach($data as $item){
            $recordItem = new RecordItem($this->saveType);
			$recordItem->saveItem($item, $this);
        }
    }

    public function getClient(){
        $condition = "id = :client_id";
        $params = array(
            ':client_id' => $this->client_id
        );
        $client = Client::model()->find($condition, $params);

        if(is_null($client)){
            return "未知客户";
        }else{
            return $client->name;
        }
    }

    public function getMaker(){
        $maker = null;
        if(!is_null($this->maker)){
            $maker =  $this->maker;
        }else{
            $condition = "id = :record_maker_id";
            $params = array(
                ':record_maker_id' => $this->record_maker_id
            );
            $user = User::model()->find($condition, $params);

            if(is_null($user)){
                $maker = "未知建立人";
            }else{
                $maker = $user->name;
            }
            $this->maker = $maker;
        }
        return $maker;
    }
}
