<?php

class CollectivesListController extends AdminController
{
	public function actionCreate()
	{
		$model = new CollectivesList;
		$success = $model->save();
		if( $success ) {
			$this->redirect(array('/admin/collectivesList/update', 'id'=>$model->id));
		} else {
			$this->render('create', array('model' => $model));
		}
	}

	public function actionUpdate($id)
	{
		$model = $this->loadModel('CollectivesList', $id);
		$collectiveFinder = new Collective('search');
		$collectiveFinder->unsetAttributes();
		if ( isset($_GET['Collective']) ) {
			$collectiveFinder->attributes = $_GET['News'];
		}
		$collectiveFinder->list_id = $model->id;

		if(isset($_POST['CollectivesList']))
		{
			$model->attributes = $_POST['CollectivesList'];
			$success = $model->save();
			if( $success ) {
				Yii::app()->user->setFlash('SAVED', 'Настройки сохранены');
			}
		}
		$this->render('update', array(
			'model' => $model,
			'collectiveFinder' => $collectiveFinder
		));
	}
}
