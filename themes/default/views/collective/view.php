
<div>
	<?php $this->widget('zii.widgets.CBreadcrumbs', array(
		'separator'=>' → ',
		'links'=>$this->breadcrumbs,
	)); ?>
</div>


<section class="collective">
	<h2><?= $model->name ?></h2>
	<?php echo $model->description ?>
</section>