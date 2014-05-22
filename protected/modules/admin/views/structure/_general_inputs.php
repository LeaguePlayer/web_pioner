<?php

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

if ( $model->isNewRecord ) {
	Yii::app()->clientScript->registerScript('STRUCTURE_FORM', $js);
}

?>



<?= $form->textFieldControlGroup($model, 'name',array('class'=>'span12','maxlength'=>255)); ?>

<?php
//    $prependText = $parent ? strtr($parent->url.'/', array('/' => ' / ')) : ' / ';
?>
<?= $form->textFieldControlGroup($model, 'url',array('class'=>'span12','maxlength'=>255, 'prepend' => $prependText)); ?>

<?php //if($model->parent_id != 0) //main page
//    echo $form->dropDownListControlGroup($model, 'parent_id', $model->getTreeListData(), array('class'=>'span6')); ?>
<?php
$criteria = new CDbCriteria();
$criteria->addInCondition('class_name', array('Page', 'NewsList', 'Activity', 'Section', 'CollectivesList', 'PlacesList', 'EmployeeList'));
$materialsTypes = CHtml::listData(Material::model()->findAll($criteria), 'id', 'name');
?>
<?= $form->dropDownListControlGroup($model, 'material_id', $materialsTypes, array('class'=>'span12', 'empty'=>'Выберите тип раздела')); ?>

<?= $form->dropDownListControlGroup($model, 'status', Structure::getStatusAliases(), array('class'=>'span12', 'displaySize'=>1)); ?>