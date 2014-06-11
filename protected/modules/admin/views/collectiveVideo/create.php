<?php
$breadcrumbs = $model->list->node->getAdminBreadcrumbs();
$list_name = array_pop($breadcrumbs);
$breadcrumbs[$list_name] = Yii::app()->createUrl('/admin/collectiveVideoList/update', array('id' => $model->list->id));
$breadcrumbs[] = 'Создание видеотчета';
$this->breadcrumbs=$breadcrumbs;
?>

<h3>Новый видеоотчет</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>