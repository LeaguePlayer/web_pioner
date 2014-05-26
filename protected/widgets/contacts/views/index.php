<div class="contacts">
	<? if ( $this->title ): ?>
	<h2><?= $this->title ?></h2>
	<? endif ?>

	<? foreach ( $places as $i => $place ): ?>
		<div class="item">
			<div class="info">
				<h3><?= $place->name ?></h3>
				<?= $place->description ?>
			</div>
			<div class="map" id="map-<?= $i + 1 ?>"></div>
		</div>
	<? endforeach ?>
</div>