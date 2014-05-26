<?php
/**
 * Created by JetBrains PhpStorm.
 * User: megakuzmitch
 * Date: 16.05.14
 * Time: 16:28
 */

class GalleryController extends FrontController
{
	public function actionIndex($collective_id = false)
	{
		$node = Structure::model()->findByUrl('gallery');
		if ( $node ) {
			$this->breadcrumbs = $node->getBreadcrumbs();
			$this->registerSeoTags($node, 'name');
		}

		$criteria = new CDbCriteria();
		$criteria->compare('t.status', CollectiveNews::STATUS_PUBLISH);
		$criteria->order = 't.date_publish DESC';
		if ( $collective_id ) {
			$collective = Collective::model()->findByPk($collective_id);
			if ( $collective ) {
				$criteria->with = array('list.node');
				$criteria->compare('node.collective_id', $collective_id);
				$this->breadcrumbs = $collective->list->node->getBreadcrumbs();
				array_pop( $this->breadcrumbs );
				$this->breadcrumbs[$collective->name] = $collective->getUrl();
			}
		}

		$dataProvider = new CActiveDataProvider('CollectiveGallery', array(
			'criteria' => $criteria,
			'pagination' => false
		));

		$this->breadcrumbs[] = 'Фотоотчеты';

		$this->render('index', array(
			'dataProvider' => $dataProvider
		));
	}

	public function actionView($id)
	{
		$criteria = new CDbCriteria();
		$criteria->compare('status', CollectiveGallery::STATUS_PUBLISH);
		$model = $this->loadModel('collectiveGallery', $id, $criteria);
		$this->breadcrumbs = $model->getBreadcrumbs();
		$this->registerSeoTags($model, 'name');
		$this->render('view', array(
			'model' => $model
		));
	}
}