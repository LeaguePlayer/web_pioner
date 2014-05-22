<?php
/**
 * Created by JetBrains PhpStorm.
 * User: megakuzmitch
 * Date: 20.05.14
 * Time: 14:59
 */

class NewsCalendar extends CWidget
{
	protected $id;
	public $htmlOptions = array();

	public function run()
	{
		if ( !$this->htmlOptions['id'] ) {
			$this->htmlOptions['id'] = $this->id = $this->getId();
		}
		$this->htmlOptions['class'] = 'flip-calendar';
		$this->registerScripts();
		$this->render('container');
	}

	protected function registerScripts()
	{
		$path = __DIR__.DIRECTORY_SEPARATOR.'assets';
		$assetsPath = CHtml::asset($path);
		$cs = Yii::app()->getClientScript();
		$cs->registerCoreScript('jquery');
		$cs->registerCoreScript('jquery.ui');
		$cs->registerScriptFile($assetsPath.'/calendar.js', CClientScript::POS_END);

		$appAssetsPath = $this->controller->getAssetsUrl();
		$cs->registerScriptFile($appAssetsPath.'/vendor/flip/jquery.flip.js', CClientScript::POS_END);
		$cs->registerCssFile($appAssetsPath.'/vendor/baron/baron.css');
		$cs->registerScriptFile($appAssetsPath.'/vendor/baron/baron.js', CClientScript::POS_END);
		$cs->registerScriptFile($appAssetsPath.'/vendor/fancybox/jquery.fancybox.pack.js', CClientScript::POS_END);
		$cs->registerScript("news_calendar", "$(document).ready(function() { $('#{$this->id}').init_flip_calendar(); });", CClientScript::POS_LOAD);
	}
}