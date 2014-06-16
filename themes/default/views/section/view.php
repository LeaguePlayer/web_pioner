
<section class="page">
	<h2><?= $node->name ?></h2>

	<ul class="links">
		<? foreach ( $collectives as $collective ): ?>
			<li><?= CHtml::link($collective->name, array('/collective/view', 'id' => $collective->id)) ?></li>
		<? endforeach ?>
	</ul>

    <? $this->renderPartial('//site/_likes') ?>
</section>
