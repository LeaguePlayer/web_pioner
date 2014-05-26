<?php

class ActivityController extends FrontController
{
	public function actionView($url)
	{
		$node = Structure::model()->findByUrl($url);
		if ( !$node )
			throw new CHttpException(404, "Узел с псевдонимом '$url' не найден");

		$this->breadcrumbs = $node->getBreadcrumbs();
		$this->registerSeoTags($node, 'name');
		$this->render('view',array(
			'node'=>$node,
		));
	}
}
