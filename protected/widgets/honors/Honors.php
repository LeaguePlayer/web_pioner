<?php

class Honors extends CWidget
{
    public $title = 'Наши достижения';

    public function run()
    {
        $this->registerScripts();
        Yii::app()->clientScript->registerScript( 'honors', "
            $(function() {
                var widget = $('#".$this->getId()."');
                $('.honors-carousel', widget).owlCarousel({
                    navigation: true,
                    navigationText: ['', ''],
                    pagination: false,
                    singleItem: true,
                });
                $('a', widget).fancybox();
            });
        ", CClientScript::POS_END );

        $honors = Honor::model()->published()->findAll();
        $this->render('view', array(
            'honors' => $honors
        ));
    }

    protected function registerScripts()
    {
        $cs = Yii::app()->getClientScript();
        $cs->registerCoreScript('jquery');

        $appAssetsPath = $this->controller->getAssetsUrl();
        $cs->registerScriptFile($appAssetsPath.'/vendor/owl/owl.carousel.js', CClientScript::POS_END);
        $cs->registerCssFile($appAssetsPath.'/vendor/owl/owl.carousel.css');
    }
}