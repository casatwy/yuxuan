<?php

class AjaxAdminController extends Controller
{
	const AVAILABLE = 0;
	const DISAVAILABLE = 1;
	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionSaveUser(){
        foreach($_POST['data'] as $data){
            $user = new User();
            $user->name = htmlspecialchars($data["name"]);
		    $user->telephone = htmlspecialchars($data["tel"]);
		    $user->password = md5(htmlspecialchars($data["pwd"]));
		    $user->authority = $data["authority"];
		    $user->available = self::AVAILABLE;
            $user->save();
        }
	}

    public function actionUpdateUser(){
        $result = array("success" => '0');
        $attributes = array(
            'name' => htmlspecialchars($_POST["data"]["name"]),
            'telephone' => htmlspecialchars($_POST["data"]["tel"]),
            'authority' => $_POST['data']['authority'],
        );
        $res = User::model()->updateByPk($_POST['data']['id'],$attributes);
        Yii::app()->user->setState('authority', $_POST['data']['authority']);
    }

    public function actionUpdateProvider(){
        $result = array( "success" => '0');
        $attributes = array(
            'name' => htmlspecialchars($_POST['data']['name']),
            'location' => htmlspecialchars($_POST['data']['address'])
        );
        Client::model()->updateByPk($_POST['data']['id'],$attributes);
    }

    public function actionSaveType(){
        $result = array('success' => '0');
        $condition = "name=:name";
        $params = array(':name' => $_POST['data']['name']);
        $type = Type::model()->find($condition,$params);

        if(is_null($type)){
            $type = new Type();
            $type->name = htmlspecialchars($_POST["data"]["name"]);
            $type->save();
            $result['success'] = '1';
        }

        echo CJSON::encode($result);
    }

    public function actionUpdateType(){
        $result = array('success' => '0');
        $attributes = array(
            'name' => htmlspecialchars($_POST["data"]["name"]),
        );
        $res = Type::model()->updateByPk($_POST['data']['id'],$attributes);
        if($res){
            $result['success'] = '1';
        }

        echo CJSON::encode($result);
    }

    public function actionUpdatePassword(){
        $user = User::model()->findByPk($_POST['data']['user_id']);
        if(!is_null($user)){
            $user->password = md5($_POST['data']['password']);
            $user->save();
        }
    }
}
