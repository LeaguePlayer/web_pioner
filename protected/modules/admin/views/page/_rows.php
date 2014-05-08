<div class='control-group'>
	<?php echo CHtml::activeLabelEx($model, 'img_preview'); ?>
	<?php echo $form->fileField($model,'img_preview', array('class'=>'span3')); ?>
	<div class='img_preview'>
		<?php if ( !empty($model->img_preview) ) echo TbHtml::imageRounded( $model->imgBehaviorPreview->getImageUrl('small') ) ; ?>
		<span class='deletePhoto btn btn-danger btn-mini' data-modelname='Page' data-attributename='Preview' <?php if(empty($model->img_preview)) echo "style='display:none;'"; ?>><i class='icon-remove icon-white'></i></span>
	</div>
	<?php echo $form->error($model, 'img_preview'); ?>
</div>

<?php echo $form->textAreaControlGroup($model,'description',array('rows'=>6, 'cols'=>50, 'class'=>'span12')); ?>

<div class='control-group'>
	<?php echo CHtml::activeLabelEx($model, 'wswg_body'); ?>
	<?php $this->widget('appext.ckeditor.CKEditorWidget', array(
		'model' => $model,
		'attribute' => 'wswg_body',
		'config' => array(
			'width' => '99%'
		),
	)); ?>
	<?php echo $form->error($model, 'wswg_body'); ?>
</div>

