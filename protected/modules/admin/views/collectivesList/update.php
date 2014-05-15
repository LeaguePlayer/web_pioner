<?php
$this->breadcrumbs=$model->node->getAdminBreadcrumbs();
$this->menu=array(
    array('label'=>'Структура сайта','url'=>array('/admin/structure/list', 'opened' => $model->node_id)),
	array('label'=>'← Раздел', 'url'=>array('/admin/structure/update', 'id'=>$model->node_id)),
);
?>

<h3>Коллективы</h3>

<?php echo $this->renderPartial('_form',array(
    'model' => $model,
    'collectiveFinder' => $collectiveFinder
)); ?>