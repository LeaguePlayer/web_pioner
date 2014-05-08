<?php
$this->breadcrumbs=$model->node->getAdminBreadcrumbs();
?>

<h1>Новости</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>