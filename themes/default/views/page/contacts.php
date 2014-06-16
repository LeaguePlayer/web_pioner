
<div class="columns">
	<div class="col-main">
		<section class="page">
			<h2><?= $node->name ?></h2>
			<?= $page->wswg_body ?>

            <? $this->renderPartial('//site/_likes') ?>
		</section>
	</div>

	<div class="col-sidebar">
		<ul class="links">
			<? foreach ( $node->children()->published()->findAll() as $subNode ): ?>
				<li><a href="<?= $subNode->getUrl() ?>"><?= $subNode->name ?></a></li>
			<? endforeach ?>
		</ul>
	</div>
</div>