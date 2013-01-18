<?php 
	
class AdminController extends Controller
{

    public function init(){
        parent::init();
        $this->layout = "//layouts/admin";
        $this->defaultAction = "users";
    }

    public function filters(){
        return array('accessControl');
    }

    public function accessRules(){
        return array(
            array(
                'allow',
                'actions' => array('users', 'clients', 'types', 'adduser'),
                'users' => array('@')
            ),
            array(
                'deny',
                'users' => array('*')
            ),
        );
    }

    public function actionUsers()
    {
		$users = Users::model()->findAll();
        $this->render('users', array(
			'users' => $users,
		));
    }
	
	public function actionAddUser(){
        $this->cs->registerScriptFile($this->jsCommon."admin.js");
		$this->render('addUser');
	}

    public function actionClients()
    {
		$clients = Provider::model()->findall();
        $this->render('clients', array(
			'clients' => $clients,
		));
    }

    public function actionTypes()
    {
		$types = Type::model()->findall();
        $this->render('types', array(
			'types' => $types,
		));
    }
}

?>
