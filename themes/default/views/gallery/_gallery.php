<div class="item">
	<?php $url = $this->createUrl('/gallery/view', array('id' => $data->id)) ?>
	<a href="<?= $url ?>">
		<?= $data->firstPhoto->getImage('small') ?>
	</a>
	<div class="desc">
		<a class="btn" href="<?= $url ?>">8 фото</a>
		<h3>Фестиваль красок</h3>
		<p>21.06.2014</p>
	</div>
</div>