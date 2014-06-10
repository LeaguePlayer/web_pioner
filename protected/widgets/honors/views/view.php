<section id="<?= $this->getId() ?>" class="inline-widget honors-widget">
    <h2><?= $this->title ?></h2>

    <div class="honors-carousel owl-carousel ">
        <? foreach ( $honors as $honor ): ?>
            <div class="item">
                <a rel="honors" title="<?= SiteHelper::russianDate($honor->dt_date) ?>" href="<?= $honor->getImageUrl('big') ?>"><?= $honor->getImage('small') ?></a>
                <p class="desc"><?= $honor->description ?></p>
            </div>
        <? endforeach ?>
    </div>
</section>
