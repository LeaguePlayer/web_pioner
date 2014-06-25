
<div id="event-<?=$data->id?>" class="item">
    <h2><?= $data->title ?></h2>
    <a href="<?= $data->getUrl() ?>"><?= $data->getImage('small') ?></a>
    <p>Дата проведения: <a href="#"><?= SiteHelper::russianDate($data->date_public) ?></a></p>
    <p><?= $data->short_description ?></p>
    <p style="text-align: center"><a class="btn" href="<?= $data->getUrl() ?>">Подробнее</a></p>
</div>