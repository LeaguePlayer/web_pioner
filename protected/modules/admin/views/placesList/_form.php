<?php echo TbHtml::linkButton('Добавить место', array(
    'icon'=>TbHtml::ICON_PLUS,
    'url'=>array('/admin/place/create', 'list_id'=>$model->id)
)); ?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
    'id'=>'place-grid',
    'dataProvider'=>$placeFinder->search(),
    'filter'=>$placeFinder,
    'type'=>TbHtml::GRID_TYPE_HOVER,
    'afterAjaxUpdate'=>"function() {sortGrid('place')}",
    'rowHtmlOptionsExpression'=>'array(
		"id"=>"items[]_".$data->id,
		"class"=>"status_".$data->status,
	)',
    'columns'=>array(
        array(
            'name'=>'img_preview',
            'type'=>'raw',
            'value'=>'$data->getImage("icon")',
            'filter'=>false
        ),
        array(
            'name'=>'name',
            'type'=>'raw',
            'value'=>'TbHtml::link($data->name, array("/admin/place/update/", "id"=>$data->id))'
        ),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{delete}',
            'buttons'=>array(
                'delete'=>array(
                    'url'=>'array("/admin/place/delete", "id"=>$data->id)'
                ),
                'view'=>array(
                    'url'=>'array("/admin/place/view", "id"=>$data->id)'
                ),
            ),
        ),
    ),
)); ?>
