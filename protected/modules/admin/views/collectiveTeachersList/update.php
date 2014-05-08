<?php
$this->breadcrumbs=$model->node->getAdminBreadcrumbs();
?>
<h3>Педагоги</h3>

<?php echo TbHtml::linkButton('Добавить сотрудника', array(
	'icon'=>TbHtml::ICON_PLUS,
	'url'=>array('/admin/collectiveTeacher/create', 'list_id'=>$model->id)
)); ?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'gallery-grid',
	'dataProvider'=>$finder->search(),
	'filter'=>$finder,
	'type'=>TbHtml::GRID_TYPE_HOVER,
	'afterAjaxUpdate'=>"function() {sortGrid('news')}",
	'rowHtmlOptionsExpression'=>'array(
		"id"=>"items[]_".$data->id,
		"class"=>"status_".$data->status,
	)',
	'columns'=>array(
		array(
			'name'=>'img_photo',
			'type'=>'raw',
			'value'=>'$data->getImage("icon")',
			'filter'=>false
		),
		array(
			'name'=>'short_name',
			'type'=>'raw',
			'value'=>'TbHtml::link($data->short_name, array("/admin/collectiveTeacher/update/", "id"=>$data->id, "list_id"=>'.$model->id.'))'
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{delete}',
			'buttons'=>array(
				'delete'=>array(
					'url'=>'array("/admin/collectiveTeacher/delete", "id"=>$data->id)'
				),
				'view'=>array(
					'url'=>'array("/admin/collectiveTeacher/view", "id"=>$data->id)'
				),
			),
		),
	),
)); ?>