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

        if(empty($productList)){
            return null;
        }

        $result = array(
            "size" => array(),
            "color_name" => array(),
            "gang_number" => array(),
            "color_number" => array(),
            "diaoxian" => array(),
            "product_type" => array(),
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
            }

            if(!in_array($product->color_number, $result['color_number'])){
                array_push($result['color_number'], $product->color_number);
            }

            if(isset($product->diaoxian)){
                if(!in_array($product->diaoxian, $result['diaoxian'])){
                    array_push($result['diaoxian'], $product->diaoxian);
                }
            }
        }

        if($type == Record::PRODUCT){
            $result["product_type"] = $productList[0]->getPartListByPlanId();
        }else{
            $result["product_type"] = ProductPartModel::model()->findAll("id=:id", array(":id"=>1));
        }

        return $result;
    }
}
