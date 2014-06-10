<section id="<?= $this->getId() ?>" class="widget teachers">
    <h2><?= $this->title ?></h2>
    <? $count = count($teachers) ?>
    <p class="desc"><?= SiteHelper::pluralize($count, array('сотрудник', 'сотрудника', 'сотрудников')) ?></p>

    <div>
        <? foreach ( $teachers as $teacher ): ?>
            <p class="item"><a href="#p<?= $teacher->id ?>"><?= $teacher->fullName ?></a></p>
            <div id="p<?= $teacher->id ?>" class="teachers-portrait">
                <?= $teacher->getImage('small') ?>
                <h3><?= $teacher->fullName ?></h3>
                <p class="birth_day">День рождения: <strong><?= SiteHelper::russianDate($teacher->birth_day) ?></strong></p>
                <?= $teacher->description ?>
            </div>
        <? endforeach ?>
    </div>
</section>