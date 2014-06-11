
<div class="list-item">
	<?php $url = $this->createUrl('/video/view', array('id' => $data->id)) ?>
	<a href="<?= $url ?>">
		<?= $data->getImage('small') ?>
	</a>
	<div class="desc">
        <p><?= SiteHelper::russianDate($data->date_publish) ?></p>
        <h3><?= $data->name ?></h3>
	</div>
</div>
