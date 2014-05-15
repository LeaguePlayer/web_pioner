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
				$this->createNodes($model);
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



	protected function createNodes(Collective $collective)
	{
		$criteria = new CDbCriteria();
		$criteria->addInCondition('class_name', array('CollectivePage', 'CollectiveGalleriesList', 'CollectiveTeachersList', 'CollectiveNewsList'));
		$materialsTypes = Material::model()->findAll($criteria);
		foreach ( $materialsTypes as $material ) {
			$node = new CollectivesStructure();
			$node->collective_id = $collective->id;
			$node->material_id = $material->id;
			$node->name = $material->name;
			$node->save();
		}
	}
}
