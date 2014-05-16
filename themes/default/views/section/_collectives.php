<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider' => $dataProvider,
	'itemView'=>'//section/_item',
	'template'=>'{items}',
	'htmlOptions'=>array(
		'class'=>'collectives'
	)
)) ?>