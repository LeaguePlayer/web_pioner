<section class="page">
    <h2>Расписание занятий «<?= $model->name ?>»</h2>

    <? $this->widget('application.widgets.schedule.Schedule', array(
        'collective' => $model
    )); ?>
</section>