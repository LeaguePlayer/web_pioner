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
		$gallery = new Gallery('search');
		$gallery->unsetAttributes();

		$this->render('index', array(
			'gallery' => $gallery
		));
	}
}