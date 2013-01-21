<?php

class AjaxPlanController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

    public function actionGetPlanEvents(){
        //$record = ReceiveRecordItem::model()->findByPk("1");
        //$record2 = ReceiveRecordItem::model()->findByPk("2");
        
        $sql = "select p.goods_number,p.size,s.color_name from `daily_product` dp "
            ." inner join `product` p on dp.time >=".strtotime($_POST['start'])
            ." dp.time <".strtotime($_POST['end'])." dp.product_id = p.id "
            ." inner join `silk` s on p.silk_id = s.id ";
        $events = Yii::app()->db->createCommand($sql)->queryAll();
        
        var_dump($events);
        //$events = array(
        //    array(
        //        'title' => 'event_title_1',
        //        'start' => $record->record_time,
        //        'end' => $record->record_time,
        //        'className' => 'J_event',
        //        'editable' => false,
        //    ),
        //    array(
        //        'title' => 'event_title_2',
        //        'start' => $record2->record_time,
        //        'end' => $record2->record_time,
        //        'className' => 'J_event',
        //        'editable' => false,
        //    ),
        //    array(
        //        'title' => 'event_title_2',
        //        'start' => $record2->record_time,
        //        'end' => $record2->record_time,
        //        'className' => 'J_event',
        //        'editable' => false,
        //    ),
        //    array(
        //        'title' => 'event_title_2',
        //        'start' => $record2->record_time,
        //        'end' => $record2->record_time,
        //        'className' => 'J_event',
        //        'editable' => false,
        //    ),
        //    array(
        //        'title' => 'event_title_2',
        //        'start' => $record2->record_time,
        //        'end' => $record2->record_time,
        //        'className' => 'J_event',
        //        'editable' => false,
        //    ),
        //    array(
        //        'title' => 'event_title_2',
        //        'start' => $record2->record_time,
        //        'end' => $record2->record_time,
        //        'className' => 'J_event',
        //        'editable' => false,
        //    ),
        //    array(
        //        'title' => 'event_title_2',
        //        'start' => $record2->record_time,
        //        'end' => $record2->record_time,
        //        'className' => 'J_event',
        //        'editable' => false,
        //    ),
        //    array(
        //        'title' => 'event_title_2',
        //        'start' => $record2->record_time,
        //        'end' => $record2->record_time,
        //        'className' => 'J_event',
        //        'editable' => false,
        //    ),
        //    array(
        //        'title' => 'event_title_2',
        //        'start' => $record2->record_time,
        //        'end' => $record2->record_time,
        //        'className' => 'J_event',
        //        'editable' => false,
        //    ),
        //    array(
        //        'title' => 'event_title_2',
        //        'start' => $record2->record_time,
        //        'end' => $record2->record_time,
        //        'className' => 'J_event',
        //        'editable' => false,
        //    ),
        //    array(
        //        'title' => 'event_title_2',
        //        'start' => $record2->record_time,
        //        'end' => $record2->record_time,
        //        'className' => 'J_event',
        //        'editable' => false,
        //    ),
        //    array(
        //        'title' => 'event_title_2',
        //        'start' => $record2->record_time,
        //        'end' => $record2->record_time,
        //        'className' => 'J_event',
        //        'editable' => false,
        //    ),
        //    array(
        //        'title' => 'event_title_2',
        //        'start' => $record2->record_time,
        //        'end' => $record2->record_time,
        //        'className' => 'J_event',
        //        'editable' => false,
        //    ),
        //    array(
        //        'title' => 'event_title_2',
        //        'start' => $record2->record_time,
        //        'end' => $record2->record_time,
        //        'className' => 'J_event',
        //        'editable' => false,
        //    ),
        //    array(
        //        'title' => 'event_title_2',
        //        'start' => $record2->record_time,
        //        'end' => $record2->record_time,
        //        'className' => 'J_event',
        //        'editable' => false,
        //    ),
        //    array(
        //        'title' => 'event_title_2',
        //        'start' => $record2->record_time,
        //        'end' => $record2->record_time,
        //        'className' => 'J_event',
        //        'editable' => false,
        //    ),
        //    array(
        //        'title' => 'event_title_2',
        //        'start' => $record2->record_time,
        //        'end' => $record2->record_time,
        //        'className' => 'J_event',
        //        'editable' => false,
        //    ),
        //    array(
        //        'title' => 'event_title_2',
        //        'start' => $record2->record_time,
        //        'end' => $record2->record_time,
        //        'className' => 'J_event',
        //        'editable' => false,
        //    ),
        //);

        //echo CJSON::encode($events);
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
             color_name
             size
             total
             finished
         */
    }
}
