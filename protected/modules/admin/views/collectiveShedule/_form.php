<?php
	$cs = Yii::app()->clientScript;
	$assetsUrl = $this->getAssetsUrl();

	$cs->registerCoreScript('jquery.ui');
	$cs->registerCssFile( $assetsUrl.'/vendor/fullcalendar/fullcalendar.css');
	$cs->registerScriptFile( $assetsUrl.'/vendor/fullcalendar/fullcalendar.js', CClientScript::POS_END );

	$cs->registerCssFile( $assetsUrl.'/vendor/twbt-timepicker/css/bootstrap-timepicker.css' );
	$cs->registerScriptFile( $assetsUrl.'/vendor/twbt-timepicker/js/bootstrap-timepicker.js', CClientScript::POS_END );

	$cs->registerCssFile( $assetsUrl.'/vendor/select2/select2.css' );
	$cs->registerScriptFile( $assetsUrl.'/vendor/select2/select2.min.js', CClientScript::POS_END );
	$cs->registerScriptFile( $assetsUrl.'/vendor/select2/select2_locale_ru.js', CClientScript::POS_END );

	$cs->registerCssFile( $assetsUrl.'/css/shedule.form.css' );
	$cs->registerScriptFile( $assetsUrl.'/js/shedule.form.js', CClientScript::POS_END );
?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'collective-shedule-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php $tabs = array(); ?>
	<?php $tabs[] = array('label' => 'Основные данные', 'content' => $this->renderPartial('_rows', array('form'=>$form, 'model' => $model), true), 'active' => true); ?>
	
	<?php $this->widget('bootstrap.widgets.TbTabs', array( 'tabs' => $tabs)); ?>


	<div id="shedule"></div>


	<div class="form-actions">
		<?php echo TbHtml::submitButton('Сохранить', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)); ?>
		<?php echo TbHtml::linkButton('Отмена', array('url'=>array('/admin/collectivesStructure/list', 'collective_id'=>$model->node->collective->id))); ?>
	</div>

<?php $this->endWidget(); ?>



<!-- Edit Schedule Event -->
<div id="eventFormModal" class="modal hide fade">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3></h3>
	</div>
	<div class="modal-body">
		<div class="evform">
			<div class="control-group">
				<label class="control-label">Время занятия</label>
				<div class="controls">
					<input class="event-start span3" type="text" /> - <input class="event-end span3" type="text" />
				</div>
			</div>

			<div class="control-group">
				<label class="control-label">Предмет</label>
				<div class="controls">
					<input class="event-title span12" type="text" placeholder="Введите название занятия" />
				</div>
			</div>

			<div class="control-group">
				<label class="control-label">Педагоги</label>
				<div class="controls" style="margin-bottom: 15px;">
					<?php
					$teachersList = array();
					$teachersListNode = CollectivesStructure::model()->getComponent('CollectiveTeachersList');
					if ( $teachersListNode ) {
						$teachersList = CHtml::listData($teachersListNode->teachers, 'id', 'short_name');
					}
					?>
					<?= TbHtml::dropDownList('', '', $teachersList, array(
						'multiple' => true,
						'class' => 'event-teachers span12',
					)) ?>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label">Периодичность</label>
				<div class="controls">
					<label class="radio"><input type="radio" class="period" name="period" value="0" checked="checked" /> Нет</label>
					<label class="radio"><input type="radio" class="period" name="period" value="every_day" /> Каждый день</label>
					<label class="radio"><input type="radio" class="period" name="period" value="every_weekdays" /> Каждый день по будням</label>
					<label class="radio"><input type="radio" class="period" name="period" value="every_week" /> Раз в неделю</label>
<!--					<label class="radio"><input type="radio" class="period" name="period" value="every_two_weeks" /> Через две недели</label>-->
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<a href="#" class="btn" data-dismiss="modal" aria-hidden="true">Отмена</a>
		<a href="#" class="btn btn-danger delete">Удалить</a>
		<a href="#" class="btn btn-primary event-save">Сохранить</a>
	</div>
</div>
