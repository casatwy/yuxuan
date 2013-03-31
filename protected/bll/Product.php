<?php

class Product extends ProductModel
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
        $condition = "(finished_time > :start or finished_time IS NULL ) and create_time < :end and status = 1";
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

        if($status != Product::PREPEARED){
            $condition = $condition." and status = :status";
            $params[":status"] = $status - 1;
        }

        self::model()->updateAll($attributes, $condition, $params);
    }

    public static function deleteByGoodsNumber($goods_number){
        $condition = "goods_number=:goods_number and status=0";
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
        $condition = "goods_number = :goods_number";
        $params = array(
            ":goods_number" => $data['goods_number'],
        );

        $product = self::model()->findAll($condition, $params);

        if(count($product) == 0){
            $product = self::createNewProduct($data);
        } else if (count($product) > 0){
            $result = null;

            foreach($product as $item){
                if( $item->color_number == $data['color_number']
                    && $item->size == $data['size']
                    && $item->product_type == $data['product_type']
                    && $item->needle_type == $data['needle_type']
                    && $item->gang_number == $data['gang_number']
                    && $item->color_name == $data['color_name']
                ){
                    $result = $item;
                    break;
                }
            }

            if(is_null($result)){
                $product = self::createNewProduct($data);
            }else{
                $product = $result;
            }
        }
        return $product->id;
    }

    public static function createNewProduct($data){
        $product = new Product;
        $product->needle_type = isset($data['needle_type'])?$data['needle_type']:0;
        $product->color_name = $data['color_name'];
        $product->color_number = $data['color_number'];
        $product->goods_number = $data['goods_number'];
        $product->size = $data['size'];
        $product->status = self::PREPEARED;
        $product->create_time = time();
        $product->gang_number = $data['gang_number'];
        $product->product_type = $data['product_type'];
        $product->save();
        return $product;
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
        //if($this->finished_count == $this->total_count && $this->status != Product::FINISHED){
        //    $this->status = Product::FINISHED;
        //    $this->save();
        //}
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
