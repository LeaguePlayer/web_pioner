<?php
$this->menu=array(
	array('label'=>'Добавить','url'=>array('create')),
);
?>

<h3>Достижения и награды</h3>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'honor-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'type'=>TbHtml::GRID_TYPE_HOVER,
    'afterAjaxUpdate'=>"function() {sortGrid('honor')}",
    'rowHtmlOptionsExpression'=>'array(
        "id"=>"items[]_".$data->id,
        "class"=>"status_".(isset($data->status) ? $data->status : ""),
    )',
	'columns'=>array(
		array(
			'header'=>'Фото',
			'type'=>'raw',
			'value'=>'TbHtml::image($data->imgBehaviorPreview->getImageUrl("icon"))'
		),
		array(
			'header'=>'Дата',
			'type'=>'raw',
			'value'=>'SiteHelper::russianDate($data->dt_date)'
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{update} {delete}',
		),
	),
)); ?>

<?php if($model->hasAttribute('sort')) Yii::app()->clientScript->registerScript('sortGrid', 'sortGrid("honor");', CClientScript::POS_END) ;?>