<?php
/**
 * @var $model Order
 */
?>


<?php
	$this->breadcrumbs=array(
		"Заявки"=>array('list'),
		'Обработка заявки № '.$model->id,
	);
?>

<h3>Заявка № «<?= $model->id ?>»</h3>

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm'); ?>

	<?= $form->errorSummary($model) ?>

	<? $this->widget('bootstrap.widgets.TbDetailView', array(
		'data' => $model,
		'attributes' => array(
			'collective.name',
			array(
				'name' => 'gender',
				'type' => 'raw',
				'value' => TbHtml::activeDropDownList($model, 'gender', Order::lookup('gender')),
			),
			array(
				'name' => 'age',
				'type' => 'raw',
				'value' => TbHtml::activeTextField($model, 'age'),
			),
			array(
				'name' => 'name',
				'type' => 'raw',
				'value' => TbHtml::activeTextField($model, 'name'),
			),
			array(
				'name' => 'email',
				'type' => 'raw',
				'value' => TbHtml::activeTextField($model, 'email'),
			),
			array(
				'name' => 'status',
				'value' => $model->getLookupValue('status'),
			),
			array(
				'name' => 'create_time',
				'type' => 'raw',
				'value' => SiteHelper::russianDate($model->create_time)
			),
			array(
				'name' => 'update_time',
				'type' => 'raw',
				'value' => SiteHelper::russianDate($model->update_time).' в '.date('H:i', $model->update_time)
			),
		)
	)) ?>

	<?= TbHtml::activeHiddenField($model, 'status') ?>

	<?= TbHtml::submitButton('Сохранить изменения', array('color' => TbHtml::BUTTON_COLOR_PRIMARY, 'name' => 'action', 'value' => 'save')) ?>
	<?= TbHtml::submitButton('Выполнено', array('color' => TbHtml::BUTTON_COLOR_SUCCESS, 'name' => 'action', 'value' => 'success')) ?>
	<?= TbHtml::linkButton('Отмена', array('url' => array('/admin/order/list'))) ?>

<?php $this->endWidget(); ?>