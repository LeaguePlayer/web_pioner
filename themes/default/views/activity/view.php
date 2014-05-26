
<section class="page">
	<h2><?= $node->name ?></h2>

	<ul class="links">
		<? foreach ( $node->children()->findAll() as $subNode ): ?>
			<li><a href="<?= $subNode->getUrl() ?>"><?= $subNode->name ?></a></li>
		<? endforeach ?>
	</ul>
</section>
