<?php

class AjaxPlanController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

    public function actionGetPlanEvents(){
        $sql = "select dp.time,p.goods_number,p.size,s.color_name from `daily_product` dp "
            ." inner join `product` p on dp.time >=".strtotime($_POST['start'])
            ." and dp.time <".strtotime($_POST['end'])." and dp.product_id = p.id "
            ." inner join `silk` s on p.silk_id = s.id ";
        $daily_messages = Yii::app()->db->createCommand($sql)->queryAll();
        
        $events = array();

        foreach($daily_messages as $m){
            $event = array(
                'title' => $m['goods_number'].'_'.$m['color_name'].'_'.$m['size'],
                'start' => $m['time'],
                'end' => $m['time'],
                'className' => 'J_event',
                'editable' => false,
            );
            array_push($events,$event);
        }

        echo CJSON::encode($events);
    }

    public function actionGetPlanContent(){
        echo $this->renderPartial("planContent");
    }

    public function actionShowPlanContent(){
        $planList = null;
        if(isset($_GET['record_id'])){
            $plan_id = $_GET['record_id'];
            $recordContent = new RecordContent();
            $planList = $recordContent->getPlanContent($plan_id);
        }

        echo $this->renderPartial("showPlanContent",array(
            'planList' => $planList,
        ));
    }

    public function actionGetDayContent(){
        echo $this->renderPartial("dayContent");
    }

    public function actionSaveDailyRecord(){
        /*
             goods_number
             color_number
             needle_type
             color_name
             size
             total
             finished
         */
        $product_id = Product::findExistedProduct($_POST);
        if(!$product_id){//create a product based on the silk
            $product_id = Product::createNew($_POST);
        }
        $daily = new DailyProduct;
        $daily->time = strtotime($_POST['date']);
        $daily->product_id = $product_id;
        $daily->count = $_POST['finished'];
        $daily->goods_number = $_POST['goods_number'];
        if($daily->save()){
            echo 1;
        }else{
            echo 0;
        }
    }

    public function actionSaveDeliveredPlan(){
    /*
            provider_id
            goods_number
            color_number
            color_name
            needle_type
            size
            quantity
    */
        $deliverPlan = new DeliverPlan;
        $deliverPlan->record_time = time();
        $deliverPlan->plan_maker = Yii::app()->user->getState("name");
        $deliverPlan->provider_id = $_POST["data"][0]["provider_id"];
        $deliverPlan->save();

        foreach($_POST["data"] as $info){
            $deliverPlanItem = new DeliverPlanItem;
            $deliverPlanItem->product_id = Product::findExistedProduct($info);
            $deliverPlanItem->quantity = $info["quantity"];
            $deliverPlanItem->goods_number = $info["goods_number"];
            $deliverPlanItem->plan_id = $deliverPlan->id;
            $deliverPlanItem->record_time = $deliverPlan->record_time;
            $deliverPlanItem->plan_maker = $deliverPlan->plan_maker;
            $deliverPlanItem->provider_id = $deliverPlan->provider_id;
            $deliverPlanItem->save();
        }

        echo CJSON::encode(array(
            "success" => 1,
            "content" => "可打印回执"
        ));

        Yii::app()->end();
    }

    public function actionSearchDeliveredPlan(){
        $criteria = null;
        if(empty($_GET['data']['recordId'])){
            $criteria = RecordContent::getCriteria($_GET['data'], RecordContent::PLAN);
        }else{
            $criteria = new CDbCriteria();
            $criteria->condition = "id=".$_GET['data']['recordId'];
        }
        $criteria->order = "id desc";
        $count = DeliverPlan::model()->count($criteria);
        $pages = new CPagination($count);

        $pages->pageSize = 10;
        $pages->applyLimit($criteria);
        $recordList = DeliverPlan::model()->findAll($criteria);

        $html = $this->renderPartial("searchedResult", array(
            "planList" => $recordList,
            "pages" => $pages,
			"type" => RecordContent::PLAN
        ), true);
        echo $html;
    }
}
