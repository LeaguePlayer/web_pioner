<?php
/*
$js = <<< EOT
	$(document).ready(function() {
		var alias_input = $('#Structure_url');
		$('#Structure_name').keyup(function(e) {
			alias_input.val( transliterate($(this).val()) );
		});

		$('#Structure_name').change(function(e) {
			alias_input.val( transliterate($(this).val()) );
		});
	});
EOT;
Yii::app()->clientScript->registerScript('STRUCTURE_FORM', $js);
*/
?>



<?= $form->textFieldControlGroup($model, 'name',array('class'=>'span12','maxlength'=>255)); ?>

<?//= $form->textFieldControlGroup($model, 'url',array('class'=>'span12','maxlength'=>255, 'prepend' => $prependText)); ?>

<?php
$criteria = new CDbCriteria();
$criteria->addInCondition('class_name', array('CollectivePage', 'CollectiveGalleriesList', 'CollectiveShedule', 'CollectiveNewsList', 'CollectiveEventList'));
$materialsTypes = CHtml::listData(Material::model()->findAll($criteria), 'id', 'name');
?>
<?= $form->dropDownListControlGroup($model, 'material_id', $materialsTypes, array('class'=>'span12', 'empty'=>'Выберите тип раздела')); ?>

<?= $form->dropDownListControlGroup($model, 'status', Structure::getStatusAliases(), array('class'=>'span12', 'displaySize'=>1)); ?>