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
