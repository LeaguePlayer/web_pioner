	<?php echo $form->textFieldControlGroup($model,'name',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->textFieldControlGroup($model,'short_name',array('class'=>'span8','maxlength'=>255)); ?>

	<div class='control-group'>
		<?php echo CHtml::activeLabelEx($model, 'img_preview'); ?>
		<?php echo $form->fileField($model,'img_preview', array('class'=>'span3')); ?>
		<div class='img_preview'>
			<?php if ( !empty($model->img_preview) ) echo TbHtml::imageRounded( $model->imgBehaviorPreview->getImageUrl('small') ) ; ?>
			<span class='deletePhoto btn btn-danger btn-mini' data-modelname='Collective' data-attributename='Preview' <?php if(empty($model->img_preview)) echo "style='display:none;'"; ?>><i class='icon-remove icon-white'></i></span>
		</div>
		<?php echo $form->error($model, 'img_preview'); ?>
	</div>

	<?php echo $form->textFieldControlGroup($model,'ageLeft',array('class'=>'span4','maxlength'=>255)); ?>

	<?php echo $form->textFieldControlGroup($model,'ageRight',array('class'=>'span4','maxlength'=>255)); ?>


    <div class='control-group'>
        <?= $form->labelEx($model, 'employeesArray', array('class'=>'control-label')) ?>
        <div class="controls">
            <div class="row-fluid">
                <?php $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
                    'model' => $model,
                    'attribute' => 'employeesArray',
                    'data' => CHtml::listData(Employee::model()->findAll(array('order'=>'short_name')), 'id', 'short_name'),
                    'htmlOptions' => array(
                        'class'=>'span12',
                        'multiple'=>true
                    )
                )) ?>
            </div>
        </div>

        <?php echo $form->error($model, 'employeesArray') ?>
    </div>

	<div class='control-group' style="overflow: hidden;">
		<?php echo CHtml::activeLabelEx($model, 'description'); ?>
        <?php $this->widget('admin.widgets.ImperaviRedactor', array(
            'model' => $model,
            'attribute' => 'description',
            'redactorOptions' => array(
                'css' => $this->getAssetsUrl('application').'/css/main.css',
            )
        )) ?>
		<?php echo $form->error($model, 'description'); ?>
	</div>


