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

        $this->registerSeoTags($model, 'title');

        $this->render('view', array(
            'model'=>$model,
        ));
    }
}