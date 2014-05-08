<?php
$this->breadcrumbs=array(
	'Collective Shedules'=>array('index'),
	$model->id,
);

<h1>View CollectiveShedule #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'json_events',
		'node_id',
		'status',
		'sort',
		'create_time',
		'update_time',
	),
)); ?>
