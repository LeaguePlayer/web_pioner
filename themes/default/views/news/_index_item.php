<div class="list-item">
	<a href="<?= $data->getUrl() ?>">
		<?= $data->getImage('small', '', array('width' => 234)) ?>
	</a>
	<div class="desc">
		<h3><?= $data->title ?></h3>
		<p><?= SiteHelper::russianDate($data->date_public) ?></p>
	</div>
</div>