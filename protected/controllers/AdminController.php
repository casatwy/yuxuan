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
                'actions' => array('users', 'clients', 'types', 'adduser', 'updateuser', 'deleteuser'),
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
        $condition = "available=:available";
        $params = array(':available' => '0');
		$users = Users::model()->findAll($condition,$params);
        $this->render('users', array(
			'users' => $users,
		));
    }
	
	public function actionAddUser(){
        $this->cs->registerScriptFile($this->jsCommon."admin.js");
        $this->render('addUser', array(
            'type' => 'add'
        ));
	}

    public function actionUpdateUser(){
        $this->cs->registerScriptFile($this->jsCommon."admin.js");
        $user = Users::model()->findByPk($_GET['id']);
        $this->render('addUser', array(
            'user' => $user,
            'type' => 'update'
        ));
    }
    
    public function actionDeleteUser(){
        $attributes = array('available' => '1');
        $res =  Users::model()->updateByPk($_GET['id'], $attributes);
        Header("location: ".$this->baseUrl.'/admin/users'); 
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
