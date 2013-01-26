<?php

class AjaxAdminController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionSaveUser(){
        $result = array( "success" => '0');
        foreach($_POST['data'] as $data){
            $user = new Users();
            $user->name = htmlspecialchars($data["name"]);
		    $user->telephone = htmlspecialchars($data["tel"]);
		    $user->password = md5(htmlspecialchars($data["pwd"]));
		    $user->authority = $data["authority"];
            if($user->save()){
                $result['success'] = '1';
            }else{
                $result['success'] = '0';
                break;
            }
        }

        echo CJSON::encode($result);
	}

    public function actionUpdateUser(){
        $result = array( "success" => '0');
        $attributes = array(
            'name' => htmlspecialchars($_POST["data"]["name"]),
            'telephone' => htmlspecialchars($_POST["data"]["tel"]),
            'password' => md5(htmlspecialchars($_POST["data"]["pwd"])),
            'authority' => $_POST['data']['authority'],
        );
        $res = Users::model()->updateByPk($_POST['data']['id'],$attributes);
        if($res){
            $result['success'] = '1';
        }
        echo CJSON::encode($result);
    }

    public function actionUpdateProvider(){
        $result = array( "success" => '0');
        $attributes = array(
            'name' => htmlspecialchars($_POST['data']['name']),
            'location' => htmlspecialchars($_POST['data']['address'])
        );
        $res = Provider::model()->updateByPk($_POST['data']['id'],$attributes);
        if($res){
            $result['success'] = '1';
        }
        echo CJSON::encode($result);
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
}
