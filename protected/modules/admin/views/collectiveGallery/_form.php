<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'collective-gallery-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

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

	<?php $this->widget('appext.imagesgallery.GalleryManager', array(
		'gallery' => $model->gallery,
		'controllerRoute' => '/admin/gallery',
		'enableDeleteButton' => false,
		'enableUnlinkButton' => false,
	)) ?>

	<div class="form-actions">
		<?php echo TbHtml::submitButton('Сохранить', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)); ?>
        <?php echo TbHtml::linkButton('Отмена', array('url'=>array('/admin/collectiveGalleriesList/update', 'id' => $model->list->id))); ?>
	</div>

<?php $this->endWidget(); ?>
