<?php
$this->breadcrumbs = $model->node->getAdminBreadcrumbs();
if ( $model->node ) {
    $this->menu[] = array('label'=>'← К разделу', 'url'=>array('/admin/structure/update', 'id' => $model->node->id));
}

?>

<h2><?php echo $model->node->name; ?></h2>
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>