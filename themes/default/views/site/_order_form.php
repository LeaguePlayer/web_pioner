<div id="order-form-modal">
	<?php $form = $this->beginWidget('CActiveForm', array(
		'id' => 'order-form',
		'action' => $this->createUrl('collective/order'),
		'enableClientValidation' => true,
		'clientOptions' => array(
			'validateOnType' => true,
			'validateOnSubmit' => true,
			'afterValidate' => "js: function(form, data, hasError) {
						if ( hasError ) return;
						var form = $(form);
						$.ajax({
							url: action,
							type: 'POST',
							dataType: 'json',
							data: form.serialize(),
							success: function(data) {
								if ( data.success ) {
									window.location.href = '".$this->createUrl('creditprogram/thanks')."';
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
		<?= $form->labelEx($model, 'name') ?>
		<?= $form->textField($model, 'name') ?>
		<div class="wrapError">
			<?= $form->error($model, 'name') ?>
		</div>
	</div>
	<button class="btn">Записаться</button>
	<?php $this->endWidget() ?>
</div>
