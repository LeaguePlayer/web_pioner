
<div class="news-slider-content">
	<?= $data->getImage('slider', '', array('width' => 340, 'height' => 226)) ?>
	<div class="content">
		<p class="date"><?= date('d.m.Y', strtotime($data->date_public)) ?></p>
		<p class="title"><?= $data->title ?></p>
		<p><?= SiteHelper::intro($data->short_description, 200) ?></p>
	</div>
	<a class="btn" href="<?= $data->getUrl() ?>">Подробнее</a>
</div>