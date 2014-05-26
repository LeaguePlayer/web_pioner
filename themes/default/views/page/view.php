<?php
/**
 * @var $this PageController
 */
?>

<section class="page">
	<h2><?= $node->name ?></h2>

		<?= $this->decodeWidgets($page->wswg_body) ?>
</section>
