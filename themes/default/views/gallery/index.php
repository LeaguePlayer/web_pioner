<?
/**
 * @var $gallery Gallery
 */

$cs = Yii::app()->clientScript;
$assetsUrl = $this->getAssetsUrl();
$cs->registerCssFile($assetsUrl.'/vendor/owl/owl.theme.css');
$cs->registerCssFile($assetsUrl.'/vendor/owl/owl.carousel.css');
$cs->registerCssFile($assetsUrl.'/css/photo.css');

$cs->registerScriptFile($assetsUrl.'/vendor/owl/owl.carousel.min.js', CClientScript::POS_END);
$cs->registerScriptFile($assetsUrl.'/js/script.js', CClientScript::POS_END);
?>

<section class="gallery">
	<h2>Фотоотчеты</h2>

	<? $this->widget('zii.widgets.CListView', array(
		'dataProvider' => $gallery->search(),
		'itemView' => '_gallery'
	)) ?>
</section>


<!--<div class="row">-->
<!--	<div class="photo-slider">-->
<!--		<a href="#" class="arrow-left"></a>-->
<!--		<a href="#" class="arrow-right"></a>-->
<!--		<div class="photo-item">-->
<!--			<img src="--><?//='media/temp/3.jpg'?><!--" alt="">-->
<!--			<div class="photo-info">-->
<!--				<div class="photo-caption">-->
<!--					какой то заголовок-->
<!--				</div>-->
<!--				<a href="#" class="photo-more">Подробнее</a>-->
<!--			</div>-->
<!--		</div>-->
<!--	</div>-->
<!--	<div class="calendar">-->
<!--		<div class="calendar-item">-->
<!--		</div>-->
<!--	</div>-->
<!--	<div class="clear"></div>-->
<!--</div>-->