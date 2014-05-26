<div class="item">
	<a class="fancybox" title="<?= CHtml::encode($data->name) ?>" href="<?= $data->getImageUrl('medium') ?>"><?= $data->getImage('small') ?></a>
	<h3><?= $data->name ?></h3>
	<div>
		<? if ( count($data->employees) ): ?>
			<p><b>Тренеры-преподаватели:</b></p>
			<? foreach ( $data->employees as $teacher ): ?>
				<p><?= $teacher->short_name ?></p>
			<? endforeach ?>
		<? endif ?>
	</div>
<!--	<div>-->
<!--		<p><b>Место проведения занятий:</b></p>-->
<!--		<p>ул. Челюскинцев, 46, Дворец искусств «Пионер»</p>-->
<!--	</div>-->
	<div class="buttons">
		<a href="<?= $data->getUrl() ?>">Информация</a>
		<a href="<?= $this->createUrl('/event/index', array('collective_id'=>$data->id)) ?>">Мероприятия</a>
		<a href="<?= $this->createUrl('/news/index', array('collective_id'=>$data->id)) ?>">Новости</a>
		<a href="<?= $this->createUrl('/gallery/index', array('collective_id'=>$data->id)) ?>">Фотоотчеты</a>
		<a class="order" href="<?= $this->createUrl('/collective/order', array('collective_id'=>$data->id)) ?>">Записаться</a>
	</div>
</div>