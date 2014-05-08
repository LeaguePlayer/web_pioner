<?php
/* @var $this CollectiveSheduleController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Collective Shedules',
);

$this->menu=array(
	array('label'=>'Create CollectiveShedule', 'url'=>array('create')),
	array('label'=>'Manage CollectiveShedule', 'url'=>array('admin')),
);
?>

<h1>Collective Shedules</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
