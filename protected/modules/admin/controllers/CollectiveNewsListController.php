<?php
/**
 * Created by JetBrains PhpStorm.
 * User: megakuzmitch
 * Date: 25.12.13
 * Time: 18:39
 * To change this template use File | Settings | File Templates.
 */

class CollectiveNewsListController extends AdminController
{
    public function actionCreate($node_id)
    {
        $model = new CollectiveNewsList;
		$model->node_id = $node_id;
        $model->page_size = 5;
        $success = $model->save();
        if( $success ) {
            $this->redirect(array('/admin/collectiveNewsList/update', 'id'=>$model->id));
        } else {
			var_dump( $model->errors ); die();
            $this->render('create', array('model' => $model));
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel('CollectiveNewsList', $id);
        $newsFinder = new CollectiveNews('search');
        $newsFinder->unsetAttributes();
		$newsFinder->type = CollectiveNews::TYPE_NEWS;
		$newsFinder->list_id = $model->id;
        if ( isset($_GET['CollectiveNews']) ) {
            $newsFinder->attributes = $_GET['CollectiveNews'];
        }

        if(isset($_POST['CollectiveNewsList']))
        {
            $model->attributes = $_POST['CollectiveNewsList'];
            $success = $model->save();
            if( $success ) {
                Yii::app()->user->setFlash('SAVED', 'Настройки сохранены');
            }
        }
        $this->render('update', array(
            'model' => $model,
            'newsFinder' => $newsFinder
        ));
    }
}