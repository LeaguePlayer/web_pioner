<?php
/* @var $this CollectivesStructureController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Collectives Structures',
);

$this->menu=array(
	array('label'=>'Create CollectivesStructure', 'url'=>array('create')),
	array('label'=>'Manage CollectivesStructure', 'url'=>array('admin')),
);
?>

<h1>Collectives Structures</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
