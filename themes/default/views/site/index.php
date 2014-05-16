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
					<? $this->renderPartial('//section/_collectives', array(
						'dataProvider' => $firstCollectivesList->getCollectivesData()
					)) ?>
				</div>

				<div class="scroller__track"><!-- Track is optional -->
					<div class="scroller__bar"></div>
				</div>
			</div>
		</div>
	</div>
</section>
