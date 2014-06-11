
<div class='control-group'>
    <?php echo CHtml::activeLabelEx($model, 'img_preview'); ?>
    <?php echo $form->fileField($model,'img_preview', array('class'=>'span3')); ?>
    <div class='img_preview'>
        <?php if ( !empty($model->img_preview) ) echo TbHtml::imageRounded( $model->imgBehaviorPreview->getImageUrl('small') ) ; ?>
        <span class='deletePhoto btn btn-danger btn-mini' data-modelname='CollectiveVideo' data-attributename='img_preview' <?php if(empty($model->img_preview)) echo "style='display:none;'"; ?>><i class='icon-remove icon-white'></i></span>
    </div>
    <?php echo $form->error($model, 'img_preview'); ?>
</div>

<?php echo $form->textFieldControlGroup($model,'name',array('class'=>'span8','maxlength'=>255)); ?>

<?php echo $form->textAreaControlGroup($model,'code',array('class'=>'span8','rows'=>8,'maxlength'=>255)); ?>

<div class='control-group' style="overflow: hidden;">
    <?php echo CHtml::activeLabelEx($model, 'description'); ?>
    <?php $this->widget('appext.imperavielfinder.imperavi-redactor-widget.ImperaviRedactorWidget', array(
        'model' => $model,
        'attribute' => 'description',
        'options' => array(
            'css' => $this->getAssetsUrl('application').'/css/main.css',
            'fmUrl' => Yii::app()->createUrl('/admin/file/fileUploaderConnector'), //ссылка на ElFinderConnectorAction
        ),
    )); ?>
    <?php echo $form->error($model, 'description'); ?>
</div>

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

<?= $form->dropDownListControlGroup($model, 'status', CollectiveVideo::getStatusAliases(), array('class'=>'span12', 'displaySize'=>1)); ?>
