<?php
/* @var $this SiteController */
/* @var $error array */
?>

<div class="error">
	<? if ( YII_DEBUG ): ?>
		<div class="debug">
			<?php echo CHtml::encode($message); ?>
		</div>
	<? endif ?>
	<div class="error-balloon">
		<div class="code">404</div>
		<div class="message">Опаньки! Страница не найдена :(</div>
		<?
			$baseUrl = Yii::app()->getBaseUrl(true);
			$urlReferrer = Yii::app()->request->urlReferrer;
			if ( !$urlReferrer ) {
				$backUrl = $baseUrl;
			} else {
				$backUrl = ( strpos($urlReferrer, $baseUrl) === false ) ? $baseUrl : $urlReferrer;
			}
		?>
		<div class="link"><a href="<?= $backUrl ?>">Назад</a></div>
	</div>
</div>