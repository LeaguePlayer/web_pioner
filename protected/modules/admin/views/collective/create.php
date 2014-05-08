<?php
$breadcrumbs = $model->list->node->getAdminBreadcrumbs();
array_pop($breadcrumbs);
$breadcrumbs[$model->list->node->name] = Yii::app()->createUrl('admin/collectivesList/update', array('id' => $model->list_id));
$breadcrumbs[] = 'Добавление коллектива';
$this->breadcrumbs=$breadcrumbs;

$this->menu=array(
	array('label'=>'Коллективы','url'=>array('/admin/collectivesList/update', 'id' => $model->list_id)),
);
?>

<h3>Добавление коллектива</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>