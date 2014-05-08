<?php
$this->breadcrumbs=$model->node->getAdminBreadcrumbs();

$this->menu=array(
	array('label'=>'Список','url'=>array('list')),
);
?>

<h3>Расписание «<?= $model->node->collective->name ?>»</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>