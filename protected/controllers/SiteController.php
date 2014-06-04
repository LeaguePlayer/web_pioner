<?php

class SiteController extends FrontController
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$node = Structure::model()->findByUrl('main');
		if ( $node ) {
			$this->title = Yii::app()->config->get('app.name');
			$this->registerSeoTags($node);
		}

		$activityNodes = Structure::model()->findAllByType('Activity');
		$teenProjectsNode = Structure::model()->findByUrl('teen-projects');
		$teenProgectPageNodes = $teenProjectsNode ? $teenProjectsNode->children()->findAll() : array();

		$criteria = new CDbCriteria();
		$criteria->compare('status', CollectiveNews::STATUS_PUBLISH);
		$criteria->order = 'date_public DESC';
		$news = CollectiveNews::model()->findAll($criteria);

		$this->render('index', array(
			'activityNodes' => $activityNodes,
			'teenProgectPageNodes' => $teenProgectPageNodes,
			'news' => $news
		));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}


	public function actionOrder()
	{
		$order = new Order;
		$response['success'] = false;
		if ( isset($_POST['Order']) ) {
			$order->attributes = $_POST['Order'];
			$order->status = Order::STATUS_NEW;
			if ( $order->save() ) {
				$response['success'] = true;
			}
		}
		echo CJSON::encode($response);
	}
}