<?php

class NewsController extends FrontController
{
	public function filters()
	{
		return CMap::mergeArray(parent::filters(), array(
			'ajaxOnly + loadItems, getEnabledDays, loadDescription'
		));
	}

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

    public function actionView($id, $newsPage = null)
    {
        $model = $this->loadModel('News', $id);
        $newslist = $model->list;
        $node = $newslist->node;

        $breadcrumbs = $node->getBreadcrumbs();
        array_pop($breadcrumbs);
        $breadcrumbs[$node->name] = $node->getUrl();
        $breadcrumbs[] = $model->title;

        $this->breadcrumbs = $breadcrumbs;

        if ( !empty($model->seo->meta_title) )
            $this->title = $model->seo->meta_title;
        else
            $this->title = $model->name.' | '.Yii::app()->config->get('app.name');

        Yii::app()->clientScript->registerMetaTag($model->seo->meta_desc, 'description', null, array('id'=>'meta_description'), 'meta_description');
        Yii::app()->clientScript->registerMetaTag($model->seo->meta_keys, 'keywords', null, array('id'=>'keywords'), 'meta_keywords');

        $this->render('view', array(
            'model'=>$model,
            'node'=>$node,
            'newsPage'=>$newsPage
        ));
    }

	public function actionGetEnabledDays()
	{
		$criteria = new CDbCriteria();
		$criteria->compare('status', News::STATUS_PUBLISH);
		$criteria->distinct = 'date_public';
		$criteria->select = 'date_public';
		$criteria->order = 'date_public';
		$news = News::model()->findAll($criteria);
		$response = array();
		foreach ( $news as $oneNews ) {
			$response[] = date('j-n-Y', strtotime($oneNews->date_public));
		}
		echo CJSON::encode($response);
	}

	public function actionLoadItems($date)
	{
		$criteria = new CDbCriteria();
		$criteria->compare('date_public', $date, true);
		$criteria->compare('status', News::STATUS_PUBLISH);
		$criteria->order = 'date_public';
		$dataProvider = new CActiveDataProvider('News', array(
			'criteria' => $criteria,
			'pagination' => false
		));
		$this->renderPartial('_list', array(
			'dataProvider' => $dataProvider
		));
	}

	public function actionLoadDescription($id)
	{
		$criteria = new CDbCriteria();
		$criteria->compare('status', News::STATUS_PUBLISH);
		$model = $this->loadModel('News', $id);
		$this->renderPartial('_desc', array(
			'model' => $model
		));
	}
}