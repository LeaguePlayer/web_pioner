<?php
/**
 * @var $this FrontController
 */
?>

<section class="news-section">
	<h2>Новости</h2>

	<div class="news-carousel">
		<div class="carousel">
			<div class="image-carousel owl-carousel ">
				<? foreach ( $news as $oneNews ): ?>
					<div class="item"><?= $oneNews->getImage('slider') ?></div>
				<? endforeach ?>
			</div>
			<div class="captions">
				<div class="carousel-viewport">
					<div class="caption-carousel-wrap">
						<div class="caption-carousel owl-carousel ">
							<? foreach ( $news as $oneNews ): ?>
								<div class="item">
									<h3><?= $oneNews->title ?></h3>
									<p><?= $oneNews->date_public ?></p>
									<a class="news-url" href="<?= $oneNews->getUrl() ?>"></a>
								</div>
							<? endforeach ?>
						</div>
					</div>
				</div>
				<a class="prev" href="#"></a>
				<a class="next" href="#"></a>
			</div>
		</div>
	</div>

	<div class="news-feed">
		<? foreach ( $news as $i => $oneNews ): ?>
			<div class="item">
				<?= $oneNews->getImage('icon') ?>
				<div class="description">
					<h3><?= $oneNews->title ?></h3>
					<span class="date"><?= $oneNews->date_public ?></span>
					<p><?= $oneNews->short_description ?></p>
				</div>
				<a href="<?= $oneNews->getUrl() ?>"></a>
			</div>
			<? if ( $i == 2 ) break; ?>
		<? endforeach ?>
	</div>

	<div class="news-calendar">
		<?php $this->widget('appwidgets.newsCalendar.NewsCalendar') ?>
	</div>
</section>



<section class="services">
	<h2>Услуги</h2>

	<div class="container">
		<div class="left">
			<div class="block">
				<h2>Молодежные проекты</h2>
				<ul class="teen_streams grid">
					<? foreach ( $teenProgectPageNodes as $pageNode ): ?>
						<li><a href="<?= $pageNode->getUrl() ?>"><?= $pageNode->name ?></a></li>
					<? endforeach ?>
				</ul>
			</div>
		</div>

		<div class="center">
			<div class="block">
				<h2>Дополнительное образование</h2>
				<ul class="additional_training">
					<?php $firstCollectivesList = null; ?>
					<? foreach ( $activityNodes as $activityNode ): ?>
						<li class="<?= $activityNode->url ?>">
							<span><?= $activityNode->name ?></span>
							<ul>
								<? foreach ( $activityNode->getChildNodesByType('Section') as $sectionNode ): ?>
									<?php
										if ( $firstCollectivesList === null ) {
											$listNode = $sectionNode->children()->find();
											if ( $listNode ) {
												$firstCollectivesList = $listNode->getComponent();
											}
										}
									?>
									<li><a class="loadCollectives" href="<?= $this->createUrl('/section/loadCollectives', array('url'=>$sectionNode->url)) ?>"><?= $sectionNode->name ?></a></li>
								<? endforeach ?>
							</ul>
						</li>
					<? endforeach ?>
				</ul>
				<span class="loader"></span>
			</div>
		</div>

		<div class="preview">
			<div class="scroller">
				<div class="content">
					<? if ( $firstCollectivesList ) $this->renderPartial('//section/_collectives', array(
						'dataProvider' => $firstCollectivesList->getCollectivesData()
					)) ?>
				</div>

				<div class="scroller__track">
					<div class="scroller__bar"></div>
				</div>
			</div>
		</div>
	</div>
</section>
