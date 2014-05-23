<?= CHtml::openTag('div', $this->htmlOptions) ?>
	<div class="cover cover-main">
		<div class="cover-content">
			<div class="content">
				<div class="calendar" data-endates="<?= Yii::app()->createUrl('/event/getEnabledDays') ?>"></div>
			</div>
		</div>
	</div>
	<div class="cover cover-top" data-url="<?= Yii::app()->createUrl('/event/loadItems') ?>">
		<div class="cover-content">
			<div class="ui-datepicker">
				<div class="ui-datepicker-header">
					<a class="ui-datepicker-prev"></a>
					<a class="ui-datepicker-next"></a>
					<div class="ui-datepicker-title"></div>
				</div>
			</div>
			<div class="scroller-wrap">
				<div class="scroller">
					<div class="content"></div>
					<div class="scroller__track">
						<div class="scroller__bar"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="loader"></div>
	</div>
	<div class="cover cover-bottom" data-url="<?= Yii::app()->createUrl('/event/loadDescription') ?>">
		<div class="cover-content">
			<div class="scroller-wrap">
				<div class="scroller">
					<div class="content">
					</div>
					<div class="scroller__track">
						<div class="scroller__bar"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="loader"></div>
		<a class="back" href="#">Назад</a>
	</div>
<?= CHtml::closeTag('div') ?>
