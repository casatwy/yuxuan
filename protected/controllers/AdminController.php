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
                'actions' => array('users', 'clients', 'types', 'adduser', 'updateuser', 'deleteuser', 
                                    'updateClient', 'addType', 'updateType'),
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
        $this->cs->registerScriptFile($this->jsCommon."admin.js");
        $condition = "available=:available";
        $params = array(':available' => '0');
		$users = Users::model()->findAll($condition,$params);
        $this->render('users', array(
			'users' => $users,
		));
    }
	
	public function actionAddUser(){
        $this->cs->registerScriptFile($this->jsCommon."admin.js");
        $condition = "available=:available";
        $params = array(':available' => '0');
		$users = Users::model()->findAll($condition,$params);
        $user = array();
        foreach($users as $u){
            $user[] = $u->name;
        }

        $this->render('addUser', array(
            'type' => 'addUser',
            'user' => CJSON::encode($user)
        ));
	}

    public function actionUpdateUser(){
        //$this->cs->registerScriptFile($this->jsCommon."admin.js");
        $user = Users::model()->findByPk($_GET['id']);
        $authority = $this->getAuthority($user->authority);
        echo $this->renderPartial('addUser', array(
            'user' => $user,
            'type' => 'updateUser',
            'authority' => $authority,
        ));
        Yii::app()->end();
    }
    
    public function actionDeleteUser(){
        $attributes = array('available' => '1');
        $res =  Users::model()->updateByPk($_GET['id'], $attributes);
        Header("location: ".$this->baseUrl.'/admin/users'); 
    }

    public function actionClients()
    {
        $this->cs->registerScriptFile($this->jsCommon."admin.js");
		$clients = Provider::model()->findall();
        $this->render('clients', array(
			'clients' => $clients,
		));
    }

    public function actionUpdateClient(){
        $this->cs->registerScriptFile($this->jsCommon."admin.js");
        $user = Users::model()->findByPk($_GET['id']);
        $client = Provider::model()->findByPk($_GET['id']);
        echo $this->renderPartial('addClient',array(
            'client' => $client,
        ));
        Yii::app()->end();
    }

    public function actionTypes()
    {
        $this->cs->registerScriptFile($this->jsCommon."admin.js");
		$types = Type::model()->findall();
        $this->render('types', array(
			'types' => $types,
		));
    }

    public function actionAddType(){
        $this->cs->registerScriptFile($this->jsCommon."admin.js");
        $this->render('addType', array(
            'kind' => 'add',
        ));
    }

    public function actionUpdateType(){
        $this->cs->registerScriptFile($this->jsCommon."admin.js");
        $type = Type::model()->findByPk($_GET['id']);
        echo $this->renderPartial('addType', array(
            'type' => $type,
            'kind' => 'update', 
        ));
        Yii::app()->end();
    }

    private function getAuthority($num){
        $result = array();
        $allAuts = array(2,3,5,7,11,13,17,19,23,29,31,37);
        foreach($allAuts as $aut){
            if(($num % $aut) == 0){
                $result[] = $aut;
            }
        }
        return CJSON::encode($result);
    }
}

?>
