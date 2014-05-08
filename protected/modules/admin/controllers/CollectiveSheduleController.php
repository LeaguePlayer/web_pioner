<?php

class CollectiveSheduleController extends AdminController
{
	public function actionCreate($node_id)
	{
		$model = new CollectiveShedule();
		$model->node_id = $node_id;

		if(isset($_POST['CollectiveShedule']))
		{
			$model->attributes = $_POST['CollectiveShedule'];
			if( $model->save() ) {
				$this->redirect(array('/admin/collectivesStructure/list', 'collective_id' => $model->node->collective->id));
			}
		}
		$this->render('create', array(
			'model' => $model,
		));
	}

	public function actionUpdate($id)
	{
		$model = $this->loadModel('CollectiveShedule', $id);
		if(isset($_POST['CollectiveShedule']))
		{
			$model->attributes = $_POST['CollectiveShedule'];
			if( $model->save() ) {
				$this->redirect(array('/admin/collectivesStructure/list', 'collective_id' => $model->node->collective->id));
			}
		}
		$this->render('update', array('model' => $model));
	}
}
