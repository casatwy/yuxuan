<?php

class AjaxStorageController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

    public function actionSaveinstock(){

        var_dump($_POST);die();

        $result = array(
            "success" => 1,
            "content" => "here i am"
        );

        echo CJSON::encode($result);
    }
}
