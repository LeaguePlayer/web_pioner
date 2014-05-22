
<div class="news-description">
	<h3><?= $model->title ?></h3>
	<div class="desc">
		<?= $model->short_description ?>
	</div>
	<a class="btn" href="<?= $model->getUrl() ?>">Подробнее</a>
</div>