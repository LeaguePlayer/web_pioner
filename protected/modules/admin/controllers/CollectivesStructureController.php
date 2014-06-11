<?php

class CollectivesStructureController extends AdminController
{
	public function actionList($collective_id)
	{
		$collective = Collective::model()->findByPk($collective_id);
		$model = new CollectivesStructure('search');
		$model->unsetAttributes();
		if ( isset( $_GET['CollectivesStructure'] ) ) {
			$model->attributes = $_GET['CollectivesStructure'];
		}
		$model->collective_id = $collective_id;
		$this->render('list', array(
			'model'=>$model,
			'collective' => $collective
		));
	}


	public function actionCreate($collective_id)
	{
		$collective = Collective::model()->findByPk($collective_id);
		$model = new CollectivesStructure();
		$model->collective_id = $collective_id;
		if ( isset($_POST['CollectivesStructure']) ) {
			$model->attributes = $_POST['CollectivesStructure'];
			if ( $model->save() ) {
				$controllerID = lcfirst($model->material->class_name);
				$this->redirect(array("/admin/{$controllerID}/create", 'node_id'=>$model->id));
			}
		}
		$this->render('create', array(
			'model' => $model,
			'collective' => $collective,
		));
	}


	// Обновление раздела
	public function actionUpdate($id)
	{
		$model = CollectivesStructure::model()->findByPk($id);
		if ( !$model ) {
			throw new CHttpException(404, 'Раздел не найден');
		}

		$oldMaterialId = $model->material_id;
		if ( isset($_POST['CollectivesStructure']) ) {
			$model->attributes = $_POST['CollectivesStructure'];
			if ( $model->save() ) {
				if ( $model->material_id !== $oldMaterialId ) {
					$component = $model->getComponent();
					if ( $component ) {
						$component->delete();
					}
					$model->refresh();
					$controllerID = strtolower($model->material->class_name);
					$this->redirect(array("/admin/{$controllerID}/create", 'node_id'=>$model->id));
				}
				$this->redirect( array('list', 'collective_id' => $model->collective->id) );
			}
		}
		$this->layout = '/layouts/admin_columns';
		$this->render('update', array(
			'model' => $model,
		));
	}


	public function actionDelete($id)
	{
		$model = $this->loadModel('CollectivesStructure', $id);
		$model->delete();
	}


	public function actionUpdateMaterial($node_id) {
		$node = CollectivesStructure::model()->findByPk($node_id);
		if ( !$node ) {
			throw new CHttpException(404, 'Раздел не найден');
		}
		$modelName = $node->material->class_name;
		$model = CActiveRecord::model($modelName)->findByAttributes(array(
			'node_id'=>$node_id
		));
		$controllerID = lcfirst($modelName);
		if ( !$model )
			$this->redirect(array("/admin/{$controllerID}/create", 'node_id'=>$node_id));
		$this->redirect(array("/admin/{$controllerID}/update", 'id'=>$model->id, 'node_id'=>$node_id));
	}


	public function actionMoveDown()
	{
		$id = $_POST['id'];
		$node = $this->loadModel('Structure', $id);
		$nextNode = $node->next()->find();
		if ( !$nextNode ) {
			$success = false;
		} else if ( $node->moveAfter($nextNode) ) {
			$success = true;
		} else {
			$success = false;
		}
		echo CJSON::encode(array('success'=>$success, 'action'=>'down'));
	}


	public function actionMoveUp()
	{
		$id = $_POST['id'];
		$node = $this->loadModel('Structure', $id);
		$prevNode = $node->prev()->find();
		if ( !$prevNode ) {
			$success = false;
		} else if ( $node->moveBefore($prevNode) ) {
			$success = true;
		} else {
			$success = false;
		}
		echo CJSON::encode(array('success'=>$success, 'action'=>'up'));
	}


	public function actionMoveToNext()
	{
		$id = $_POST['id'];
		$node = $this->loadModel('Structure', $id);
		$nextNode = $node->next()->find();
		if ( !$nextNode ) {
			$success = false;
		} else if ( $node->moveAsFirst($nextNode) ) {
			$success = true;
		} else {
			$success = false;
		}
		echo CJSON::encode(array('success'=>$success, 'action'=>'toNext'));
	}


	public function actionMoveToParent()
	{
		$id = $_POST['id'];
		$node = $this->loadModel('Structure', $id);
		$parentNode = $node->parent()->find();
		if ( !$parentNode ) {
			$success = false;
		} else if ( $node->moveBefore($parentNode) ) {
			$success = true;
		} else {
			$success = false;
		}
		echo CJSON::encode(array('success'=>$success, 'action'=>'toParent'));
	}
}
