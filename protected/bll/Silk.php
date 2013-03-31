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
class Silk extends SilkModel
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

    public static function getProductId($data){
        $gangNumber = null;
        if(!isset($data['gang_number'])){
            $data = array_merge(
                array("gang_number" => "0"),
                $data
            );
        }

        $condition = "goods_number = :goods_number";
        $params = array(
            ":goods_number" => $data['goods_number'],
        );
        $silk = self::model()->findAll($condition, $params);
        if(count($silk) == 0){
            $silk = self::createNewSilk($data);
        } else if (count($silk) > 0) {
            $result = null;

            foreach($silk as $item){
                if ($item->color_name == $data['color_name']
                    && $item->color_number == $data['color_number']
                    && $item->gang_number == $data['gang_number']
                ){
                    $result = $item;
                    break;
                }
            }

            if(is_null($result)){
                $silk = self::createNewSilk($data);
            }else{
                $silk = $result;
            }
        }
        return $silk->id;
    }

    public static function createNewSilk($data){
        $silk = new Silk;
        $silk->goods_number = $data['goods_number'];
        $silk->color_name = $data['color_name'];
        $silk->color_number = $data['color_number'];
        $silk->gang_number = $data['gang_number'];
        $silk->order_id = 0;
        $silk->save();
        return $silk;
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
