<?php
$this->breadcrumbs=array(
	'Collectives'=>array('index'),
	$model->name,
);

<h1>View Collective #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'img_preview',
		'age_limits',
		'description',
		'list_id',
		'status',
		'sort',
		'create_time',
		'update_time',
	),
)); ?>
