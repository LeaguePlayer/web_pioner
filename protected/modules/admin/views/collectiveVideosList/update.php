<?php
$this->breadcrumbs=$model->node->getAdminBreadcrumbs();

$this->menu=array(
    array('label'=>'Структура сайта','url'=>array('/admin/structure/list')),
    array('label'=>'Свойства раздела', 'url'=>array('/admin/structure/update', 'id'=>$model->node_id)),
	array('label'=>'← Раздел', 'url'=>array('/admin/structure/update', 'id'=>$model->node->id)),
);
?>
<h3>Видеоотчеты</h3>

<?php echo TbHtml::linkButton('Добавить видео', array(
	'icon'=>TbHtml::ICON_PLUS,
	'url'=>array('/admin/collectiveVideo/create', 'list_id'=>$model->id)
)); ?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'video-grid',
	'dataProvider'=>$videoFinder->search(),
	'filter'=>$videoFinder,
	'type'=>TbHtml::GRID_TYPE_HOVER,
	'afterAjaxUpdate'=>"function() {sortGrid('video')}",
	'rowHtmlOptionsExpression'=>'array(
		"id"=>"items[]_".$data->id,
		"class"=>"status_".$data->status,
	)',
	'columns'=>array(
        array(
            'header'=>'Превью',
            'type'=>'raw',
            'value'=>'TbHtml::link($data->getImage("small"), array("/admin/collectiveVideo/update/", "id"=>$data->id, "list_id"=>'.$model->id.'))',
            'filter'=>false
        ),
		array(
			'name'=>'name',
			'type'=>'raw',
			'value'=>'TbHtml::link($data->name, array("/admin/collectiveVideo/update/", "id"=>$data->id, "list_id"=>'.$model->id.'))'
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
					'url'=>'array("/admin/collectiveVideo/delete", "id"=>$data->id)'
				),
				'view'=>array(
					'url'=>'array("/admin/collectiveVideo/view", "id"=>$data->id)'
				),
			),
		),
	),
)); ?>