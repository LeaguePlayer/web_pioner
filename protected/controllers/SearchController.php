<?php

class SearchController extends FrontController
{
    public function actionIndex($query)
    {
        $criteria = new CDbCriteria();
        $criteria->addSearchCondition('title', $query);
        $criteria->addSearchCondition('text', $query, true, 'OR');

        $dataProvider = new CActiveDataProvider('Search', array(
            'criteria'=>$criteria,
        ));

        $this->render('search', array(
            'dataProvider'=>$dataProvider,
            'query'=>$query,
        ));
    }
}