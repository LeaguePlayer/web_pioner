<?php

class CollectiveGalleriesListController extends AdminController
{
	public function actionCreate($node_id)
	{
		$model = new CollectiveGalleriesList();
		$model->node_id = $node_id;
		if ( $model->save() ) {
			$this->redirect(array('/admin/collectiveGalleriesList/update', 'id'=>$model->id));
		} else {
			throw new CHttpException(500, 'Ошибка пи создании галереи');
		}
	}


	public function actionUpdate($id)
	{
		$model = $this->loadModel('CollectiveGalleriesList', $id);

		$galleryFinder = new CollectiveGallery('search');
		$galleryFinder->unsetAttributes();
		$galleryFinder->list_id = $model->id;
		if ( isset($_GET['CollectiveGallery']) ) {
			$galleryFinder->attributes = $_GET['CollectiveGallery'];
		}
		$galleryFinder->list_id = $model->id;

		$this->render('update', array(
			'model' => $model,
			'galleryFinder' => $galleryFinder
		));
	}
}
