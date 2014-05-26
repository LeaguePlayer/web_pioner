<?php

class SectionController extends FrontController
{
	public $layout='//layouts/simple';

	
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

		$collectives = array();
		$collectivesListNode = $node->children()->find();
		if ( $collectivesListNode ) {
			$collectivesList = $collectivesListNode->getComponent();
			$collectives = $collectivesList->collectives;
		}

		$this->breadcrumbs = $node->getBreadcrumbs();
		$this->registerSeoTags($node, 'name');
		$this->render('view',array(
			'node'=>$node,
			'collectives'=>$collectives
		));
	}

	
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Section');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}


	public function actionLoadCollectives($url)
	{
		$sectionNode = Structure::model()->findByUrl($url);
		if ( !$sectionNode ) {
			return;
		}

		$collectivesListNode = $sectionNode->children()->find();
		if ( !$collectivesListNode ) {
			return;
		}

		$collectivesList = $collectivesListNode->getComponent();
		if ( !$collectivesList ) {
			return;
		}

		echo $this->renderPartial('_collectives', array(
			'dataProvider' => $collectivesList->getCollectivesData()
		));
	}
}
