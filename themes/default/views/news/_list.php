
<?php
	$this->widget('zii.widgets.CListView', array(
		'dataProvider' => $dataProvider,
		'itemView' => '_item',
		'template' => '{items}',
		'htmlOptions' => array(
			'class' => 'news-list',
		)
	));
?>