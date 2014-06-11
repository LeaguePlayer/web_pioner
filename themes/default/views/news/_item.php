<div class="list-item">
	<?php $url = $data->getUrl() ?>
	<a href="<?= $url ?>">
		<?= $data->getImage('small', '', array('width' => 234)) ?>
	</a>
	<div class="desc">
		<p><?= SiteHelper::russianDate($data->date_public) ?></p>
		<h3><?= $data->title ?></h3>
	</div>
</div>