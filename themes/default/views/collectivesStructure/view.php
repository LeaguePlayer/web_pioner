<?php
$this->breadcrumbs=array(
	'Collectives Structures'=>array('index'),
	$model->name,
);

<h1>View CollectivesStructure #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'root',
		'lft',
		'rgt',
		'level',
		'material_id',
		'url',
		'name',
		'collective_id',
		'create_time',
		'update_time',
	),
)); ?>
