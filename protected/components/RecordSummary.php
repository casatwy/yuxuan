<?php
class RecordSummary
{
    var $resultArray = array();

    public function getResult(){
        return $this->resultArray;
    }

    public function addToResult($item){

        $index = -1;
        $detailIndex = -1;

        foreach($this->resultArray as $key => $result){
            if(
                $result['product_type'] == $item['product_type']
                && $result['color_name'] == $item['color_name']
                && $result['color_number'] == $item['color_number']
                && $result['gang_number'] == $item['gang_number']
            ){
                $index = $key;
            }

            if($index != -1){
                foreach($result['itemArray'] as $detailKey => $detail){
                    if($detail['size'] == $item['size']){
                        $detailIndex = $detailKey;
                        break;
                    }
                }
            }

        }

        if($index == -1){
            $index = count($this->resultArray);
            array_push($this->resultArray, array(
                "product_type" => $item['product_type'],
                "color_name" => $item['color_name'],
                "color_number" => $item['color_number'],
                "gang_number" => $item['gang_number'],
                "itemArray" => array(),
            ));
        }

        if($detailIndex == -1){
            $detailIndex = count($this->resultArray[$index]['itemArray']);
            array_push($this->resultArray[$index]['itemArray'], array(
                'size' => $item['size'],
                'weight' => 0,
                'actural_weight' => 0,
                'count' => 0
            ));
        }

        $this->resultArray[$index]['itemArray'][$detailIndex]['actural_weight'] += $item['actural_weight'];
        $this->resultArray[$index]['itemArray'][$detailIndex]['weight'] += $item['weight'];
        $this->resultArray[$index]['itemArray'][$detailIndex]['count'] += $item['count'];
    }
}
