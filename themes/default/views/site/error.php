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
		<div class="link"><a href="<?= Yii::app()->request->urlReferrer ?>">Назад</a></div>
	</div>
</div>