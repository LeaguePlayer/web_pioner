<?php
$this->breadcrumbs=$model->node->getAdminBreadcrumbs();

$this->menu=array(
	array('label'=>'Список','url'=>array('list')),
);
?>

<h1><?php echo $model->translition(); ?> - Добавление</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>