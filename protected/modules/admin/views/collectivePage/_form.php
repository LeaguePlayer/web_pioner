<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'page-form',
	'enableAjaxValidation'=>false,
		'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php $this->widget('bootstrap.widgets.TbTabs', array(
		'tabs' => array(
			array(
				'label' => 'Параметры страницы',
				'content' => $this->renderPartial('_rows', array(
					'form'=>$form,
					'model'=>$model,
					'node' => $node
				), true),
				'active' => true
			),
			array(
				'label' => 'Галерея',
				'content' => $this->renderPartial('_gallery', array(
					'form' => $form,
					'model' => $model
				), true),
			),
		),
	)); ?>

	<div class="form-actions">
		<?php echo TbHtml::submitButton('Сохранить', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)); ?>
        <?php echo TbHtml::linkButton('Отмена', array('url'=>array('/admin/collectivesStructure/list', 'collective_id'=>$model->node->collective->id))); ?>
	</div>

<?php $this->endWidget(); ?>
