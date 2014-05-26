<?= CHtml::openTag('div', $this->htmlOptions) ?>
<div class="image-carousel owl-carousel ">
	<? foreach ( $this->items as $item ): ?>
		<div class="item"><?= $item['html'] ?></div>
	<? endforeach ?>
</div>
<? if ( count($this->items) > 1 ): ?>
	<a class="prev" href="#"></a>
	<a class="next" href="#"></a>
<? endif ?>
<?= CHtml::closeTag('div') ?>
