<?php

class AjaxPlanController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

    public function actionGetPlanEvents(){
        $record = ReceiveRecordItem::model()->findByPk("1");
        $record2 = ReceiveRecordItem::model()->findByPk("2");
        $events = array(
            array(
                'title' => 'event_title_1',
                'start' => $record->record_time,
                'end' => $record->record_time,
                'className' => 'J_event',
                'editable' => false,
            ),
        );

        echo CJSON::encode($events);
    }

    public function actionGetPlanContent(){
        echo $this->renderPartial("planContent");
    }

    public function actionGetDayContent(){
        echo $this->renderPartial("dayContent");
    }

    public function actionSaveDailyRecord(){
        /*
             goods_number
             color_number
             needle_type
             color_name
             size
             total
             finished
         */
        $product_id = Product::findExistedProduct($_POST);
        if(!$product_id){//create a product based on the silk
            $product_id = Product::createNew($_POST);
        }
        $daily = new DailyProduct;
        $daily->time = time();
        $daily->product_id = $product_id;
        $daily->count = $_POST['finished'];
        $daily->goods_number = $_POST['goods_number'];
        $daily->save();
    }
}
