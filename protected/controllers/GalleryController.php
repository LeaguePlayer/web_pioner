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
		$collectiveGallery = $this->loadModel('collectiveGallery', $id, $criteria);
		$this->render('view', array(
			'collectiveGallery' => $collectiveGallery
		));
	}
}