<?php

class AjaxStorageController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

    public function actionAjaxsaveinstock(){
        var_dump($_POST);
    }
}
