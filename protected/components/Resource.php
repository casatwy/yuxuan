<?php
class Resource extends CComponent{
    public static function getAttributesByGoodsNumber($goods_number, $type){
        $condition = "goods_number=:goods_number";
        $params = array(":goods_number"=>$goods_number);

        $productList = null;
        if($type == Record::SILK ){
            $productList = Silk::model()->findAll($condition, $params);
        }
        if($type == Record::PRODUCT ){
            $productList = Product::model()->findAll($condition, $params);
        }

        $result = array(
            "size" => array(),
            "color_name" => array(),
            "gang_number" => array(),
            "color_number" => array(),
            "needle_type" => null,
        );
        foreach($productList as $product){
            if(isset($product->size)){
                if(!in_array($product->size, $result['size'])){
                    array_push($result['size'], $product->size);
                }
            }

            if(!in_array($product->color_name, $result['color_name'])){
                array_push($result['color_name'], $product->color_name);
            }

            if(isset($product->gang_number)){
                if(!in_array($product->gang_number, $result['gang_number'])){
                    array_push($result['gang_number'], $product->gang_number);
                }
            }else{
                array_push($result['gang_number'], "手工输入");
            }

            if(!in_array($product->color_number, $result['color_number'])){
                array_push($result['color_number'], $product->color_number);
            }

            if(isset($product->needle_type)){
                $result['needle_type'] = $product->needle_type;
            }
        }
        return $result;
    }
}
