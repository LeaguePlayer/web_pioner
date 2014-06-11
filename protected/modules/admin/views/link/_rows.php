<div class="control-group">
    <label class="control-label" for="select_section">Выберите раздел</label>
    <div class="controls">
        <div class="row-fluid">
            <? $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
                'name' => 'select_section',
                'data' => array(''),
                'htmlOptions' => array(
                    'class' => 'span8',
                )
            )) ?>
        </div>
    </div>
</div>


	<?php echo $form->textFieldControlGroup($model,'url',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->textFieldControlGroup($model,'label',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->dropDownListControlGroup($model, 'status', Link::getStatusAliases(), array('class'=>'span8', 'displaySize'=>1)); ?>
