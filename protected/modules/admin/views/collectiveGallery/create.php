<?php
$breadcrumbs = $model->list->node->getAdminBreadcrumbs();
$list_name = array_pop($breadcrumbs);
$breadcrumbs[$list_name] = Yii::app()->createUrl('/admin/collectiveGalleriesList/update', array('id' => $model->list->id));
$breadcrumbs[] = 'Создание фотоотчета';
$this->breadcrumbs=$breadcrumbs;
?>

<h3>Новый фотоотчет</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>