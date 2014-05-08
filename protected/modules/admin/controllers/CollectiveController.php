<?php

class CollectiveController extends AdminController
{
	public function actionCreate($list_id)
	{
		$model = new Collective();
		$model->list_id = $list_id;

		if(isset($_POST['Collective']))
		{
			$model->attributes = $_POST['Collective'];
			$success = $model->save();
			if( $success ) {
				$this->redirect(array('/admin/collectivesList/update', 'id'=>$model->list_id));
			}
		}
		$this->render('create', array('model' => $model));
	}

	public function actionUpdate($id)
	{
		$model = $this->loadModel('Collective', $id);
		if(isset($_POST['Collective']))
		{
			$model->attributes = $_POST['Collective'];
			$success = $model->save();
			if( $success ) {
				$this->redirect(array('/admin/collectivesList/update', 'id'=>$model->list_id));
			}
		}
		$this->render('update', array('model' => $model));
	}
}
