<?php

class PlaceController extends AdminController
{
	public function actionCreate($list_id)
	{
		$model = new Place();
		$model->list_id = $list_id;

		if(isset($_POST['Place']))
		{
			$model->attributes = $_POST['Place'];
			$success = $model->save();
			if( $success ) {
				$this->redirect(array('/admin/placesList/update', 'id'=>$model->list_id));
			}
		}
		$this->render('create', array('model' => $model));
	}

	public function actionUpdate($id)
	{
		$model = $this->loadModel('Place', $id);
		if(isset($_POST['Place']))
		{
			$model->attributes = $_POST['Place'];
			$success = $model->save();
			if( $success ) {
				$this->redirect(array('/admin/placesList/update', 'id'=>$model->list_id));
			}
		}
		$this->render('update', array('model' => $model));
	}
}
