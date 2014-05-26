<?php
$breadcrumbs = $model->list->node->getAdminBreadcrumbs();
$list_name = array_pop($breadcrumbs);
if ( $model->type == CollectiveNews::TYPE_NEWS ) {
	$backUrl = '/admin/collectiveNewsList/update';
	$title = 'Редактирование новости';
} else {
	$backUrl = '/admin/collectiveEventList/update';
	$title = 'Редактирование мероприятия';
}
$breadcrumbs[$list_name] = Yii::app()->createUrl($backUrl, array('id' => $model->list->id));
$breadcrumbs[] = $model->title;
$this->breadcrumbs=$breadcrumbs;

$this->menu=array(
    array('label'=>'Список','url'=>array($backUrl, 'id'=>$model->list_id)),
    array('label'=>'Создать','url'=>array('/admin/collectiveNews/create', 'list_id'=>$model->list_id, 'type'=>$model->type)),
);
?>

<h3>"<?php echo $title.' '.$model->title ?>"</h3>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>