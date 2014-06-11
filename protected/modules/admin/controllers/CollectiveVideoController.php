<?php

class CollectiveVideoController extends AdminController
{
	public function actionCreate($list_id)
	{
		$model = new CollectiveVideo();
		$model->list_id = $list_id;
		$model->date_publish = date('d-m-Y');
		$model->name = 'Новый видеоотчет';
		$model->status = CollectiveVideo::STATUS_CLOSED;

		if ( isset($_POST['CollectiveVideo']) )
		{
			$model->attributes = $_POST['CollectiveVideo'];
			if ( $model->save() ) {
				$this->redirect(array('/admin/collectiveVideosList/update', 'id'=>$model->list_id));
			}
		}

		$this->render('create', array(
			'model' => $model,
		));
	}


	public function actionUpdate($id)
	{
		$model = $this->loadModel('CollectiveVideo', $id);

        if (isset($_POST['CollectiveVideo']['deletePhoto'])) {
            $model->deletePhoto();
            if ( Yii::app()->request->isAjaxRequest ) {
                Yii::app()->end();
            }
        }

		if ( isset($_POST['CollectiveVideo']) )
		{
			$model->attributes = $_POST['CollectiveVideo'];
			$success = $model->save();
			if ( $success ) {
				$this->redirect(array('/admin/collectiveVideosList/update', 'id'=>$model->list_id));
			}
		}
		$this->render('update', array(
			'model' => $model
		));
	}


	public function actionDelete($id)
	{
		$model = $this->loadModel('CollectiveVideo', $id);
		$model->delete();
		$this->redirect(array('/admin/collectiveVideosList/update', 'id'=>$model->list_id));
	}
}
