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
            array(
                'title' => 'event_title_2',
                'start' => $record2->record_time,
                'end' => $record2->record_time,
                'className' => 'J_event',
                'editable' => false,
            ),
            array(
                'title' => 'event_title_2',
                'start' => $record2->record_time,
                'end' => $record2->record_time,
                'className' => 'J_event',
                'editable' => false,
            ),
            array(
                'title' => 'event_title_2',
                'start' => $record2->record_time,
                'end' => $record2->record_time,
                'className' => 'J_event',
                'editable' => false,
            ),
            array(
                'title' => 'event_title_2',
                'start' => $record2->record_time,
                'end' => $record2->record_time,
                'className' => 'J_event',
                'editable' => false,
            ),
            array(
                'title' => 'event_title_2',
                'start' => $record2->record_time,
                'end' => $record2->record_time,
                'className' => 'J_event',
                'editable' => false,
            ),
            array(
                'title' => 'event_title_2',
                'start' => $record2->record_time,
                'end' => $record2->record_time,
                'className' => 'J_event',
                'editable' => false,
            ),
            array(
                'title' => 'event_title_2',
                'start' => $record2->record_time,
                'end' => $record2->record_time,
                'className' => 'J_event',
                'editable' => false,
            ),
            array(
                'title' => 'event_title_2',
                'start' => $record2->record_time,
                'end' => $record2->record_time,
                'className' => 'J_event',
                'editable' => false,
            ),
            array(
                'title' => 'event_title_2',
                'start' => $record2->record_time,
                'end' => $record2->record_time,
                'className' => 'J_event',
                'editable' => false,
            ),
            array(
                'title' => 'event_title_2',
                'start' => $record2->record_time,
                'end' => $record2->record_time,
                'className' => 'J_event',
                'editable' => false,
            ),
            array(
                'title' => 'event_title_2',
                'start' => $record2->record_time,
                'end' => $record2->record_time,
                'className' => 'J_event',
                'editable' => false,
            ),
            array(
                'title' => 'event_title_2',
                'start' => $record2->record_time,
                'end' => $record2->record_time,
                'className' => 'J_event',
                'editable' => false,
            ),
            array(
                'title' => 'event_title_2',
                'start' => $record2->record_time,
                'end' => $record2->record_time,
                'className' => 'J_event',
                'editable' => false,
            ),
            array(
                'title' => 'event_title_2',
                'start' => $record2->record_time,
                'end' => $record2->record_time,
                'className' => 'J_event',
                'editable' => false,
            ),
            array(
                'title' => 'event_title_2',
                'start' => $record2->record_time,
                'end' => $record2->record_time,
                'className' => 'J_event',
                'editable' => false,
            ),
            array(
                'title' => 'event_title_2',
                'start' => $record2->record_time,
                'end' => $record2->record_time,
                'className' => 'J_event',
                'editable' => false,
            ),
            array(
                'title' => 'event_title_2',
                'start' => $record2->record_time,
                'end' => $record2->record_time,
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
             color_name
             size
             total
             finished
         */
    }
}
