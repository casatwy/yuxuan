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
                'actions' => array('index', 'list', 'historyList'),
                'users' => array('@')
            ),
            array(
                'deny',
                'users' => array('*')
            ),
        );
    }

    public function actionIndex()
    {
        $this->render("index");
    }

    public function actionList()
    {
        $this->render("index");
    }

    public function actionHistoryList()
    {
        $this->render("index");
    }
}
