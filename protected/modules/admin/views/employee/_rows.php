<div class='control-group'>
		<?php echo CHtml::activeLabelEx($model, 'img_photo'); ?>
		<?php echo $form->fileField($model,'img_photo', array('class'=>'span3')); ?>
		<div class='img_preview'>
			<?php if ( !empty($model->img_photo) ) echo TbHtml::imageRounded( $model->imgBehaviorPhoto->getImageUrl('small') ) ; ?>
			<span class='deletePhoto btn btn-danger btn-mini' data-modelname='CollectiveTeacher' data-attributename='Photo' <?php if(empty($model->img_photo)) echo "style='display:none;'"; ?>><i class='icon-remove icon-white'></i></span>
		</div>
		<?php echo $form->error($model, 'img_photo'); ?>
	</div>

	<?php echo $form->textFieldControlGroup($model,'family',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldControlGroup($model,'first_name',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldControlGroup($model,'last_name',array('class'=>'span5','maxlength'=>255)); ?>

	<div class='control-group'>
		<?php echo CHtml::activeLabelEx($model, 'birth_day'); ?>
		<?php $this->widget('yiiwheels.widgets.datetimepicker.WhDateTimePicker', array(
			'model' => $model,
			'attribute' => 'birth_day',
			'pluginOptions' => array(
				'format' => 'dd-MM-yyyy',
				'language' => 'ru',
				'pickSeconds' => false,
				'pickTime' => false
			)
		)); ?>
		<?php echo $form->error($model, 'birth_day'); ?>
	</div>

	<?php echo $form->textFieldControlGroup($model,'post',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->dropDownListControlGroup($model, 'status', CollectiveTeacher::getStatusAliases(), array('class'=>'span8', 'displaySize'=>1)); ?>

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

    <?php echo $form->textFieldControlGroup($model,'rank',array('class'=>'span8','maxlength'=>255)); ?>
