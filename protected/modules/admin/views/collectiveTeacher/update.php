<?php
$breadcrumbs = $model->list->node->getAdminBreadcrumbs();
$list_name = array_pop($breadcrumbs);
$breadcrumbs[$list_name] = Yii::app()->createUrl('/admin/collectiveTeachersList/update', array('id' => $model->list->id));
$breadcrumbs[] = $model->short_name;
$this->breadcrumbs=$breadcrumbs;
?>

<h3><?= $model->short_name ?></h3>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>