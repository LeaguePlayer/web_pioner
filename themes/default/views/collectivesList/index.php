<?php
/* @var $this CollectivesListController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Collectives Lists',
);

$this->menu=array(
	array('label'=>'Create CollectivesList', 'url'=>array('create')),
	array('label'=>'Manage CollectivesList', 'url'=>array('admin')),
);
?>

<h1>Collectives Lists</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
