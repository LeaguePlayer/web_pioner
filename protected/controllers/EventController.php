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
}