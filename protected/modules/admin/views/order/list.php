<?php
//$this->menu=array(
//	array('label'=>'Добавить','url'=>array('create')),
//);
?>

<?
	Yii::app()->clientScript->registerScriptFile($this->getAssetsUrl().'/js/order.list.js', CClientScript::POS_END);
?>

<h3>Управление заявками</h3>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'order-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'type'=>TbHtml::GRID_TYPE_HOVER,
    'rowHtmlOptionsExpression'=>'array(
        "id"=>"items[]_".$data->id,
        "class"=>"status-".$data->statusAlias,
    )',
	'columns'=>array(
		'collective.name',
		array(
			'name'=>'gender',
			'type'=>'raw',
			'value'=>'$data->getLookupValue("gender")',
			'filter'=>Order::lookup('gender')
		),
		'age',
		'name',
		'phone',
		'email',
		array(
			'name'=>'status',
			'type'=>'raw',
			'value'=>'$data->getLookupValue("status")',
			'filter'=>Order::lookup('status')
		),
//		array(
//			'name'=>'create_time',
//			'type'=>'raw',
//			'value'=>'$data->create_time ? SiteHelper::russianDate($data->create_time).\' в \'.date(\'H:i\', strtotime($data->create_time)) : ""'
//		),
//		array(
//			'name'=>'update_time',
//			'type'=>'raw',
//			'value'=>'$data->update_time ? SiteHelper::russianDate($data->update_time).\' в \'.date(\'H:i\', strtotime($data->update_time)) : ""'
//		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template' => '{view} {success} {delete}',
			'buttons' => array(
				'view' => array(
					'label' => 'Взять в работу',
				),
				'success' => array(
					'icon' => TbHtml::ICON_OK,
					'label' => 'Выполнено',
					'url' => 'array("/admin/order/success", "id"=>$data->id)',
					'options' => array(
						'class' => 'success'
					),
					'visible' => '!$data->isSuccess'
				)
			)
		),
	),
)); ?>
