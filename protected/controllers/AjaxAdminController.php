<?php

class AjaxAdminController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionSaveUser(){
        $result = array( "success" => '0');
        $condition = "name=:name";
        $params = array(':name' => htmlspecialchars($_POST['data']['name']));
        $user = Users::model()->find($condition,$params);

        if(is_null($user)){
            $user = new Users();
            $user->name = htmlspecialchars($_POST["data"]["name"]);
		    $user->telephone = htmlspecialchars($_POST["data"]["tel"]);
		    $user->password = md5(htmlspecialchars($_POST["data"]["pwd"]));
		    $user->authority = "authority";
		    //$user->authority = htmlspecialchars($_POST["authority"]);
            $user->save();
            $result['success'] = '1';
        }

        echo CJSON::encode($result);
	}

}
