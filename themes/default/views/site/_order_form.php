<div class="form" id="order-form-modal">
	<h3>Запись на посещение занятий</h3>

	<?php $form = $this->beginWidget('CActiveForm', array(
		'id' => 'order-form',
		'action' => $this->createUrl('site/order'),
		'enableClientValidation' => true,
		'clientOptions' => array(
			'validateOnType' => true,
			'validateOnSubmit' => true,
			'afterValidate' => "js: function(form, data, hasError) {
						if ( hasError ) return;
						var form = $(form);
						$.ajax({
							url: form.attr('action'),
							type: 'POST',
							dataType: 'json',
							data: form.serialize(),
							success: function(data) {
								if ( data.success ) {
									window.location.href = '".$this->createUrl('site/thanks')."';
								}
							}
						});
					}"
		),
		'htmlOptions' => array('class' => 'request_form')
	)) ?>
	<div class="row">
		<?= $form->labelEx($model, 'collective_id') ?>
		<?= $form->dropDownList($model, 'collective_id', CHtml::listData(Collective::model()->findAll(), 'id', 'name'), array('empty' => 'Не выбрано')) ?>
		<div class="wrapError">
			<?= $form->error($model, 'collective_id') ?>
		</div>
	</div>

	<div class="row">
		<?= $form->labelEx($model, 'gender') ?>
		<?= $form->dropDownList($model, 'gender', Order::lookup('gender'), array('empty' => 'Не выбрано')) ?>
		<div class="wrapError">
			<?= $form->error($model, 'gender') ?>
		</div>
	</div>

	<div class="row">
		<?= $form->labelEx($model, 'age') ?>
		<?= $form->textField($model, 'age') ?>
		<div class="wrapError">
			<?= $form->error($model, 'age') ?>
		</div>
	</div>

	<div class="row">
		<?= $form->labelEx($model, 'name') ?>
		<?= $form->textField($model, 'name') ?>
		<div class="wrapError">
			<?= $form->error($model, 'name') ?>
		</div>
	</div>

	<div class="row">
		<?= $form->labelEx($model, 'phone') ?>
		<?= $form->textField($model, 'phone') ?>
		<div class="wrapError">
			<?= $form->error($model, 'phone') ?>
		</div>
	</div>

	<div class="row">
		<?= $form->labelEx($model, 'email') ?>
		<?= $form->textField($model, 'email') ?>
		<div class="wrapError">
			<?= $form->error($model, 'email') ?>
		</div>
	</div>


	<button class="btn">Записаться</button>
	<?php $this->endWidget() ?>
</div>
