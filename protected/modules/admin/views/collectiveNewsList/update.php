<?php
$this->breadcrumbs=$model->node->getAdminBreadcrumbs();
?>

<h3><?= ($model instanceof CollectiveEventList) ? 'Мероприятия' : 'Новости' ?></h3>

<?php echo $this->renderPartial('/collectiveNewsList/_form',array(
    'model' => $model,
    'newsFinder' => $newsFinder
)); ?>