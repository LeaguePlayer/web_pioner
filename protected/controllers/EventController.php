<?php
/**
 * Created by JetBrains PhpStorm.
 * User: megakuzmitch
 * Date: 23.05.14
 * Time: 16:31
 */

class EventController extends FrontController
{
	public function filters()
	{
		return CMap::mergeArray(parent::filters(), array(
			'ajaxOnly + loadItems, getEnabledDays, loadDescription'
		));
	}

	public function actionIndex($collective_id)
	{
		$criteria = new CDbCriteria();
		$criteria->compare('t.status', CollectiveNews::STATUS_PUBLISH);
		$criteria->compare('t.type', CollectiveNews::TYPE_EVENT);
		if ( $collective_id ) {
			$collective = Collective::model()->findByPk($collective_id);
			if ( $collective ) {
				$criteria->with = array('list.node');
				$criteria->compare('node.collective_id', $collective_id);
				$this->breadcrumbs = $collective->list->node->getBreadcrumbs();
				array_pop( $this->breadcrumbs );
				$this->breadcrumbs[$collective->name] = $collective->getUrl();
			}
		}
		$criteria->order = 't.date_public DESC';
		$dataProvider = new CActiveDataProvider('CollectiveNews', array(
			'criteria' => $criteria,
			'pagination' => false
		));

		$title = 'Мероприятия';
		$this->breadcrumbs[] = $title;

		$this->render('//news/index', array(
			'title' => $title,
			'dataProvider' => $dataProvider
		));
	}

	public function actionGetEnabledDays()
	{
		$criteria = new CDbCriteria();
		$criteria->compare('status', CollectiveNews::STATUS_PUBLISH);
		$criteria->compare('type', CollectiveNews::TYPE_EVENT);
		$criteria->distinct = 'date_public';
		$criteria->select = 'date_public';
		$criteria->order = 'date_public';
		$events = CollectiveNews::model()->findAll($criteria);
		$response = array();
		foreach ( $events as $event ) {
			$response[] = date('j-n-Y', strtotime($event->date_public));
		}
		echo CJSON::encode($response);
	}

	public function actionLoadItems($date)
	{
        $date = date('Y-m-d', strtotime($date));
		$criteria = new CDbCriteria();
		$criteria->compare('date_public', $date, true);
		$criteria->compare('status', CollectiveNews::STATUS_PUBLISH);
		$criteria->compare('type', CollectiveNews::TYPE_EVENT);
		$criteria->order = 'date_public';
		$dataProvider = new CActiveDataProvider('CollectiveNews', array(
			'criteria' => $criteria,
			'pagination' => false
		));
		$this->renderPartial('_list', array(
			'dataProvider' => $dataProvider
		));
	}

	public function actionLoadDescription($id)
	{
		$criteria = new CDbCriteria();
		$criteria->compare('status', CollectiveNews::STATUS_PUBLISH);
		$model = $this->loadModel('CollectiveNews', $id);
		$this->renderPartial('_desc', array(
			'model' => $model
		));
	}

	public function actionView($id)
	{
		$model = $this->loadModel('CollectiveNews', $id);

		$criteria = new CDbCriteria();
		$criteria->compare('status', CollectiveNews::STATUS_PUBLISH);
		$criteria->addCondition('id<>:id');
		$criteria->params[':id'] = $model->id;
		$criteria->order = 'date_public DESC';
		$feedNews = CollectiveNews::model()->findAll($criteria);

		$criteria->limit = 4;
		$criteria->compare('type', $model->type);
		$otherNewsData = new CActiveDataProvider('CollectiveNews', array(
			'criteria' => $criteria,
			'pagination' => false
		));

		$this->registerSeoTags($model, 'title');
		$this->breadcrumbs = $model->getBreadcrumbs();
		$this->render('//news/view', array(
			'model'=>$model,
			'feedNews'=>$feedNews,
			'otherNewsData'=>$otherNewsData
		));
	}


    public function actionCalendar()
    {
        $this->render('calendar');
    }

    public function actionFeed($start, $end)
    {
        Yii::app()->cache->flush();

        $startTime = strtotime($start);
        $endTime = strtotime($end);
        if ( date('d', $endTime) > 1 ) {
            $start_date = date('Y-m-d', strtotime('first day of +1 month', $startTime));
        } else {
            $start_date = date('Y-m-d', $startTime);
        }
        if ( date('d', $endTime) < 28 ) {
            $end_date = date('Y-m-d', strtotime('last day of -1 month', $endTime));
        } else {
            $end_date = date('Y-m-d', $endTime);
        }


        $criteria = new CDbCriteria();
        $criteria->addCondition(':l_date<=date_public');
        $criteria->addCondition('date_public<=:r_date');
        $criteria->compare('status', CollectiveNews::STATUS_PUBLISH);
        $criteria->compare('type', CollectiveNews::TYPE_EVENT);
        $criteria->order = 'date_public';
        $criteria->params[':l_date'] = $start_date;
        $criteria->params[':r_date'] = $end_date;
        $events = CollectiveNews::model()->findAll($criteria);

        $number = 0;
        $prevDatePublic = false;
        $eventsNumbers = array();
        $eventCounts = array();
        foreach ( $events as $i => $event ) {
            if ( $event->date_public == $prevDatePublic ) {
                $number++;
            } else {
                $number = 0;
                $prevDatePublic = $event->date_public;
            }
            if ( $number > 2 ) {
                continue;
            }
            $eventsNumbers[$i] = $number;
            $eventCounts[$event->date_public] = $number + 1;
        }

        $response = array();
        foreach ( $events as $i => $event ) {
            if ( !array_key_exists($i, $eventsNumbers) ) {
                continue;
            }
            $response[] = array(
                'id' => $event->id,
                'title' => $event->title,
                'photo' => $event->getImageUrl('small'),
                'start' => date('Y-m-d', strtotime($event->date_public)),
                'end' => date('Y-m-d', strtotime($event->date_public)),
                'number' => $eventsNumbers[$i],
                'full_count' => $eventCounts[$event->date_public],
            );
        }

        echo CJSON::encode($response);
    }


    public function actionLoadCalendarItems($date)
    {
        $date = date('Y-m-d', strtotime($date));

        $criteria = new CDbCriteria();
        $criteria->compare('date_public', $date, true);
        $criteria->compare('status', CollectiveNews::STATUS_PUBLISH);
        $criteria->compare('type', CollectiveNews::TYPE_EVENT);
        $criteria->order = 'date_public';
        $dataProvider = new CActiveDataProvider('CollectiveNews', array(
            'criteria' => $criteria,
            'pagination' => false
        ));
        $this->renderPartial('_list', array(
            'dataProvider' => $dataProvider,
            'itemView' => '_calendar_event',
        ));
    }
}