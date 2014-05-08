	<?php echo $form->textArea($model,'json_events',array('class'=>'hidden')); ?>

	<?php echo $form->dropDownListControlGroup($model, 'status', CollectiveShedule::getStatusAliases(), array('class'=>'span8', 'displaySize'=>1)); ?>
