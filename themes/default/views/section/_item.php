<div class="item">
	<a class="fancybox" title="<?= CHtml::encode($data->name) ?>" href="<?= $data->getImageUrl('medium') ?>"><?= $data->getImage('small') ?></a>
	<h3><?= $data->name ?></h3>
<!--	<div>-->
<!--		<p><b>Тренеры-преподаватели:</b></p>-->
<!--		<p>Иванов Иван Иванович</p>-->
<!--		<p>Иванов Иван Иванович</p>-->
<!--	</div>-->
<!--	<div>-->
<!--		<p><b>Место проведения занятий:</b></p>-->
<!--		<p>ул. Челюскинцев, 46, Дворец искусств «Пионер»</p>-->
<!--	</div>-->
	<div class="buttons">
		<a href="<?= $data->getUrl() ?>">Информация</a>
<!--		<a href="#">Мероприятия</a>-->
<!--		<a href="#">Преподаватели</a>-->
<!--		<a href="#">Контакты</a>-->
<!--		<a href="#">Записаться</a>-->
	</div>
</div>