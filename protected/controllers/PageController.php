<?php

class PageController extends FrontController
{
	public $layout='//layouts/simple';


	public function behaviors()
	{
		return array(
			'InlineWidgetsBehavior'=>array(
				'class'=>'DInlineWidgetsBehavior',
				'location'=>'application.widgets',
				'startBlock'=> '{{w:',
				'endBlock'=> '}}',
				'widgets'=>array(
					'application.widgets.childNodes.ChildNodes',
					'application.widgets.contacts.Contacts',
					'application.widgets.schedule.Schedule',
				),
			),
		);
	}

	
	public function filters()
	{
		return array(
		);
	}

	
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	
	public function actionView($url)
	{
		$node = Structure::model()->findByUrl($url);
		if ( !$node )
			throw new CHttpException(404, "Узел с псевдонимом '$url' не найден");

		$this->breadcrumbs = $node->getBreadcrumbs();
		$this->registerSeoTags($node, 'name');
		$this->render('view',array(
			'page'=>$node->getComponent(),
			'node'=>$node,
		));
	}

	
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Page');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionContacts()
	{
		$node = Structure::model()->findByUrl('contacts');
		if ( !$node ) {
			throw new CHttpException(404, 'Узел с идентификатором "contacts" не найден');
		}

		$this->registerSeoTags($node, 'name');
		$this->render('contacts', array(
			'node' => $node,
			'page' => $node->getComponent()
		));
	}
}
