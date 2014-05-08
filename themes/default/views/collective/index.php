<?php
/* @var $this CollectiveController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Collectives',
);

$this->menu=array(
	array('label'=>'Create Collective', 'url'=>array('create')),
	array('label'=>'Manage Collective', 'url'=>array('admin')),
);
?>

<h1>Collectives</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
