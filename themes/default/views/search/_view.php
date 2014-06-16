<div class="item">
    <h3><?php echo CHtml::link(CHtml::encode($data->title), $data->material->url); ?></h3>
    <p><?php echo SearchHighlighter::getFragment(strip_tags($data->text), $query); ?></p>
</div>
