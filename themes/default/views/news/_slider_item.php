
<div class="news-slider-content">
	<?= $data->getImage('slider', '', array('width' => 340, 'height' => 226)) ?>
	<p class="date"><?= date('d.m.Y', strtotime($data->date_public)) ?></p>
	<p class="title"><?= $data->title ?></p>
	<p><?= $data->short_description ?></p>
	<a class="btn" href="<?= $data->getUrl() ?>">Подробнее</a>
</div>