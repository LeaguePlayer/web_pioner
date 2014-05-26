
<div class="page">
	<div class="columns">
		<div class="col-main">
			<section class="collective">
				<h2><?= $model->name ?></h2>
				<?php echo $model->description ?>
			</section>
		</div>
		<div class="col-sidebar">
			<ul class="links grid">
				<? foreach ( $nodes as $node ): ?>
					<li><a href="<?= $node->getUrl() ?>"><?= $node->name ?></a></li>
				<? endforeach ?>
			</ul>
		</div>
	</div>
</div>
