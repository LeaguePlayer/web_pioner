
<section class="page">
	<h2><?= $node->name ?></h2>

	<? if ( empty($page->wswg_body) ): ?>
		<ul class="links">
			<? foreach ( $node->children()->findAll() as $subNode ): ?>
				<li><a href="<?= $subNode->getUrl() ?>"><?= $subNode->name ?></a></li>
			<? endforeach ?>
		</ul>
	<? else: ?>
		<?= $this->decodeWidgets($page->wswg_body) ?>
	<?php endif ?>
</section>
