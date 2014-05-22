<?php

class EmployeeController extends AdminController
{
	public function actionCreate($list_id)
	{
		$model = new Employee();
		$model->list_id = $list_id;

		if(isset($_POST['Employee']))
		{
			$model->attributes = $_POST['Employee'];
			$success = $model->save();
			if( $success ) {
				$this->redirect(array('/admin/employeeList/update', 'id'=>$model->list_id));
			}
		}
		$this->render('create', array(
			'model' => $model
		));
	}


	public function actionUpdate($id)
	{
		$model = $this->loadModel('Employee', $id);
		if ( isset($_POST['Employee']) )
		{
			$model->attributes = $_POST['Employee'];
			if ( $model->save() ) {
				$this->redirect(array('/admin/employeeList/update', 'id'=>$model->list_id));
			}
		}
		$this->render('update', array(
			'model' => $model
		));
	}


	public function actionDelete($id)
	{
		$model = $this->loadModel('Employee', $id);
		$model->delete();
		$this->redirect(array('/admin/employeeList/update', 'id'=>$model->list_id));
	}
}
