<?php

/**
 * This is the model class for table "product".
 *
 * The followings are the available columns in table 'product':
 * @property integer $id
 * @property integer $needle_type
 * @property string $color_name
 * @property integer $color_number
 * @property integer $goods_number
 * @property string $size
 * @property integer $order_id
 * @property integer $price
 * @property integer $total_count
 * @property integer $client_id
 * @property integer $status
 * @property integer $create_time
 * @property integer $finished_time
 * @property integer $finished_count
 */
class Product extends CActiveRecord
{

    const PREPEARED = 0;
    const PROCESSING = 1;
    const FINISHED = 2;
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
            array('needle_type, color_name, color_number, goods_number, size, status, create_time', 'required'),
            array('needle_type, color_number, goods_number, order_id, price, total_count, client_id, status, create_time, finished_time, finished_count', 'numerical', 'integerOnly'=>true),
            array('color_name, size', 'length', 'max'=>10),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, needle_type, color_name, color_number, goods_number, size, order_id, price, total_count, client_id, status, create_time, finished_time, finished_count', 'safe', 'on'=>'search'),
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
            'needle_type' => 'Needle Type',
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
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter condition.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter condition.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('needle_type',$this->needle_type);
        $criteria->compare('color_name',$this->color_name,true);
        $criteria->compare('color_number',$this->color_number);
        $criteria->compare('goods_number',$this->goods_number);
        $criteria->compare('size',$this->size,true);
        $criteria->compare('order_id',$this->order_id);
        $criteria->compare('price',$this->price);
        $criteria->compare('total_count',$this->total_count);
        $criteria->compare('client_id',$this->client_id);
        $criteria->compare('status',$this->status);
        $criteria->compare('create_time',$this->create_time);
        $criteria->compare('finished_time',$this->finished_time);
        $criteria->compare('finished_count',$this->finished_count);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    public static function createPlanList($list){
        $condition = "goods_number = :goods_number";
        $params = array(":goods_number" => $list['goods_number']);
        if(!Silk::model()->exists($condition, $params)){
            return 2;
        }

        $idList = array();
        foreach($list['data'] as $itemList){
            foreach($itemList['spec'] as $item){
                $product = new Product();
                $product->needle_type = $list['needle_type'];
                $product->client_id = $list['client_id'];
                $product->goods_number = $list['goods_number'];
                $product->color_name = $itemList['color_name'];
                $product->color_number = $itemList['color_number'];
                $product->size = $item['size'];
                $product->total_count = $item['count'];
                $product->create_time = time();
                $product->finished_count = 0;
                $product->status = self::PREPEARED;
                if(!$product->save()){
                    self::model()->deleteByPk($idList);
                    return 0;
                }else{
                    array_push($idList, $product->id);
                }
            }
        }
        return 1;
    }

    public static function getListForCalendar($start, $end){
        $condition = "(finished_time > :start or finished_time IS NULL ) and create_time < :end";
        $params = array(
            ":start" => $start,
            ":end" => $end
        );
        $productList = self::model()->findAll($condition, $params);
        $itemList = self::formatListForCalendar($productList);
        return $itemList;
    }

    public static function getFinishedPlan(){
    }

    public static function formatListForCalendar($productList){
        $itemList = array();
        foreach($productList as $product){
            if(!array_key_exists($product->goods_number, $itemList)){
                $itemList[$product->goods_number] = array();
            }
            if(!array_key_exists($product->color_name, $itemList[$product->goods_number])){
                $itemList[$product->goods_number][$product->color_name] = array();
            }
            array_push($itemList[$product->goods_number][$product->color_name],$product->getAttributes());
        }
        return $itemList;
    }

    public static function format0($productList){
        $itemList = array();
        foreach($productList as $product){
            if(!array_key_exists($product->goods_number, $itemList)){
                $itemList[$product->goods_number] = array(
                    'client' => $product->getClientName($product->client_id),
                    'create_time' => date("Y-m-d H:i:s", $product->create_time),
                );
            }
        }
        return $itemList;
    }

