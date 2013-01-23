<?php

class PlanController extends Controller
{
    const DELIVER_PLAN = 3;

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
                'actions' => array('index', 'list', 'deliveredList', 'createDeliveredPlan', 'printPlan'),
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
        
        $criteria = new CDbCriteria();
        $criteria->order = "id desc";
        $count = DeliverPlan::model()->count($criteria);
        $pages = new CPagination($count);
        $pages->pageSize = 10;
        $pages->applyLimit($criteria);

        $planList = DeliverPlan::model()->findAll($criteria);

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
