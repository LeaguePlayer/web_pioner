<?php

class NewsController extends FrontController
{
	public function actionIndex()
	{
		$criteria = new CDbCriteria();
		$criteria->compare('status', CollectiveNews::STATUS_PUBLISH);
		$criteria->compare('type', CollectiveNews::TYPE_NEWS);
		$criteria->order = 'date_public DESC';
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