<? $countPhotos = count($data->gallery->galleryPhotos) ?>
<? if ( $countPhotos > 0 ): ?>
<div class="list-item">
	<?php $url = $this->createUrl('/gallery/view', array('id' => $data->id)) ?>
	<a href="<?= $url ?>">
		<?= $data->getFirstPhoto('small') ?>
	</a>
	<div class="desc">
		<a class="btn" href="<?= $url ?>"><?= $countPhotos ?> фото</a>
		<h3><?= $data->name ?></h3>
		<p><?= SiteHelper::russianDate($data->date_publish) ?></p>
	</div>
</div>
<? endif ?>