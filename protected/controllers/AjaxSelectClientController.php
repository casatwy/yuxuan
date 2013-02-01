<?php
class AjaxSelectClientController extends Controller
{
    public function actionSelectclient(){
        $providerArray = array();
        $providerList = Provider::model()->findAll();

        foreach($providerList as $provider){
            $providerArray[$provider->location] = array();
        }
        foreach($providerList as $provider){
            array_push($providerArray[$provider->location], array(
                'id' => $provider->id,
                'name' => $provider->name,
            ));
        }
        $html = $this->renderPartial("selectProvider", array(
            'providerArray' => $providerArray,
        ));
        echo $html;
        Yii::app()->end();
    }
}
?>
