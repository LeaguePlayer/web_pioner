<?php

class CollectiveNewsController extends AdminController
{
	public function actionCreate($list_id, $type)
    {
        $model = new CollectiveNews();
        $model->list_id = $list_id;
		$model->type = $type;

        if(isset($_POST['CollectiveNews']))
        {
            $model->attributes = $_POST['CollectiveNews'];
            $success = $model->save();
            if( $success ) {
				if ( $type == CollectiveNews::TYPE_NEWS )
                	$this->redirect(array('/admin/collectiveNewsList/update', 'id'=>$model->list_id));
				else
					$this->redirect(array('/admin/collectiveEventList/update', 'id'=>$model->list_id));
            }
        }
        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel('CollectiveNews', $id);
        if(isset($_POST['CollectiveNews']))
        {
            $model->attributes = $_POST['CollectiveNews'];
            $success = $model->save();
            if( $success ) {
                $this->redirect(array('/admin/collectiveNewsList/update', 'id'=>$model->list_id));
            }
        }
        $this->render('update', array('model' => $model));
    }


	public function actionDelete($id)
	{
		$model = $this->loadModel('CollectiveNews', $id);
		$model->delete();
	}
}
