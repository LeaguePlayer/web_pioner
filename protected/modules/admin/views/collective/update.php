<?php

$breadcrumbs = $model->list->node->getAdminBreadcrumbs();
array_pop($breadcrumbs);
$breadcrumbs[$model->list->node->name] = Yii::app()->createUrl('admin/collectivesList/update', array('id' => $model->list_id));
$breadcrumbs[] = $model->name;
$this->breadcrumbs=$breadcrumbs;

$this->menu=array(
	array('label'=>'← Список коллективов','url'=>array('/admin/collectivesList/update', 'id'=>$model->list_id)),
	array('label'=>'→ Материалы','url'=>array('/admin/collectivesStructure/list', 'collective_id'=>$model->id)),
	array('label'=>'Создать коллектив','url'=>array('/admin/collective/create', 'list_id'=>$model->list_id)),
);
?>

<h3>Редактирование коллектива <?= $model->name ?></h3>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>