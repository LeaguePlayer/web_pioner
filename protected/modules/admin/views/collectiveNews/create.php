<?php
$breadcrumbs = $model->list->node->getAdminBreadcrumbs();
$list_name = array_pop($breadcrumbs);
$breadcrumbs[$list_name] = Yii::app()->createUrl('/admin/collectiveNewsList/update', array('id' => $model->list_id));
$breadcrumbs[] = 'Создание новости';
$this->breadcrumbs=$breadcrumbs;

$this->menu=array(
    array('label'=>'Новости','url'=>array('/admin/collectiveNewsList/update', 'id'=>$model->list_id)),
);
?>

<h3>Добавление новости</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>