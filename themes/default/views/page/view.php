
<div>
	<?php $this->widget('zii.widgets.CBreadcrumbs', array(
		'separator'=>' → ',
		'links'=>$this->breadcrumbs,
	)); ?>
</div>

<?
	//echo $this->renderPartial('test');
?>

<section class="page">
	<h2><?= $node->name ?></h2>
	<? if ( empty($page->wswg_body) ): ?>
		<ul class="links">
			<? foreach ( $node->children()->findAll() as $subNode ): ?>
				<li><a href="<?= $subNode->getUrl() ?>"><?= $subNode->name ?></a></li>
			<? endforeach ?>
		</ul>
	<? else: ?>
		<?= $page->wswg_body ?>
	<?php endif ?>
</section>
