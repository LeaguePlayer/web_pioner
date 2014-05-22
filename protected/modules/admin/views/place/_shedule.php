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
					<label class="control-label">Педагоги</label>
					<div class="controls" style="margin-bottom: 15px;">
						<?php
						$teachersList = array();
						//					$teachersListNode = CollectivesStructure::model()->getComponent('CollectiveTeachersList');
						//					if ( $teachersListNode ) {
						//						$teachersList = CHtml::listData($teachersListNode->teachers, 'id', 'short_name');
						//					}
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
</fieldset>