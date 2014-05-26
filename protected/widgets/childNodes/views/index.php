<ul class="links grid">
	<? foreach ( $this->node->children()->findAll() as $node ): ?>
		<li><a href="<?= $node->getUrl() ?>"><?= $node->name ?></a></li>
	<? endforeach ?>
</ul>