<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'object-form',
	'enableAjaxValidation'=>false,
		'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>
    <div class="form-actions">
        <?php echo $form->errorSummary($model); ?>

        <?php if ( Yii::app()->user->hasFlash('SAVED') ) {
            echo TbHtml::alert(TbHtml::ALERT_COLOR_INFO, Yii::app()->user->getFlash('SAVED'));
        } ?>

        <?php echo $form->textFieldControlGroup($model, 'page_size', array('class'=>'span2')) ?>

        <?php echo TbHtml::submitButton('Сохранить', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)); ?>
        <?php echo TbHtml::linkButton('Отмена', array('url'=>array('/admin/collectivesStructure/list', 'collective_id'=>$model->node->collective->id))); ?>
    </div>
<?php $this->endWidget(); ?>




<?php echo TbHtml::linkButton('Добавить новость', array(
    'icon'=>TbHtml::ICON_PLUS,
    'url'=>array('/admin/collectiveNews/create', 'list_id'=>$model->id)
)); ?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
    'id'=>'news-grid',
    'dataProvider'=>$newsFinder->search(),
    'filter'=>$newsFinder,
    'type'=>TbHtml::GRID_TYPE_HOVER,
    'afterAjaxUpdate'=>"function() {sortGrid('news')}",
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
            'name'=>'title',
            'type'=>'raw',
            'value'=>'TbHtml::link($data->title, array("/admin/collectiveNews/update/", "id"=>$data->id, "list_id"=>'.$model->id.'))'
        ),
        array(
            'name'=>'status',
            'type'=>'raw',
            'value'=>'CollectiveNews::getStatusAliases($data->status)',
            'filter'=>CollectiveNews::getStatusAliases()
        ),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{delete}',
            'buttons'=>array(
                'delete'=>array(
                    'url'=>'array("/admin/collectiveNews/delete", "id"=>$data->id)'
                ),
                'view'=>array(
                    'url'=>'array("/admin/collectiveNews/view", "id"=>$data->id)'
                ),
            ),
        ),
    ),
)); ?>
