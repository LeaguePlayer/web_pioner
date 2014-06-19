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
        <? foreach ( $data->nodes as $collectiveNode ): ?>
		<a href="<?= $collectiveNode->getUrl() ?>"><?= $collectiveNode->name ?></a>
		<? endforeach ?>
        <a class="order" href="#" rel="<?= $data->id ?>">Записаться</a>
	</div>
</div>
