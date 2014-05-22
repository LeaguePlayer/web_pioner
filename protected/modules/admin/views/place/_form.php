<?php
	$cs = Yii::app()->clientScript;
	$assetsPath = $this->getAssetsUrl();

	$cs->registerScriptFile( $assetsPath.'/vendor/bootbox/bootbox.min.js', CClientScript::POS_END );

	$cs->registerCssFile($assetsPath.'/vendor/kladr/jquery.kladr.min.css');
	$cs->registerScriptFile($assetsPath.'/vendor/kladr/jquery.kladr.min.js', CClientScript::POS_END);

	$cs->registerCoreScript('jquery.ui');
	$cs->registerCssFile( $assetsPath.'/vendor/fullcalendar/fullcalendar.css');
	$cs->registerScriptFile( $assetsPath.'/vendor/fullcalendar/fullcalendar.js', CClientScript::POS_END );

	$cs->registerCssFile( $assetsPath.'/vendor/twbt-timepicker/css/bootstrap-timepicker.css' );
	$cs->registerScriptFile( $assetsPath.'/vendor/twbt-timepicker/js/bootstrap-timepicker.js', CClientScript::POS_END );

	$cs->registerCssFile( $assetsPath.'/vendor/select2/select2.css' );
	$cs->registerScriptFile( $assetsPath.'/vendor/select2/select2.min.js', CClientScript::POS_END );
	$cs->registerScriptFile( $assetsPath.'/vendor/select2/select2_locale_ru.js', CClientScript::POS_END );

	$cs->registerCssFile( $assetsPath.'/css/shedule.form.css' );
	$cs->registerScriptFile( $assetsPath.'/js/shedule.form.js', CClientScript::POS_END );
	$cs->registerScriptFile($assetsPath.'/js/place.form.js', CClientScript::POS_END);
?>


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'place-form',
	'enableAjaxValidation'=>false,
		'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php $tabs = array(); ?>
	<?php $tabs[] = array('label' => 'Основные данные', 'content' => $this->renderPartial('_rows', array('form'=>$form, 'model' => $model), true), 'active' => true); ?>
	<?php $tabs[] = array('label' => 'SEO раздел', 'content' => $this->getSeoForm($model)); ?>
	<?php $this->widget('bootstrap.widgets.TbTabs', array( 'tabs' => $tabs)); ?>


	<?php $this->renderPartial('_shedule', array('form'=>$form, 'model' => $model)) ?>


	<div class="form-actions">
		<?php echo TbHtml::submitButton('Сохранить', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)); ?>
        <?php echo TbHtml::linkButton('Отмена', array('url'=>'/admin/place/list')); ?>
	</div>

<?php $this->endWidget(); ?>
