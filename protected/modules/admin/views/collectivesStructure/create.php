<?php
$this->breadcrumbs=$model->getAdminBreadcrumbs();

$this->menu=array(
	array('label'=>'Разделы','url'=>array('list', 'collective_id'=>$model->collective->id)),
);
?>

<h3>Добавление раздела</h3>

<?php echo $this->renderPartial('_form', array(
	'model' => $model,
	'collective' => $collective,
)); ?>