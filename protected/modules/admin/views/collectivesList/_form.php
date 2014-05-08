
<?php echo TbHtml::linkButton('Добавить колектив', array(
    'icon'=>TbHtml::ICON_PLUS,
    'url'=>array('/admin/collective/create', 'list_id'=>$model->id)
)); ?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
    'id'=>'news-grid',
    'dataProvider'=>$collectiveFinder->search(),
    'filter'=>$collectiveFinder,
    'type'=>TbHtml::GRID_TYPE_HOVER,
    'afterAjaxUpdate'=>"function() {sortGrid('news')}",
    'rowHtmlOptionsExpression'=>'array(
            "id"=>"items[]_".$data->id,
            "class"=>"status_".$data->status,
        )',
    'columns'=>array(
        array(
            'name'=>'name',
            'type'=>'raw',
            'value'=>'TbHtml::link($data->name, array("/admin/collectivesStructure/list", "collective_id"=>$data->id))'
        ),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{update}{delete}',
            'buttons'=>array(
                'delete'=>array(
                    'url'=>'array("/admin/collective/delete", "id"=>$data->id)'
                ),
                'update'=>array(
					'label'=>'Материалы',
                    'url'=>'array("/admin/collective/update/", "id"=>$data->id)',
                ),
            ),
        ),
    ),
)); ?>
