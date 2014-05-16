<?php
	$cs = Yii::app()->clientScript;
	$assetsUrl = $this->getAssetsUrl();
	$cs->registerCssFile($assetsUrl.'/css/normalize.min.css');
	$cs->registerCssFile($assetsUrl.'/css/main.css');

	$cs->registerCoreScript('jquery');

	$cs->registerCssFile($assetsUrl.'/vendor/fancybox/css/jquery.fancybox.css');
	$cs->registerScriptFile($assetsUrl.'/vendor/fancybox/js/jquery.fancybox.js', CClientScript::POS_END);

	$cs->registerCssFile($assetsUrl.'/vendor/baron/baron.css');
	$cs->registerScriptFile($assetsUrl.'/vendor/baron/baron.js', CClientScript::POS_END);

	$cs->registerScriptFile($assetsUrl.'/js/main.js', CClientScript::POS_END);
?><!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="utf-8" />
		<title><?php echo $this->title; ?></title>
		<!--[if IE]>
	    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	    <![endif]-->
	</head>
	<body>
		<header id="header">
			<section class="top">
				<div class="fix-width">
					<a class="logo" title="<?= Yii::app()->config->get('app.name') ?>" href="/"><img src="<?= $assetsUrl.'/img/logo.png' ?>" alt=""/></a>
					<div class="center">
						<p class="department">Департамент по спорту и молодежной политике Тюменской области</p>
						<p class="name">ГАУ ДОД ТО “Областной центр дополнительного образования детей и молодежи”</p>
					</div>
					<div class="right">
						<ul class="phones">
							<li>8 800 906 715</li>
							<li>76 00 45</li>
						</ul>
						<form method="get" class="search">
							<div class="input-group">
								<input type="search"/>
								<button><i class="icon-search"></i></button>
							</div>
						</form>
					</div>
				</div>
			</section>

			<section class="banner">
				<div class="fix-width">
					<div class="wrap-banner">
						<img src="/media/temp/banner.png" alt="" />
					</div>
				</div>
			</section>

			<nav class="main-menu">
				<div class="fix-width">
					<? $this->widget('zii.widgets.CMenu', array(
						'items' => $this->menu
					)); ?>
				</div>
			</nav>

			<div class="sub-menu">
				<div class="fix-width">
					<ul>
<!--						<li><a href="#">Дворец искусств Пионер</a></li>-->
					</ul>
				</div>
			</div>
		</header>

		<div id="layout" class="fix-width">
			<?php echo $content;?>
		</div>

		<footer id="footer">
			<div class="fix-width">
				<div class="useful-links block">
					<h3>Полезные ссылки</h3>
					<ul>
						<li><a href="#">Министерства образования и науки РФ</a></li>
						<li><a href="#">Сайт Администрации ТО</a></li>
						<li><a href="#">Портал гос. услуги</a></li>
						<li><a href="#">Федеральный портал «Российское образование»</a></li>
						<li><a href="#">Сайт департамента по спорту и молодежной политике ТО</a></li>
					</ul>
				</div>

				<div class="partners block">
					<h3>Партнеры</h3>
					<ul>
						<li><a href="#">Тюменский  государственный университет</a></li>
						<li><a href="#">Тюменская государственная академия культуры, искусств и социальных технологий</a></li>
					</ul>
				</div>

				<div class="socials block">
					<h3>Следуйте за нами</h3>
					<ul>
						<li><a class="fb" href="#">facebook</a></li>
						<li><a class="tw" href="#">twitter</a></li>
						<li><a class="vk" href="#">вконтакте</a></li>
						<li><a class="ytb" href="#">youtube</a></li>
						<li><a class="inst" href="#">instagram</a></li>
						<li><a class="gp" href="#">google plus</a></li>
					</ul>
				</div>

				<div class="master block">
					<p class="slogan">Лучшее решение только для друзей</p>
					<a href="http://amobile-studio.ru"><img src="<?= $assetsUrl . '/img/amobile.png' ?>" alt=""/></a>
				</div>

			</div>
		</footer>
	</body>
</html>