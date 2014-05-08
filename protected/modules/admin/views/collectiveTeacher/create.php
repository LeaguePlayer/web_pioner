<?php
$breadcrumbs = $model->list->node->getAdminBreadcrumbs();
$list_name = array_pop($breadcrumbs);
$breadcrumbs[$list_name] = Yii::app()->createUrl('/admin/collectiveTeachersList/update', array('id' => $model->list->id));
$breadcrumbs[] = 'Добавление сотрудника';
$this->breadcrumbs=$breadcrumbs;
?>

<h3>Добавление сотрудника</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>