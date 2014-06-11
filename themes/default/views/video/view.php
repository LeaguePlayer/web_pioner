<?php
	$cs = Yii::app()->clientScript;
	$assetsUrl = $this->getAssetsUrl();
?>

<div class="columns">
    <div class="col-main width-680">
        <p class="videowrapper auto-size"><?= strip_tags($model->code); ?></p>

        <div class="page">
            <h2><?= $model->name ?></h2>
            <p class="date"><?= SiteHelper::russianDate($model->date_publish); ?></p>
            <?= $model->description ?>
        </div>
    </div>

    <div class="col-sidebar">
        <div class="news-calendar">
            <?php $this->widget('appwidgets.newsCalendar.NewsCalendar') ?>
        </div>

        <div class="video-scroller">
            <div class="scroller">
                <div class="content">
                    <?php $this->widget('zii.widgets.CListView', array(
                        'template' => '{items}',
                        'dataProvider' => $otherVideosData,
                        'itemView' => '_item',
                        'htmlOptions' => array(
                            'class' => 'video'
                        )
                    )) ?>
                </div>

                <div class="scroller__track">
                    <div class="scroller__bar"></div>
                </div>
            </div>
        </div>
    </div>
</div>
