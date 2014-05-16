<?php

class CollectiveController extends FrontController
{
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
		$model = $this->loadModel('Collective', $id);
		$this->render('view',array(
			'model'=>$model,
		));
	}

	
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Collective');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
}
