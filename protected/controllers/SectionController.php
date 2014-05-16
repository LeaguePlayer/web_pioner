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

	
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel('Section', $id),
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
