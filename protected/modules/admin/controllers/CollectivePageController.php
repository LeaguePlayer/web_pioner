<?php

class CollectivePageController extends AdminController
{
    public function actionCreate($node_id)
    {
		$model = new CollectivePage();

        $node_id = Yii::app()->request->getQuery('node_id');
        if ( $node_id ) {
            $node = CollectivesStructure::model()->findByPk($node_id);
        }
        if ( $node ) {
            $model->title = $node->name;
			$model->node_id = $node_id;
        }

        if(isset($_POST['CollectivePage']))
        {
            $model->attributes = $_POST['CollectivePage'];
            $success = $model->save();
            if( $success ) {

                if ( $node && $node->name !== $model->title ) {
                    $node->name = $model->title;
                    $node->save();
                }
                $this->redirect(array('/admin/collectivesStructure/list', 'collective_id' => $node->collective->id));
            }
        }
        $this->render('create', array(
			'model' => $model,
		));
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel('CollectivePage', $id);
        if(isset($_POST['CollectivePage']))
        {
            $model->attributes = $_POST['CollectivePage'];
            if( $model->save() ) {
                $node = $model->node;
                if ( $node && $node->name !== $model->title ) {
                    $node->name = $model->title;
                    $node->save();
                }
				$this->redirect(array('/admin/collectivesStructure/list', 'collective_id' => $node->collective->id));
            }
        }
        $this->render('update', array('model' => $model));
    }
}
