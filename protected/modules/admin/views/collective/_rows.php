	<?php echo $form->textFieldControlGroup($model,'name',array('class'=>'span8','maxlength'=>255)); ?>

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
		<?php //echo CHtml::activeLabelEx($model, 'description'); ?>
		<?php
//		$this->widget('appext.ckeditor.CKEditorWidget', array(
//			'model' => $model,
//			'attribute' => 'description',
//			'config' => array(
//				'width' => '99%'
//			),
//		));
		?>
		<?php //echo $form->error($model, 'description'); ?>
	</div>


	<?php echo $form->dropDownListControlGroup($model,'employeesArray', CHtml::listData(Employee::model()->findAll(array('order'=>'short_name')), 'id', 'short_name'), array('class'=>'span12', 'multiple'=>true)); ?>


	<div class='control-group' style="overflow: hidden;">
		<?php echo CHtml::activeLabelEx($model, 'description'); ?>
		<?php $this->widget('appext.imperavielfinder.imperavi-redactor-widget.ImperaviRedactorWidget', array(
			'model' => $model,
			'attribute' => 'description',
			'options' => array(
				'lang' => 'ru',
				'iframe' => true,
				'minHeight' => 500,
				'css' => $this->getAssetsUrl('application').'/css/main.css',
				'thumbLinkClass' => 'athumbnail', //Класс по-умолчанию для ссылки на полное изображение вокруг thumbnail
				'thumbClass' => 'thumbnail pull-left', //Класс по-умолчанию для  thumbnail
				'defaultUplthumb' => true, //Вставлять по-умолчанию после загрузки превью? если нет - полное изображение
				'fmUrl' => Yii::app()->createUrl('/admin/file/fileUploaderConnector'), //ссылка на ElFinderConnectorAction
			),
			'plugins' => array(
				'fullscreen' => array(
					'js' => array('fullscreen.js',),
				),
				'fontsize' => array(
					'js' => array('fontsize.js',),
				),
				'fontcolor' => array(
					'js' => array('fontcolor.js',),
				),
				'extelf' => array(
					'js' => array('extelf.js',),
				),
			),
		)); ?>
		<?php echo $form->error($model, 'description'); ?>
	</div>


