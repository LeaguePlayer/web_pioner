<?php
	$cs = Yii::app()->clientScript;
	$assetsUrl = $this->getAssetsUrl();

	$cs->registerCssFile( $assetsUrl.'/vendor/gammaGallery/css/style.css' );
	$cs->registerScriptFile( $assetsUrl.'/js/lib/modernizr-2.6.2.min.js', CClientScript::POS_HEAD );
	$cs->registerScriptFile( $assetsUrl.'/vendor/gammaGallery/js/jquery.history.js', CClientScript::POS_HEAD );
	$cs->registerScriptFile( $assetsUrl.'/vendor/gammaGallery/js/jquery.masonry.min.js', CClientScript::POS_HEAD );
	$cs->registerScriptFile( $assetsUrl.'/vendor/gammaGallery/js/jquerypp.custom.js', CClientScript::POS_HEAD );
	$cs->registerScriptFile( $assetsUrl.'/vendor/gammaGallery/js/js-url.min.js', CClientScript::POS_HEAD );
	$cs->registerScriptFile( $assetsUrl.'/vendor/gammaGallery/js/gamma.js', CClientScript::POS_END );
?>

<h2><?= $model->name ?></h2>

<div class="gamma-container gamma-loading" id="gamma-container">

	<ul class="gamma-gallery">
		<? foreach ( $model->gallery->galleryPhotos as $photo ): ?>
			<li>
				<div data-alt="<?= $photo->name ?>" data-description="<h3><?= $photo->description ?></h3>" data-max-width="980" data-max-height="2400">
					<div data-src="<?= $photo->getUrl('big') ?>" data-min-width="980"></div>
					<div data-src="<?= $photo->getUrl('medium') ?>"></div>
					<noscript>
						<?= $photo->getImage('medium') ?>
					</noscript>
				</div>
			</li>
		<? endforeach ?>
	</ul>

	<div class="gamma-overlay"></div>

</div>