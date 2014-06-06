<?php
	$cs = Yii::app()->clientScript;
	$assetsPath = $this->getAssetsUrl();

	$cs->registerScriptFile( $assetsPath.'/vendor/bootbox/bootbox.min.js', CClientScript::POS_END );

	$cs->registerCssFile($assetsPath.'/vendor/kladr/jquery.kladr.min.css');
	$cs->registerScriptFile($assetsPath.'/vendor/kladr/jquery.kladr.min.js', CClientScript::POS_END);

	$cs->registerCoreScript('jquery.ui');

	$cs->registerCssFile( $assetsPath.'/vendor/fullcalendar/fullcalendar.css');
	$cs->registerScriptFile( $assetsPath.'/vendor/fullcalendar/fullcalendar.js', CClientScript::POS_END );

	$cs->registerCssFile( $assetsPath.'/vendor/twbt-timepicker/css/bootstrap-timepicker.css' );
	$cs->registerScriptFile( $assetsPath.'/vendor/twbt-timepicker/js/bootstrap-timepicker.js', CClientScript::POS_END );

	$cs->registerCssFile( $assetsPath.'/vendor/select2/select2.css' );
	$cs->registerScriptFile( $assetsPath.'/vendor/select2/select2.min.js', CClientScript::POS_END );
	$cs->registerScriptFile( $assetsPath.'/vendor/select2/select2_locale_ru.js', CClientScript::POS_END );

	$cs->registerCssFile( $assetsPath.'/css/shedule.form.css' );
	$cs->registerScriptFile( $assetsPath.'/js/shedule.form.js', CClientScript::POS_END );
	$cs->registerScriptFile($assetsPath.'/js/place.form.js', CClientScript::POS_END);
?>


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'place-form',
	'enableAjaxValidation'=>false,
		'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php $tabs = array(); ?>
	<?php $tabs[] = array('label' => 'Основные данные', 'content' => $this->renderPartial('_rows', array('form'=>$form, 'model' => $model), true), 'active' => true); ?>
	<?php $tabs[] = array('label' => 'SEO раздел', 'content' => $this->getSeoForm($model)); ?>
	<?php $this->widget('bootstrap.widgets.TbTabs', array( 'tabs' => $tabs)); ?>




	<fieldset>
		<legend>Расписание</legend>

		<div class="cabinets">
			<div class="buttons">
				<? $events = $model->json_schedule ? CJSON::decode($model->json_schedule) : array(); ?>
				<? foreach ( $events as $cabinet => $eventInfo ): ?>
					<a rel="<?= $cabinet ?>" class="btn btn-mini cabinet" href="#"><?= $cabinet ?></a>
				<? endforeach ?>
			</div>

			<div class="alert alert-info">
				<div class="current_cabinet_info">Выбран кабинет <strong>2</strong> <a class="btn btn-mini btn-danger delete-cabinet" href="#">Удалить</a> или </div> <a class="btn btn-mini btn-primary add-cabinet" href="#">Создать кабинет</a>
			</div>
		</div>

		<?php echo $form->textArea($model,'json_schedule',array('class'=>'hidden')); ?>
		<div id="shedule"></div>
	</fieldset>



	<div class="form-actions">
		<?php echo TbHtml::submitButton('Сохранить', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)); ?>
        <?php echo TbHtml::linkButton('Отмена', array('url'=>Yii::app()->createUrl('/admin/placesList/update', array('id' => $model->list_id)))); ?>
	</div>

<?php $this->endWidget(); ?>



<!-- Edit Schedule Event -->
<div id="eventFormModal" class="modal hide">
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
				<label class="control-label">Коллектив</label>
				<div class="controls" style="margin-bottom: 15px;">
					<?php
						$collectives = Collective::model()->findAll(array('order'=>'list_id, name'));
						$collectivesList = array();
						foreach ( $collectives as $collective ) {
							$collectivesList[$collective->id] = $collective->short_name ? $collective->short_name : $collective->name;
						}
					?>
					<?= TbHtml::dropDownList('', '', $collectivesList, array(
						'class' => 'event-collective span12',
						'empty' => '',
					)) ?>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label">Педагоги</label>
				<div class="controls" style="margin-bottom: 15px;">
					<?php
						$teachers = CHtml::listData(Employee::model()->findAll(array('order'=>'short_name')), 'id', 'short_name');
					?>
					<?= TbHtml::dropDownList('', '', $teachers, array(
						'multiple' => true,
						'class' => 'event-teachers span12',
					)) ?>
				</div>
			</div>

<!--			<div class="control-group">-->
<!--				<label class="control-label">Периодичность</label>-->
<!--				<div class="controls">-->
<!--					<label class="radio"><input type="radio" class="period" name="period" value="0" checked="checked" /> Нет</label>-->
<!--					<label class="radio"><input type="radio" class="period" name="period" value="every_day" /> Каждый день</label>-->
<!--					<label class="radio"><input type="radio" class="period" name="period" value="every_weekdays" /> Каждый день по будням</label>-->
<!--					<label class="radio"><input type="radio" class="period" name="period" value="every_week" /> Раз в неделю</label>-->
<!--					<label class="radio"><input type="radio" class="period" name="period" value="every_two_weeks" /> Через две недели</label>-->
<!--				</div>-->
<!--			</div>-->
		</div>
	</div>
	<div class="modal-footer">
		<a href="#" class="btn" data-dismiss="modal" aria-hidden="true">Отмена</a>
		<a href="#" class="btn btn-danger delete">Удалить</a>
		<a href="#" class="btn btn-primary event-save">Сохранить</a>
	</div>
</div>
