
<section class="news-section">
	<h2>Новости</h2>

	<div class="content-carousel">
		<?php
		$newsItems = array();
		foreach ( $feedNews as $i => $oneNews ) {
			$newsItems[] = array(
				'html' => $this->renderPartial('//news/_slider_item', array('data' => $oneNews), true),
			);
		}
		?>
		<?php $this->widget('appwidgets.newsCarousel.NewsCarousel', array(
			'raw' => true,
			'items' => $newsItems,
		)) ?>
	</div>

	<div class="news-calendar">
		<?php $this->widget('appwidgets.newsCalendar.NewsCalendar') ?>
	</div>
</section>


<div class="columns">
	<div class="col-main">
		<section class="page">
			<div class="preview">
				<?= $model->getImage('big') ?>
			</div>
			<p class="date"><?= date('d.m.Y', strtotime($model->date_public)) ?></p>
			<h2><?= $model->title ?></h2>

			<?= $model->body_content ?>
		</section>
	</div>

	<div class="col-sidebar">
		<?php $this->widget('zii.widgets.CListView', array(
			'dataProvider' => $otherNewsData,
			'itemView' => '//news/_item',
			'htmlOptions' => array(
				'class' => 'gallery'
			)
		)) ?>
	</div>
</div>
