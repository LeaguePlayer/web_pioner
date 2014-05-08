<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'activity-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php $tabs = array(); ?>
	<?php $tabs[] = array('label' => 'Основные данные', 'content' => $this->renderPartial('_rows', array('form'=>$form, 'model' => $model), true), 'active' => true); ?>
	
	<?php $this->widget('bootstrap.widgets.TbTabs', array( 'tabs' => $tabs)); ?>

	<div class="form-actions">
		<?php echo TbHtml::submitButton('Сохранить', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)); ?>
		<?php echo TbHtml::linkButton('Отмена', array('url'=>array('/admin/structure/list', 'opened'=>$_GET['node_id']))); ?>
		<?php $node_id = isset($_GET['node_id']) ? $_GET['node_id'] : $model->node->id ?>
		<?php if ( is_numeric($node_id) ) echo TbHtml::linkButton('← Раздел', array(
			'url'=>array('/admin/structure/update', 'id'=>$node_id)
		)); ?>
	</div>

<?php $this->endWidget(); ?>
