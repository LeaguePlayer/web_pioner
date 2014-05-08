<?php
$this->breadcrumbs=array(
	'Collectives Lists'=>array('index'),
	$model->id,
);

<h1>View CollectivesList #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'node_id',
		'create_time',
		'update_time',
	),
)); ?>
