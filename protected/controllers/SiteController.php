<?php

class SiteController extends Controller
{
    public function filters(){
        return array("accessControl");
    }

    public function accessRules(){
        return array(
            array('allow',
                'actions' => array('login', 'index', 'logout', 'error'),
                'users' => array('*')
            ),
            array('deny',
                'users'=>array('*')
            )
        );
    }

    public function actionIndex()
    {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        $this->redirect('site/login');
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if($error=Yii::app()->errorHandler->error)
        {
            if(Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the login page
     */
    public function actionLogin()
    {
        if(!Yii::app()->user->isGuest){
            $this->redirect(Yii::app()->user->returnUrl);
            Yii::app()->end();
        }

        $loginForm=new LoginForm;

        // if it is ajax validation request
        if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
        {
            echo CActiveForm::validate($loginForm);
            Yii::app()->end();
        }

        // collect user input data
        if(isset($_POST['LoginForm']))
        {
            $loginForm->attributes=$_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if($loginForm->validate() && $loginForm->login()){
                $this->redirect(Yii::app()->user->returnUrl);
            }
        }

        //fetch names from database
        $nameRecord = Users::model()->findAllBySql("select name from users;");
        $nameList = array();
        foreach($nameRecord as $item){
            $nameList = array_merge($nameList, array("$item->name" => $item->name));
        }
        unset($nameRecord);

        // display the login form
        $this->render('login',array(
            'loginForm'=>$loginForm,
            'nameList'=>$nameList,
        ));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }
}
