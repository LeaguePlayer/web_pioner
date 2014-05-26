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
}