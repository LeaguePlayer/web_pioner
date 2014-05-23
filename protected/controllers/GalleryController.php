<?php
/**
 * Created by JetBrains PhpStorm.
 * User: megakuzmitch
 * Date: 16.05.14
 * Time: 16:28
 */

class GalleryController extends FrontController
{
	public function actionIndex()
	{
		$node = Structure::model()->findByUrl('gallery');
		if ( $node ) {
			$this->breadcrumbs = $node->getBreadcrumbs();
			$this->registerSeoTags($node, 'name');
		}

		$collectiveGallery = new CollectiveGallery('search');
		$collectiveGallery->status = CollectiveGallery::STATUS_PUBLISH;
		$collectiveGallery->unsetAttributes();

		$this->render('index', array(
			'collectiveGallery' => $collectiveGallery
		));
	}

	public function actionView($id)
	{
		$criteria = new CDbCriteria();
		$criteria->compare('status', CollectiveGallery::STATUS_PUBLISH);
		$model = $this->loadModel('collectiveGallery', $id, $criteria);

		$node = Structure::model()->findByUrl('gallery');
		if ( $node ) {
			$this->breadcrumbs = $node->getBreadcrumbs();
			$node_name = array_pop($this->breadcrumbs);
			$this->breadcrumbs[$node_name] = $this->createUrl('/gallery');
			$this->breadcrumbs[] = $model->name;
		}

		$this->registerSeoTags($model, 'name');
		$this->render('view', array(
			'model' => $model
		));
	}
}