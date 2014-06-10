<?php

class Teachers extends CWidget
{
    public $title = 'Наши учителя';

    public function run()
    {
        Yii::app()->clientScript->registerScript( 'teachers', "
            $(function() {
                var widget = $('#".$this->getId()."');
                $('.item a', widget).fancybox({
                    autoSize: false,
                    width: 600,
                    height: 'auto'
                });
            });
        ", CClientScript::POS_END );

        $teachers = Employee::model()->findAll();
        $this->render('view', array(
            'teachers' => $teachers
        ));
    }
}