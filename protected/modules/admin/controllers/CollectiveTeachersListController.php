<?php

class CollectiveTeachersListController extends AdminController
{
	public function actionCreate($node_id)
	{
		$model = new CollectiveTeachersList();
		$model->node_id = $node_id;
		if ( $model->save() ) {
			$this->redirect(array('/admin/collectiveTeachersList/update', 'id'=>$model->id));
		} else {
			throw new CHttpException(500, 'Ошибка');
		}
	}


	public function actionUpdate($id)
	{
		$model = $this->loadModel('CollectiveTeachersList', $id);

		$finder = new CollectiveTeacher('search');
		$finder->unsetAttributes();
		if ( isset($_GET['CollectiveTeacher']) ) {
			$finder->attributes = $_GET['CollectiveTeacher'];
		}
		$finder->list_id = $model->id;

		$this->render('update', array(
			'model' => $model,
			'finder' => $finder
		));
	}
}
