<?php

class CollectiveController extends FrontController
{
	public function actionView($id)
	{
		$model = $this->loadModel('Collective', $id);

		$criteria = new CDbCriteria();
		$criteria->compare('collective_id', $model->id);
		$collectiveNodes = CollectivesStructure::model()->published()->findAll($criteria);

		$this->breadcrumbs = $model->list->node->getBreadcrumbs();
		array_pop($this->breadcrumbs);
		$this->breadcrumbs[] = $model->name;
		$this->registerSeoTags($model, 'name');
		$this->render('view',array(
			'model'=>$model,
			'nodes'=>$collectiveNodes
		));
	}

	
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Collective');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}


    public function actionSchedule($collective_id)
    {
        $model = $this->loadModel('Collective', $collective_id);
        $this->render('schedule', array(
            'model' => $model
        ));
    }
}
