<?php

class NewsController extends FrontController
{
	public function actionIndex($collective_id = false)
	{
		$criteria = new CDbCriteria();
		$criteria->compare('t.status', CollectiveNews::STATUS_PUBLISH);
		$criteria->compare('t.type', CollectiveNews::TYPE_NEWS);
		$criteria->order = 't.date_public DESC';
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
		$dataProvider = new CActiveDataProvider('CollectiveNews', array(
			'criteria' => $criteria,
			'pagination' => false
		));

		$title = 'Новости';
		$this->breadcrumbs[] = $title;

		$this->render('//news/index', array(
			'title' => $title,
			'dataProvider' => $dataProvider
		));
	}

    public function actionView($id)
    {
        $model = $this->loadModel('CollectiveNews', $id);

		$criteria = new CDbCriteria();
		$criteria->compare('status', CollectiveNews::STATUS_PUBLISH);
		$criteria->addCondition('id<>:id');
		$criteria->params[':id'] = $model->id;
		$criteria->order = 'date_public DESC';
		$feedNews = CollectiveNews::model()->findAll($criteria);

		$criteria->compare('type', $model->type);
		$criteria->limit = 4;
		$otherNewsData = new CActiveDataProvider('CollectiveNews', array(
			'criteria' => $criteria,
			'pagination' => false
		));

        $this->registerSeoTags($model, 'title');
		$this->breadcrumbs = $model->getBreadcrumbs();
        $this->render('view', array(
            'model'=>$model,
            'feedNews'=>$feedNews,
			'otherNewsData'=>$otherNewsData
        ));
    }
}