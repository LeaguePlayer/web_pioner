<?php
$breadcrumbs = $model->list->node->getAdminBreadcrumbs();
$list_name = array_pop($breadcrumbs);
if ( $model->type == CollectiveNews::TYPE_NEWS ) {
	$backUrl = '/admin/collectiveNewsList/update';
	$title = 'Создание новости';
} else {
	$backUrl = '/admin/collectiveEventList/update';
	$title = 'Создание мероприятия';
}
$breadcrumbs[$list_name] = Yii::app()->createUrl($backUrl, array('id' => $model->list_id));
$breadcrumbs[] =  $title;
$this->breadcrumbs=$breadcrumbs;

$this->menu=array(
    array('label'=>'Новости','url'=>array($backUrl, 'id'=>$model->list_id)),
);
?>

<h3><?= $title ?></h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>