    public static function format1($productList){
        $itemList = self::format0($productList);
        return $itemList;
    }

    public static function format2($productList){
        $itemList = self::format0($productList);
        return $itemList;
    }

    public static function getListByStatus($status){
        $condition = "status=:status limit 0, 30";
        $params = array(":status" => $status);

        $productList = self::model()->findAll($condition, $params);

        $formatFunction = "format".$status;
        $itemList = self::$formatFunction($productList);

        return $itemList;
    }

    public static function getClientName($client_id){
        if(is_null($client_id)){
            return "未知";
        }else{
            return Client::model()->findByPk($client_id)->name;
        }
    }

    public static function setStatus($goods_number, $status){
        $attributes = array("status" => $status);
        $condition = "goods_number=:goods_number";
        $params = array(":goods_number"=>$goods_number);
        self::model()->updateAll($attributes, $condition, $params);
    }

    public static function deleteByGoodsNumber($goods_number){
        $condition = "goods_number=:goods_number";
        $params = array(":goods_number"=>$goods_number);
        self::model()->deleteAll($condition, $params);
    }

    public static function getPlanList($start,$end){
        $condition = "create_time > :start and create_time < :end and status = 1";
        $params = array(
            ':start' => $start,
            ':end' => $end,
        );
        $daily_messages = self::model()->findAll($condition, $params);

        $events = array();
        foreach($daily_messages as $m){
            $event = array(
                'product_id' => $m['id'],
                'title' => $m['goods_number'].'_'.$m['color_name'].'_'.$m['size'],
                'start' => $m['create_time'],
                'end' => $m['finished_time'],
                'className' => 'J_event',
                'editable' => false,
                );
            array_push($events,$event);
        }
        return $events;
    }

    public static function getProductId($data){
        $condition = "goods_number = :goods_number and color_number = :color_number and size = :size";
        $params = array(
            ":goods_number" => $data['goods_number'],
            ":color_number" => $data['color_number'],
            ":size" => $data['size'],
        );
        $product = self::model()->find($condition, $params);
        if(is_null($product)){
            $product = new Product;
            $product->needle_type = 0;
            $product->color_name = $data['color_name'];
            $product->color_number = $data['color_number'];
            $product->goods_number = $data['goods_number'];
            $product->size = $data['size'];
            $product->status = self::PREPEARED;
            $product->create_time = time();
            $product->save();
        }
        return $product->id;
    }

    public static function getByGoodsNumber($goods_number){
        $table = array();
        $condition = "goods_number=:goods_number";
        $params = array(
            ":goods_number" => htmlspecialchars($goods_number)
        );
        $products = Product::model()->findAll($condition,$params);
        foreach($products as $product){
            $table[$product->color_name][] = $product;
        }
        return $table;
    }

    public function afterSave(){
        if($this->finished_count == $this->total_count && $this->status != Product::FINISHED){
            $this->status = Product::FINISHED;
            $this->save();
        }
        Silk::getProductId($this->attributes);
    }

    public static function getPlanByGoodsNumber($goods_number, $status){
        $condition = "goods_number = :goods_number and status = :status";
        $params = array(
            ":goods_number" => $goods_number,
            ":status" => $status,
        );

        $productList = self::model()->findAll($condition, $params);

        if(is_null($productList)){
            return array();
        }else{
            $data = array(
                "goods_number" => $goods_number,
                "client" => $productList[0]->getClientName($productList[0]->client_id),
                "create_time" => date("Y-m-d H:i:s", $productList[0]->create_time),
                "data" => array()
            );
            $data['data'] = self::formatPlan($productList);
            return $data;
        }
    }

    public static function formatPlan($productList){
        $data = array();
        foreach($productList as $product){
            $data[$product->color_name][] = $product;
        }
        return $data;
    }

    public static function saveFinishedCount($data){
        foreach($data as $item){
            $product = self::model()->findByPk($item['product_id']);
            $product->finished_count += $item['finished_count'];
            $product->save();
        }
    }
}
