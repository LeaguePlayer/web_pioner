<?php echo $form->textFieldControlGroup($model,'name',array('class'=>'span8','maxlength'=>255)); ?>

<div class='control-group'>
	<?php echo CHtml::activeLabelEx($model, 'date_publish'); ?>
	<?php $this->widget('yiiwheels.widgets.datetimepicker.WhDateTimePicker', array(
		'model' => $model,
		'attribute' => 'date_publish',
		'pluginOptions' => array(
			'format' => 'dd-MM-yyyy',
			'language' => 'ru',
			'pickSeconds' => false,
			'pickTime' => false
		)
	)); ?>
	<?php echo $form->error($model, 'date_publish'); ?>
</div>

<?= $form->dropDownListControlGroup($model, 'status', CollectiveGallery::getStatusAliases(), array('class'=>'span12', 'displaySize'=>1)); ?>

<?php $this->widget('appext.imagesgallery.GalleryManager', array(
	'gallery' => $model->gallery,
	'controllerRoute' => '/admin/gallery',
	'enableDeleteButton' => false,
	'enableUnlinkButton' => false,
)) ?>
