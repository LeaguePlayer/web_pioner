<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'collective-gallery-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php $this->widget('bootstrap.widgets.TbTabs', array(
		'tabs' => array(
			array(
				'label' => 'Параметры галереи',
				'content' => $this->renderPartial('_rows', array(
					'form'=>$form,
					'model'=>$model
				), true),
				'active' => true
			),
			array(
				'label' => 'SEO',
				'content' => $this->getSeoForm($model),
			),
		),
	)); ?>

	<div class="form-actions">
		<?php echo TbHtml::submitButton('Сохранить', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)); ?>
		<?php echo TbHtml::linkButton('Отмена', array('url'=>array('/admin/collectiveGalleriesList/update', 'id' => $model->list->id))); ?>
	</div>

<?php $this->endWidget(); ?>
