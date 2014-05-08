<?php

class CollectiveTeacherController extends AdminController
{
	public function actionCreate($list_id)
	{
		$model = new CollectiveTeacher();
		$model->list_id = $list_id;

		if(isset($_POST['CollectiveTeacher']))
		{
			$model->attributes = $_POST['CollectiveTeacher'];
			$success = $model->save();
			if( $success ) {
				$this->redirect(array('/admin/collectiveTeachersList/update', 'id'=>$model->list_id));
			}
		}
		$this->render('create', array(
			'model' => $model
		));
	}


	public function actionUpdate($id)
	{
		$model = $this->loadModel('CollectiveTeacher', $id);
		if ( isset($_POST['CollectiveTeacher']) )
		{
			$model->attributes = $_POST['CollectiveTeacher'];
			if ( $model->save() ) {
				$this->redirect(array('/admin/collectiveTeachersList/update', 'id'=>$model->list_id));
			}
		}
		$this->render('update', array(
			'model' => $model
		));
	}


	public function actionDelete($id)
	{
		$model = $this->loadModel('CollectiveTeacher', $id);
		$model->delete();
		$this->redirect(array('/admin/collectiveTeachersList/update', 'id'=>$model->list_id));
	}
}
