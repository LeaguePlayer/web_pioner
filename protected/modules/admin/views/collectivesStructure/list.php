<?php

$breadcrumbs = $collective->list->node->getAdminBreadcrumbs();
array_pop($breadcrumbs);
$breadcrumbs[$collective->list->node->name] = $this->createUrl('/admin/collectivesList/update', array('id' => $collective->list->id));
$breadcrumbs[$collective->name] = $this->createUrl('/admin/collective/update', array('id' => $collective->id));
$breadcrumbs[] = 'Разделы';
$this->breadcrumbs = $breadcrumbs;

$this->menu=array(
	array('label'=>'← К списку коллективов','url'=>array('/admin/collectivesList/update', 'id'=>$collective->list->id)),
);

?>


<h3>Разделы коллектива <?= $collective->name ?></h3>

<?php echo TbHtml::linkButton('Добавить раздел', array(
	'icon'=>TbHtml::ICON_PLUS,
	'url'=>array('/admin/collectivesStructure/create', 'collective_id'=>$model->collective_id)
)); ?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'collectivesStructure-grid',
	'dataProvider'=>$model->search(),
	'type'=>TbHtml::GRID_TYPE_HOVER,
	'afterAjaxUpdate'=>"function() {sortGrid('collectivesStructure')}",
	'rowHtmlOptionsExpression'=>'array(
		"id"=>"items[]_".$data->id,
		"class"=>"status_".$data->status,
	)',
	'columns'=>array(
		array(
			'type'=>'raw',
			'value'=>'$this->grid->controller->renderPartial("_drop_down_menu", array("model"=>$data), true)',
			'htmlOptions'=>array('width'=>'50px'),
		),
		array(
			'name' => 'name',
			'type' => 'raw',
			'value' => 'Chtml::link($data->name, Yii::app()->urlManager->createUrl("/admin/collectivesStructure/updateMaterial", array("node_id"=>$data->id)))'
		),
		array(
			'header' => 'Тип рздела',
			'type' => 'raw',
			'value' => '$data->material->name',
		),
		array(
			'header' => 'Ссылка',
			'type' => 'raw',
			'value' => 'CHtml::link($data->getUrl(), $data->getUrl(), array("target" => "_blank"))',
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{delete}',
		),
	),
)); ?>