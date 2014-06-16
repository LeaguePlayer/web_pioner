
<div class="page">
	<div class="columns">
		<div class="col-main">
			<section class="collective">
				<h2><?= $model->name ?></h2>
                <?= ( $model->img_preview ) ? $model->getImage('medium', '', array('style'=>'max-width:730px;')) : '' ?>
				<?php echo $model->description ?>

                <? $this->renderPartial('//site/_likes') ?>
			</section>
		</div>
		<div class="col-sidebar">
			<ul class="links grid">
				<? foreach ( $nodes as $node ): ?>
					<li><a href="<?= $node->getUrl() ?>"><?= $node->name ?></a></li>
				<? endforeach ?>
                <li><a href="<?= $this->createUrl('/collective/schedule', array('collective_id' => $model->id)) ?>">Расписание</a></li>
			</ul>
		</div>
	</div>
</div>
