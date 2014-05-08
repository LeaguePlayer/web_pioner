<?php

class ActivityController extends AdminController
{
	public function actionCreate($node_id)
	{
		$model = new Activity();

		$node_id = Yii::app()->request->getQuery('node_id');
		if ( $node_id ) {
			$node = Structure::model()->findByPk($node_id);
		}
		if ( $node ) {
			$model->name = $node->name;
		}
		if ( $model->save() ) {
			$this->redirect(array('/admin/structure/list', 'opened' => $node->id));
		}

		if(isset($_POST['Activity']))
		{
			$model->attributes = $_POST['Activity'];
			if( $model->save() ) {
				if ( $node && $node->name !== $model->name ) {
					$node->name = $model->name;
					$node->saveNode();
				}
				$this->redirect(array('/admin/structure/list', 'opened' => $model->node_id));
			}
		}
		$this->render('create', array('model' => $model));
	}


	public function actionUpdate($id)
	{
		$model = $this->loadModel('Activity', $id);
		if(isset($_POST['Activity']))
		{
			$model->attributes = $_POST['Activity'];
			if( $model->save() ) {
				$node = $model->node;
				if ( $node && $node->name !== $model->name ) {
					$node->name = $model->name;
					$node->saveNode();
				}
				$this->redirect(array('/admin/structure/list', 'opened' => $node->id));
			}
		}
		$this->render('update', array('model' => $model));
	}
}
