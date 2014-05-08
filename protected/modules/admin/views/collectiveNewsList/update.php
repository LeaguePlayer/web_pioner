<?php
$this->breadcrumbs=$model->node->getAdminBreadcrumbs();
?>

<h3>Новости</h3>

<?php echo $this->renderPartial('_form',array(
    'model' => $model,
    'newsFinder' => $newsFinder
)); ?>