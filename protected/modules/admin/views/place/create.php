<?php
$breadcrumbs = $model->list->node->getAdminBreadcrumbs();
$list_name = array_pop($breadcrumbs);
$breadcrumbs[$list_name] = Yii::app()->createUrl('/admin/placesList/update', array('id' => $model->list_id));
$breadcrumbs[] = $model->name;
$this->breadcrumbs=$breadcrumbs;
?>

<h1><?php echo $model->translition(); ?> - Добавление</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>