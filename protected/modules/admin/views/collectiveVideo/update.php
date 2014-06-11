<?php
$breadcrumbs = $model->list->node->getAdminBreadcrumbs();
$list_name = array_pop($breadcrumbs);
$breadcrumbs[$list_name] = Yii::app()->createUrl('/admin/collectiveVideosList/update', array('id' => $model->list->id));
$breadcrumbs[] = $model->name;
$this->breadcrumbs=$breadcrumbs;
?>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>