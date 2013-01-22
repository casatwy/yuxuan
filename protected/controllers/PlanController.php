<?php

class PlanController extends Controller
{

    public function init(){
        parent::init();
        $this->layout = "//layouts/plan";
        $this->defaultAction = "list";
    }

    public function filters(){
        return array('accessControl');
    }

    public function accessRules(){
        return array(
            array(
                'allow',
                'actions' => array('index', 'list', 'deliveredList', 'createDeliveredPlan'),
                'users' => array('@')
            ),
            array(
                'deny',
                'users' => array('*')
            ),
        );
    }

    public function actionCreateDeliveredPlan(){
        $type = Type::model()->findAll();
        $this->cs->registerScriptFile($this->baseUrl.Yii::app()->assetManager->publish(
            Yii::getPathOfAlias('webroot.js.common.storage')).'/RecordHelper.js'
        );
        $this->cs->registerScriptFile($this->jsUrl."createDeliveredPlan.js");
        $this->render("createDeliveredPlan", array(
            'type' => $type,
        ));
    }

    public function actionList()
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
        $this->render("deliveredPlanList");
    }
}
