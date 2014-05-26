	<?php echo $form->textFieldControlGroup($model,'name',array('class'=>'span8','maxlength'=>255)); ?>

	<div class='control-group'>
		<?php echo CHtml::activeLabelEx($model, 'img_preview'); ?>
		<?php echo $form->fileField($model,'img_preview', array('class'=>'span3')); ?>
		<div class='img_preview'>
			<?php if ( !empty($model->img_preview) ) echo TbHtml::imageRounded( $model->imgBehaviorPreview->getImageUrl('small') ) ; ?>
			<span class='deletePhoto btn btn-danger btn-mini' data-modelname='Place' data-attributename='Preview' <?php if(empty($model->img_preview)) echo "style='display:none;'"; ?>><i class='icon-remove icon-white'></i></span>
		</div>
		<?php echo $form->error($model, 'img_preview'); ?>
	</div>

	<?php //echo $form->textAreaControlGroup($model,'description',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

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
//				'allowedTags' => array('p', 'h1', 'h2', 'pre', 'div', 'ul', 'li'),
				'convertDivs' => false,
//				'tabSpaces' => 2,
//				'paragraphy' => false,
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


	<?php echo $form->textFieldControlGroup($model,'address',array('class'=>'span8','maxlength'=>255)); ?>

