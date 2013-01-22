<?php

class AjaxPlanController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

    public function actionGetPlanEvents(){
        $sql = "select dp.time,p.goods_number,p.size,s.color_name from `daily_product` dp "
            ." inner join `product` p on dp.time >=".strtotime($_POST['start'])
            ." and dp.time <".strtotime($_POST['end'])." and dp.product_id = p.id "
            ." inner join `silk` s on p.silk_id = s.id ";
        $daily_messages = Yii::app()->db->createCommand($sql)->queryAll();
        
        $events = array();

        foreach($daily_messages as $m){
            $event = array(
                'title' => $m['goods_number'].'_'.$m['color_name'].'_'.$m['size'],
                'start' => $m['time'],
                'end' => $m['time'],
                'className' => 'J_event',
                'editable' => false,
            );
            array_push($events,$event);
        }
        //$events = array(
        //    array(
        //        'title' => 'event_title_1',
        //        'start' => $record->record_time,
        //        'end' => $record->record_time,
        //        'className' => 'J_event',
        //        'editable' => false,
        //    ),
        //);

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

    public function actionSaveDeliveredPlan(){
    }
}
