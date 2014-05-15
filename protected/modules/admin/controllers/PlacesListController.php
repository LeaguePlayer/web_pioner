<?php
/**
 * Created by JetBrains PhpStorm.
 * User: megakuzmitch
 * Date: 25.12.13
 * Time: 18:39
 * To change this template use File | Settings | File Templates.
 */

class PlaceslistController extends AdminController
{
    public function actionCreate()
    {
        $model = new PlacesList;
        if ( $model->save() ) {
            $this->redirect(array('/admin/placesList/update', 'id'=>$model->id));
        } else {
            $this->render('create', array('model' => $model));
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel('PlacesList', $id);
        $placeFinder = new Place('search');
        $placeFinder->unsetAttributes();
        if ( isset($_GET['Place']) ) {
            $placeFinder->attributes = $_GET['Place'];
        }
        $placeFinder->list_id = $model->id;
        $this->render('update', array(
            'model' => $model,
            'placeFinder' => $placeFinder
        ));
    }
}