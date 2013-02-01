<?php

class PlanController extends Controller
{
    const DELIVER_PLAN = 3;

    public function init(){
        parent::init();
        $this->layout = "//layouts/plan";
        $this->defaultAction = "listall";
    }

    public function filters(){
        return array('accessControl');
    }

    public function accessRules(){
        return array(
        );
    }

    public function actionListall(){
        $this->render("listall");
    }

    public function actionCreatePlanList(){
        $this->cs->registerScriptFile($this->jsCommon."StockHelper.js");
        $this->cs->registerScriptFile($this->jsCommon."bigtable.js");
        $this->render("createPlanList");
    }

    public function actionCreateDeliveredPlan(){
        $type = Type::model()->findAll();
        $this->cs->registerScriptFile($this->baseUrl.Yii::app()->assetManager->publish(
            Yii::getPathOfAlias('webroot.js.common.storage')).'/RecordHelper.js'
        );
        $this->cs->registerScriptFile($this->jsUrl."createDeliveredPlan.js");
        $this->render("createDeliveredPlan", array(
            'productTypes' => Type::model()->findAll("id != 1"),
            'type' => $type,
        ));
    }

    public function actionDailylist()
    {
        $fullCalendarUrl = $this->baseUrl.Yii::app()->assetManager->publish(Yii::getPathOfAlias('webroot.js.libs.plugins.fullcalendar')).'/';
        $this->cs->registerCssFile($fullCalendarUrl."fullcalendar.css");
        $this->cs->registerCssFile($fullCalendarUrl."fullcalendar.print.css");
        $this->cs->registerScriptFile($fullCalendarUrl."fullcalendar.min.js");

        $this->cs->registerScriptFile($this->jsUrl."localPlan.js");

        $this->render("localPlan");
    }

    public function actionDeliveredList(){
        $this->cs->registerScriptFile($this->baseUrl.Yii::app()->assetManager->publish(
            Yii::getPathOfAlias('webroot.js.common.storage')).'/RecordHelper.js'
        );
        
        $criteria = new CDbCriteria();
        $criteria->order = "id desc";
        $count = DeliveredPlan::model()->count($criteria);
        $pages = new CPagination($count);
        $pages->pageSize = 10;
        $pages->applyLimit($criteria);

        $planList = DeliveredPlan::model()->findAll($criteria);

        $this->render("deliveredPlanList",array(
            'planList' => $planList,
            'type' => self::DELIVER_PLAN,
            'pages' => $pages
        ));
    }

    public function actionPrintPlan(){
        $planList = null;
        if(isset($_GET['id'])){
            $recordContent = new RecordContent();
            $planList = $recordContent->getPlanContent($_GET['id']);
        }
        $this->layout="//layouts/blank";
        echo $this->render("printDeliveredPlan",array(
            'planList' => $planList,
            'plan_id' => $_GET['id'],
        ));
    }
}
