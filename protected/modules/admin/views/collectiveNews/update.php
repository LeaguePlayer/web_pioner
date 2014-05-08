<?php
$breadcrumbs = $model->list->node->getAdminBreadcrumbs();
$list_name = array_pop($breadcrumbs);
$breadcrumbs[$list_name] = Yii::app()->createUrl('/admin/collectiveNewsList/update', array('id' => $model->list->id));
$breadcrumbs[] = $model->name;
$this->breadcrumbs=$breadcrumbs;

$this->menu=array(
    array('label'=>'Новости','url'=>array('/admin/collectiveNewsList/update', 'id'=>$model->list_id)),
    array('label'=>'Добавить новую','url'=>array('/admin/collectiveNews/create', 'list_id'=>$model->list_id)),
);
?>

<h3>Редактирование новости "<?php echo $model->title ?>"</h3>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>