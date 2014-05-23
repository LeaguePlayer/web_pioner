<?php
$this->breadcrumbs=$model->node->getAdminBreadcrumbs();

$this->menu=array(
    array('label'=>'Структура сайта','url'=>array('/admin/structure/list')),
    array('label'=>'Свойства раздела', 'url'=>array('/admin/structure/update', 'id'=>$model->node_id)),
	array('label'=>'← Раздел', 'url'=>array('/admin/structure/update', 'id'=>$model->node->id)),
);
?>
<h3>Фотоотчеты</h3>

<?php echo TbHtml::linkButton('Добавить галерею', array(
	'icon'=>TbHtml::ICON_PLUS,
	'url'=>array('/admin/collectiveGallery/create', 'list_id'=>$model->id)
)); ?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'gallery-grid',
	'dataProvider'=>$galleryFinder->search(),
	'filter'=>$galleryFinder,
	'type'=>TbHtml::GRID_TYPE_HOVER,
	'afterAjaxUpdate'=>"function() {sortGrid('news')}",
	'rowHtmlOptionsExpression'=>'array(
		"id"=>"items[]_".$data->id,
		"class"=>"status_".$data->status,
	)',
	'columns'=>array(
		array(
			'header'=>'Фото',
			'type'=>'raw',
			'value'=>'TbHtml::link($data->getFirstPhoto("small"), array("/admin/collectiveGallery/update/", "id"=>$data->id, "list_id"=>'.$model->id.'))',
			'filter'=>false
		),
		array(
			'name'=>'name',
			'type'=>'raw',
			'value'=>'TbHtml::link($data->name, array("/admin/collectiveGallery/update/", "id"=>$data->id, "list_id"=>'.$model->id.'))'
		),
		array(
			'name'=>'date_publish',
			'type'=>'raw',
			'value'=>'SiteHelper::russianDate($data->date_publish)'
		),
		array(
			'name'=>'status',
			'type'=>'raw',
			'value'=>'CollectiveGallery::getStatusAliases($data->status)',
			'filter'=>CollectiveGallery::getStatusAliases()
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{delete}',
			'buttons'=>array(
				'delete'=>array(
					'url'=>'array("/admin/collectiveGallery/delete", "id"=>$data->id)'
				),
				'view'=>array(
					'url'=>'array("/admin/collectiveGallery/view", "id"=>$data->id)'
				),
			),
		),
	),
)); ?>