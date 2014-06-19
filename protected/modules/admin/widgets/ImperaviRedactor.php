<?php
/**
 * Created by JetBrains PhpStorm.
 * User: megakuzmitch
 * Date: 17.06.14
 * Time: 15:13
 */

class ImperaviRedactor extends CWidget
{
    public $model;
    public $attribute;
    public $redactorOptions = array();
    public $fileBrowserOptions = array();

    public function run()
    {
        $path = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'font-awesome';
        $assetsPath = CHtml::asset($path);
        Yii::app()->clientScript->registerScriptFile('http://code.jquery.com/jquery-migrate-1.2.1.min.js');
        Yii::app()->clientScript->registerCssFile($assetsPath . '/css/font-awesome.min.css');

        $redactorOptions = CMap::mergeArray(array(
            'buttons'=>array(
                'formatting', '|', 'bold', 'italic', 'deleted', '|',
                'unorderedlist', 'orderedlist', 'outdent',  'indent', 'alignment', 'table','horizontalrule', '|',
                'image', 'video', 'file', 'link',  '|', 'html',
            ),
            'lang'=>'ru',
            'rows'=> '2',
            'minHeight' => 500,
            'thumbLinkClass'=>'athumbnail', //Класс по-умолчанию для ссылки на полное изображение вокруг thumbnail
            'thumbClass'=>'thumbnail pull-left', //Класс по-умолчанию для  thumbnail
            'defaultUplthumb'=>true, //Вставлять по-умолчанию после загрузки превью? если нет - полное изображение
            'iframe' => true,
            'toolbar' => true,
            'fmUrl'=>Yii::app()->createUrl('/admin/file/fileUploaderConnector'), //ссылка на ElFinderConnectorAction
            'imageUpload'=>Yii::app()->createUrl('admin/file/upload')
        ), $this->redactorOptions);

        $this->widget('appext.imperavi-redactor-widget.ImperaviRedactorWidget', array(
            'model' => $this->model,
            'attribute' => $this->attribute,
            'plugins' => array(
                'fontfamily' => array(
                    'js' => array('fontfamily.js',),
                ),
                'fontcolor' => array(
                    'js' => array('fontcolor.js',),
                ),
                'fontsize' => array(
                    'js' => array('fontsize.js',),
                ),
                'fullscreen' => array(
                    'js' => array('fullscreen.js',),
                ),
                'extelf' => array(
                    'js' => array('extelf.js',),
                ), //подключаем плагин для работы с elfinder
            ),
            'options'=>$redactorOptions,
        ));

        echo CHtml::openTag('div', array('id'=>'file-uploade'));
        echo CHtml::closeTag('div');

        $fileBrowserOptions = CMap::mergeArray(array(
            'lang' => "ru",
            'resizable' => true,
        ), $this->fileBrowserOptions);
        $this->widget("appext.ezzeelfinder.ElFinderWidget", array(
            'selector' => "div#file-uploader",
            'clientOptions' => $fileBrowserOptions,
        ));
    }
}