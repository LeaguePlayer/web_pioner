<?php
$this->breadcrumbs = $model->node->getAdminBreadcrumbs();
if ( is_numeric($_GET['node_id']) ) {
    $this->menu[] = array('label'=>'← К разделу', 'url'=>array('/admin/collectivesStructure/update', 'id' => $_GET['node_id']));
}

?>

<h2><?= $node->name ?></h2>

<?php echo $this->renderPartial('_form', array(
	'model'=>$model,
)); ?>