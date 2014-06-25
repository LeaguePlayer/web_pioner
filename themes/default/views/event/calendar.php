<?
/**
 * @var $this FrontController
 */
    $cs = Yii::app()->clientScript;
    $assetsPath = $this->getAssetsUrl();

    $cs->registerCoreScript('jquery.ui');

    $cs->registerCssFile( $assetsPath.'/vendor/fullcalendar/fullcalendar.css');
    $cs->registerScriptFile( $assetsPath.'/js/lib/moment.min.js', CClientScript::POS_END );
    $cs->registerScriptFile( $assetsPath.'/vendor/fullcalendar/fullcalendar.min.js', CClientScript::POS_END );
    $cs->registerScriptFile( $assetsPath.'/vendor/fullcalendar/lang/ru.js', CClientScript::POS_END );
    $cs->registerScriptFile( $assetsPath.'/js/lib/jquery.scrollTo.min.js', CClientScript::POS_END );
    $cs->registerScriptFile( $assetsPath.'/js/event.calendar.js', CClientScript::POS_END );
?>


<div class="columns">
    <div class="col-main width-680">
        <div id="calendar"></div>
    </div>
    <div class="col-sidebar">
        <div class="event-preview">
            <div class="scroller-wrap">
                <div class="scroller">
                    <div class="content">
                    </div>

                    <span class="loader-orange"></span>

                    <div class="scroller__track">
                        <div class="scroller__bar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>