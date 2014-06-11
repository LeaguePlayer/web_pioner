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

<section class="video page">
	<h2>Видеоотчеты</h2>

<!--	<div class="row">-->
<!--		<div class="photo-slider">-->
<!--			<a href="#" class="arrow-left"></a>-->
<!--			<a href="#" class="arrow-right"></a>-->
<!--			<div class="photo-item">-->
<!--				<img src="--><?//='media/temp/3.jpg'?><!--" alt="">-->
<!--				<div class="photo-info">-->
<!--					<div class="photo-caption">-->
<!--						какой то заголовок-->
<!--					</div>-->
<!--					<a href="#" class="photo-more">Подробнее</a>-->
<!--				</div>-->
<!--			</div>-->
<!--		</div>-->
<!--		<div class="clear"></div>-->
<!--	</div>-->


	<? $this->widget('zii.widgets.CListView', array(
		'id' => 'video-list',
		'template' => '{items}',
		'dataProvider' => $dataProvider,
		'itemView' => '_item'
	)) ?>
</section>

