<?php

class SectionController extends AdminController
{
	public function actionCreate($node_id)
	{
		$model = new Section();
		$node_id = Yii::app()->request->getQuery('node_id');
		if ( $node_id ) {
			$node = Structure::model()->findByPk($node_id);
		}
		if ( $node ) {
			$model->name = $node->name;
			$this->addCollectiveNode($node);
		}
		if ( $model->save() ) {
			$this->redirect(array('/admin/structure/list', 'opened' => $node->id));
		}
		if (isset($_POST['Section']))
		{
			$model->attributes = $_POST['Section'];
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
		$model = $this->loadModel('Section', $id);
		$model->name = $model->node->name;
		if(isset($_POST['Section']))
		{
			$model->attributes = $_POST['Section'];
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


	protected function addCollectiveNode(Structure $node)
	{
		$collectiveNode = new Structure();
		$material = Material::model()->findByAttributes(array(
			'class_name' => 'CollectivesList',
		));
		$collectiveNode->material_id = $material->id;
		$collectiveNode->name = 'Коллективы';
		$collectiveNode->url = $node->url.'-'.'collectives';
		$collectiveNode->status = EActiveRecord::STATUS_PUBLISH;
		$collectiveNode->appendTo($node);
	}
}
