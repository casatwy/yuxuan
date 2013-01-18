<?php

class AjaxPlanController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

    public function actionGetPlanEvents(){
        $events = array(
            array(
                'id' => 'event_id_1',
                'title' => 'event_title_1',
                'allDay' => true,
                'start' => time()-(60*60*24),
                'end' => time(),
                'className' => 'J_event',
                'editable' => false,
            ),
            array(
                'id' => 'event_id_2',
                'title' => 'event_title_2',
                'allDay' => false,
                'start' => time()-(60*60*24*2),
                'end' => time()-(60*60*24),
                'className' => 'J_event',
                'editable' => false,
            ),
        );

        echo CJSON::encode($events);
    }

    public function actionGetPlanContent(){
        echo $this->renderPartial("planContent");
    }
}
