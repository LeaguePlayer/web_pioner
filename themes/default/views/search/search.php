<section class="search-page">
    <h1>Поиск по запросу <?php echo CHtml::encode($query); ?></h1>
    <?php $this->widget( 'zii.widgets.CListView', array(
        'dataProvider'=>$dataProvider,
        'itemView'=>'_view',
        'viewData'=> array('query'=>$query),
        'emptyText'=>'По вашему запросу ничего не найдено'
    )); ?>
</section>
