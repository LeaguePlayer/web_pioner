<?php

class EmployeeListController extends AdminController
{
	public function actionCreate($node_id)
	{
		$model = new EmployeeList();
		$model->node_id = $node_id;
		if ( $model->save() ) {
			$this->redirect(array('/admin/employeeList/update', 'id'=>$model->id));
		} else {
			throw new CHttpException(500, 'Ошибка');
		}
	}


	public function actionUpdate($id)
	{
		$model = $this->loadModel('EmployeeList', $id);

		$finder = new Employee('search');
		$finder->unsetAttributes();
		if ( isset($_GET['Employee']) ) {
			$finder->attributes = $_GET['Employee'];
		}
		$finder->list_id = $model->id;

		$this->render('update', array(
			'model' => $model,
			'finder' => $finder
		));
	}
}
