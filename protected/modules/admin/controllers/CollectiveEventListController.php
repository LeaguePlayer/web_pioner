<?php
/**
 * Created by JetBrains PhpStorm.
 * User: megakuzmitch
 * Date: 26.05.14
 * Time: 18:30
 */

class CollectiveEventListController extends AdminController
{
	public function actionCreate($node_id)
	{
		$model = new CollectiveEventList();
		$model->node_id = $node_id;
		$model->page_size = 5;
		$success = $model->save();
		if( $success ) {
			$this->redirect(array('/admin/collectiveEventList/update', 'id'=>$model->id));
		} else {
			$this->render('//collectiveNewsList/create', array('model' => $model));
		}
	}

	public function actionUpdate($id)
	{
		$model = $this->loadModel('CollectiveEventList', $id);
		$newsFinder = new CollectiveNews('search');
		$newsFinder->unsetAttributes();
		$newsFinder->type = CollectiveNews::TYPE_EVENT;
		$newsFinder->list_id = $model->id;
		if ( isset($_GET['CollectiveNews']) ) {
			$newsFinder->attributes = $_GET['CollectiveNews'];
		}

		if(isset($_POST['CollectiveEventList']))
		{
			$model->attributes = $_POST['CollectiveNewsList'];
			$success = $model->save();
			if( $success ) {
				Yii::app()->user->setFlash('SAVED', 'Настройки сохранены');
			}
		}
		$this->render('/collectiveNewsList/update', array(
			'model' => $model,
			'newsFinder' => $newsFinder
		));
	}
}