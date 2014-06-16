<?php
$this->menu=array(
	array('label'=>'Добавить','url'=>array('create')),
);
?>

<h3>Полезные ссылки</h3>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'link-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'type'=>TbHtml::GRID_TYPE_HOVER,
    'afterAjaxUpdate'=>"function() {sortGrid('link')}",
    'rowHtmlOptionsExpression'=>'array(
        "id"=>"items[]_".$data->id,
        "class"=>"status_".(isset($data->status) ? $data->status : ""),
    )',
	'columns'=>array(
		'label',
        array(
            'name'=>'url',
            'type'=>'raw',
            'value'=>'CHtml::link($data->url, $data->url, array("target" => "_blank"))',
        ),
		array(
			'name'=>'status',
			'type'=>'raw',
			'value'=>'Link::getStatusAliases($data->status)',
			'filter'=>Link::getStatusAliases()
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
            'buttons'=>array(
                'view'=>array(
                    'url'=>'$data->url',
                    'options'=>array(
                        'target'=>'_blank'
                    )
                )
            )
		),
	),
)); ?>

<?php if($model->hasAttribute('sort')) Yii::app()->clientScript->registerScript('sortGrid', 'sortGrid("link");', CClientScript::POS_END) ;?>