<?php

class AjaxPlanController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

    public function actionGetPlanEvents(){
        var_dump($_POST);die();
        $start = strtotime(substr($_POST['start'], 0, 34));
        $end = strtotime(substr($_POST['end'], 0, 34));
        $events = RecordContent::getPlanList($start,$end);
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
            'plan_id' => $_GET['record_id'],
        ));
    }

    public function actionGetDayContent(){
        $start = $_GET['start'];
        $end = $start + 24*60*60; 
        $productList = Product::getList($start, $end);

        echo $this->renderPartial("dayContent", array(
            'productList' => $productList
        ));
    }

    public function actionGetDate(){
        echo strtotime(substr($_GET['date'], 0, 34));
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
             diaoxian
             type
         */
        $product_id = Product::findExistedProduct($_POST);
        if(!$product_id){//create a product based on the silk
            $product_id = Product::createNew($_POST);
        }
        $daily = new DailyProduct;
        $daily->time = strtotime(substr($_POST['date'], 0,34));
        $daily->product_id = $product_id;
        $daily->count = $_POST['finished'];
        $daily->goods_number = $_POST['goods_number'];
        if($daily->save()){
            echo 1;
        }else{
            var_dump($daily->getErrors());
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
            'id' => $deliverPlan->id,
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

    public function actionSavePlanList(){
        $result = Product::createPlanList($_POST);
        echo CJSON::encode($result);
    }
}
