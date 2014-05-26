<?= CHtml::openTag('div', $this->htmlOptions) ?>
	<div class="image-carousel owl-carousel ">
		<? foreach ( $this->items as $item ): ?>
			<div class="item"><?= CHtml::image($item['img']) ?></div>
		<? endforeach ?>
	</div>
	<div class="captions">
		<div class="carousel-viewport">
			<div class="caption-carousel-wrap">
				<div class="caption-carousel owl-carousel ">
					<? foreach ( $this->items as $item ): ?>
						<div class="item">
							<h3><?= $item['title'] ?></h3>
							<p><?= $item['desc'] ?></p>
							<a class="news-url" href="<?= $item['url'] ?>"></a>
						</div>
					<? endforeach ?>
				</div>
			</div>
		</div>
		<? if ( count($this->items) > 1 ): ?>
			<a class="prev" href="#"></a>
			<a class="next" href="#"></a>
		<? endif ?>
	</div>
<?= CHtml::closeTag('div') ?>
