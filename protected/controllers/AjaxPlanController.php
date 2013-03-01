<?php

class AjaxPlanController extends Controller
{
    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionGetPlanEvents(){
        $start = strtotime(substr($_POST['start'], 0, 34));
        $end = strtotime(substr($_POST['end'], 0, 34));
        $events = Product::getPlanList($start,$end);
        echo CJSON::encode($events);
    }

    public function actionGetPlanContentByStatus(){
        $renderPage = array("processing", "prepared", "finished");
        $status = $_GET['status'];
        Product::GetPlanContentByStatus($status);
        echo $this->renderPartial($renderPage[$status]);
    }

    public function actionShowPlanContent(){
        $planList = null;
        if(isset($_GET['record_id'])){
            $plan_id = $_GET['record_id'];
            $planList = DeliveredPlan::getPlanContent($plan_id);
        }

        echo $this->renderPartial("showPlanContent",array(
            'planList' => $planList,
            'plan_id' => $_GET['record_id'],
        ));
    }

    public function actionGetDayContent(){
        $start = $_GET['start'];
        $end = $start + 24*60*60; 
        $productList = Product::getListForCalendar($start, $end);

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
        DeliveredPlan::savePlan($_POST['data']);
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
        $count = DeliveredPlan::model()->count($criteria);
        $pages = new CPagination($count);

        $pages->pageSize = 10;
        $pages->applyLimit($criteria);
        $recordList = DeliveredPlan::model()->findAll($criteria);

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

    public function actionActivateTab(){
        $status = $_GET['status'];
    }

    public function actionSetShangji(){
        Product::setStatus($_POST['goods_number'], Product::PROCESSING);
    }

    public function actionDeleteByGoodsNumber(){
        Product::deleteByGoodsNumber($_POST['goods_number']);
    }

    public function actionSetFinish(){
        Product::setStatus($_POST['goods_number'], Product::FINISHED);
    }

    public function actionGetPlanByGoodsNumber(){
        $planData = Product::getPlanByGoodsNumber($_GET['goods_number'], $_GET['status']);
        $this->renderPartial("getPlanByGoodsNumber", array("planData" => $planData));
    }

    public function actionGetDeliveredTable(){
        $goods_number = $_GET['goods_number'];
        $silks = Silk::getByGoodsNumber($goods_number);
        $products = Product::getByGoodsNumber($goods_number);

        $this->renderPartial("getDeliveredTable",array(
            'products' => $products,
            'silks' => $silks
        ));
    }

    public function actionSaveFinishedCount(){
        Product::saveFinishedCount($_POST['data']);
    }
}
