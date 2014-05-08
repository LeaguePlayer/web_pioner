	<?php echo $form->textAreaControlGroup($model,'json_events',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldControlGroup($model,'node_id',array('class'=>'span8','maxlength'=>11)); ?>

	<?php echo $form->dropDownListControlGroup($model, 'status', CollectiveShedule::getStatusAliases(), array('class'=>'span8', 'displaySize'=>1)); ?>
