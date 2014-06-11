<?php
/**
 * Created by JetBrains PhpStorm.
 * User: megakuzmitch
 * Date: 16.05.14
 * Time: 16:28
 */

class VideoController extends FrontController
{
	public function actionIndex($collective_id = false)
	{
		$node = Structure::model()->findByUrl('video');
		if ( $node ) {
			$this->breadcrumbs = $node->getBreadcrumbs();
			$this->registerSeoTags($node, 'name');
		}

		$criteria = new CDbCriteria();
		$criteria->compare('t.status', CollectiveVideo::STATUS_PUBLISH);
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

		$dataProvider = new CActiveDataProvider('CollectiveVideo', array(
			'criteria' => $criteria,
			'pagination' => false
		));

		$this->breadcrumbs[] = 'Видеоотчеты';

		$this->render('index', array(
			'dataProvider' => $dataProvider
		));
	}

	public function actionView($id)
	{
		$criteria = new CDbCriteria();
		$criteria->compare('status', CollectiveVideo::STATUS_PUBLISH);
		$model = $this->loadModel('CollectiveVideo', $id, $criteria);
        $criteria->addCondition('id<>:id');
        $criteria->params[':id'] = $model->id;
        $criteria->order = 'date_publish DESC';
        $criteria->limit = 10;
        $otherVideosData = new CActiveDataProvider('CollectiveVideo', array(
            'criteria' => $criteria,
            'pagination' => false
        ));

		$this->breadcrumbs = $model->getBreadcrumbs();
		$this->registerSeoTags($model, 'name');
		$this->render('view', array(
			'model' => $model,
            'otherVideosData' => $otherVideosData
		));
	}
}