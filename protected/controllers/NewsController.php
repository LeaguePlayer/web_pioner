<?php

class NewsController extends FrontController
{
    public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('index','view'),
                'users'=>array('*'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
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
        $this->render('view', array(
            'model'=>$model,
            'feedNews'=>$feedNews,
			'otherNewsData'=>$otherNewsData
        ));
    }
}