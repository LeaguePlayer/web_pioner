<?php
/**
 * Created by JetBrains PhpStorm.
 * User: megakuzmitch
 * Date: 21.05.14
 * Time: 13:49
 */

class FileController extends AdminController
{
    public function actions()
    {
        return array(
            'fileUploaderConnector'=>array(
                'class'=>'application.extensions.ezzeelfinder.ElFinderConnectorAction',
            ),
        );
    }

    public function actionUpload()
    {
        $_FILES['file']['type'] = strtolower($_FILES['file']['type']);
        if (@$_FILES['file']['type'] == 'image/png'
            || @$_FILES['file']['type'] == 'image/jpg'
            || @$_FILES['file']['type'] == 'image/gif'
            || @$_FILES['file']['type'] == 'image/jpeg'
            || @$_FILES['file']['type'] == 'image/pjpeg')
        {
            $url = '/media/redactorimages/';
            $directory = Yii::app()->basePath.'/..'.$url;
            if ( !is_dir($directory) ) {
                mkdir($directory, 0766);
            }
            $directory = realpath($directory).'/';
            $file = md5(date('YmdHis')).'.'.pathinfo(@$_FILES['file']['name'], PATHINFO_EXTENSION);
            if (move_uploaded_file(@$_FILES['file']['tmp_name'], $directory.$file)) {
                echo CJSON::encode(array(
                    'filelink' => $url.$file
                ));
            }
        }
        Yii::app()->end();
    }
}