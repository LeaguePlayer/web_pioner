<?
	$cs = Yii::app()->clientScript;
	$assetsUrl = $this->getAssetsUrl();
	$cs->registerCssFile($assetsUrl.'/css/owl.theme.css');
	$cs->registerCssFile($assetsUrl.'/css/owl.carousel.css');
	$cs->registerCssFile($assetsUrl.'/css/photo.css');

	$cs->registerScriptFile($assetsUrl.'/js/owl.carousel.min.js', CClientScript::POS_END);
	$cs->registerScriptFile($assetsUrl.'/js/script.js', CClientScript::POS_END);
?>
<div class="cpation">
	Фотоотчеты
</div>
<div class="row">
	<div class="photos">
		<a href="#" class="arrow-left"></a>
		<a href="#" class="arrow-right"></a>
		<div class="photos-item">
			<img src="<?=$assetsUrl.'/img/3.jpg'?>" alt="">
			<div class="photos-info">
				<div class="photos-caption">
					какой то заголовок
				</div>
				<a href="#" class="photos-more">Подробнее</a>
			</div>
		</div>
		
	</div>
	<div class="calendar">
		<div class="calendar-item">
		</div>
	</div>
	<div class="clear"></div>
	<div class="gallery">
		<div class="line">
			<div class="gallary-item">
				<div class="gallary-item-preview">
					<img src="<?=$assetsUrl.'/img/3.jpg'?>" alt="">
				</div>
				<div class="clear"></div>
				<div class="line">
					<div class="caption">
						<p class="header">
							Фестиваль красок
						</p>
						<p class="date-create">
							21.06.2014
						</p>
					</div>
					<div class="gallary-item-count">
						123
					</div>
				</div>
			</div>
			<div class="gallary-item"></div>
			<div class="gallary-item"></div>
			<div class="gallary-item"></div>
		</div>
	</div>
</div>