<?php
/**
 * @var $this FrontController
 */

$cs = Yii::app()->clientScript;
$assetsUrl = $this->getAssetsUrl();

$cs->registerScriptFile( $assetsUrl.'/vendor/jssor/jssor.jquery.min.js' );
?>

<!--<section class="news">-->
<!--	<h2>Новости</h2>-->
<!--	--><?php //$this->widget('NewsSlider', array('data'=>$news)) ?>
<!--</section>-->



<section class="services">
	<h2>Услуги</h2>

	<div class="container">
		<div class="left">
			<div class="block">
				<h2>Молодежные проекты</h2>
				<ul class="teen_streams grid">
					<li><a href="#">Общие конкурсы и проекты</a></li>
					<li><a href="#">Общие конкурсы и проекты</a></li>
				</ul>
			</div>
		</div>

		<div class="center">
			<div class="block">
				<h2>Дополнительное образование</h2>
				<ul class="additional_training">
					<li class="art">
						<span>Художественно-эстетическая направленность</span>
						<ul>
							<li><a href="#">Хореография и театральное искусство</a></li>
							<li><a href="#">Вокальное искусство</a></li>
						</ul>
					</li>
					<li class="social">
						<span>Социально-педагогическая направленность</span>
						<ul></ul>
					</li>
					<li class="sport">
						<span>Физкультурно-спортивное направление</span>
						<ul></ul>
					</li>
					<li class="natural">
						<span>Естественно-научное направленность</span>
						<ul></ul>
					</li>
					<li class="tech">
						<span>Техническая направленность</span>
						<ul></ul>
					</li>
					<li class="tourism">
						<span>Туристско-краеведческая направленность</span>
						<ul></ul>
					</li>

					<? foreach ( $activities as $activity ): ?>
						<li class="<?= $activity->node->url ?>">
							<span><?= $activity->name ?></span>
							<ul></ul>
						</li>
					<? endforeach ?>

				</ul>
			</div>
		</div>

		<div class="preview">
			<div class="scroller">
				<div class="content">
					<div class="collectives">
						<div class="item">
							<img src="/media/temp/photo.png" alt=""/>
							<h3>Школа «БИБОИНГА» <span>с 7 до 25 лет</span></h3>
							<div>
								<p><b>Тренеры-преподаватели:</b></p>
								<p>Иванов Иван Иванович</p>
								<p>Иванов Иван Иванович</p>
							</div>
							<div>
								<p><b>Место проведения занятий:</b></p>
								<p>ул. Челюскинцев, 46, Дворец искусств «Пионер»</p>
							</div>
							<div class="buttons">
								<a href="#">Мероприятия</a>
								<a href="#">Информация</a>
								<a href="#">Преподаватели</a>
								<a href="#">Контакты</a>
								<a href="#">Записаться</a>
							</div>
						</div>

						<div class="item">
							<img src="/media/temp/photo.png" alt=""/>
							<h3>Школа «БИБОИНГА» <span>с 7 до 25 лет</span></h3>
							<div>
								<p><b>Тренеры-преподаватели:</b></p>
								<p>Иванов Иван Иванович</p>
								<p>Иванов Иван Иванович</p>
							</div>
							<div>
								<p><b>Место проведения занятий:</b></p>
								<p>ул. Челюскинцев, 46, Дворец искусств «Пионер»</p>
							</div>
							<div class="buttons">
								<a href="#">Мероприятия</a>
								<a href="#">Информация</a>
								<a href="#">Преподаватели</a>
								<a href="#">Контакты</a>
								<a href="#">Записаться</a>
							</div>
						</div>
					</div>
				</div>

				<div class="scroller__track"><!-- Track is optional -->
					<div class="scroller__bar"></div>
				</div>
			</div>
		</div>
	</div>
</section>
