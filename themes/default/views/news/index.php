<section class="gallery">
	<h2><?= $title ?></h2>

	<? $this->widget('zii.widgets.CListView', array(
		'id' => 'news-list',
		'template' => '{items}',
		'dataProvider' => $dataProvider,
		'itemView' => '//news/_index_item'
	)) ?>
</section>