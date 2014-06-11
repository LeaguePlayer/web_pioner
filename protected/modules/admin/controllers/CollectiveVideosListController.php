<?php

class CollectiveVideosListController extends AdminController
{
	public function actionCreate($node_id)
	{
		$model = new CollectiveVideosList();
		$model->node_id = $node_id;
		if ( $model->save() ) {
			$this->redirect(array('/admin/collectiveVideosList/update', 'id'=>$model->id));
		} else {
			throw new CHttpException(500, 'Ошибка пи создании галереи');
		}
	}


	public function actionUpdate($id)
	{
		$model = $this->loadModel('CollectiveVideosList', $id);

        $videoFinder = new CollectiveVideo('search');
        $videoFinder->unsetAttributes();
        $videoFinder->list_id = $model->id;
		if ( isset($_GET['CollectiveVideo']) ) {
            $videoFinder->attributes = $_GET['CollectiveVideo'];
		}
        $videoFinder->list_id = $model->id;

		$this->render('update', array(
			'model' => $model,
			'videoFinder' => $videoFinder
		));
	}
}
