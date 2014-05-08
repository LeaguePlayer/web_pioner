<?php
$this->breadcrumbs=$model->node->getAdminBreadcrumbs();
?>

<h1><?php echo $model->translition(); ?> - Редактирование</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>