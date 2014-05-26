<?php
/**
 * Created by JetBrains PhpStorm.
 * User: megakuzmitch
 * Date: 23.05.14
 * Time: 15:47
 *
 * News Carousel depends of owl.carousel.js, see @link http://www.owlgraphic.com/owlcarousel/
 * @property $items array(
 *		'title' => '',
 * 		'desc' => '',
 * 		'img' => src to image
 * 		'url' => ''
 * )
 *
 * or $items array(
 *		'html' => '',
 * ) if @property $raw = true;
 */

class NewsCarousel extends CWidget
{
	protected $id;
	public $raw = false;
	public $items;
	public $clientOptions = array();
	public $htmlOptions = array();

	public function run()
	{
		if ( !$this->htmlOptions['id'] ) {
			$this->htmlOptions['id'] = $this->id = $this->getId();
		}
		if ( !$this->htmlOptions['class'] ) {
			$this->htmlOptions['class'] = 'carousel';
		}
		$this->registerScripts();

		$clientOptions = CMap::mergeArray(array(
			'autoPlay' => true,
		), $this->clientOptions);
		Yii::app()->getClientScript()->registerScript("carousel-".$this->id, "$(document).ready(function() { $('#{$this->id}').init_carousel(".CJavaScript::encode($clientOptions)."); });", CClientScript::POS_END);
		if ( $this->raw ) {
			$this->render('content_container');
		} else {
			$this->render('container');
		}
	}

	protected function registerScripts()
	{
		$path = __DIR__.DIRECTORY_SEPARATOR.'assets';
		$assetsPath = CHtml::asset($path);
		$cs = Yii::app()->getClientScript();
		$cs->registerCoreScript('jquery');
		$cs->registerScriptFile($assetsPath.'/carousel.js', CClientScript::POS_END);

		$appAssetsPath = $this->controller->getAssetsUrl();
		$cs->registerScriptFile($appAssetsPath.'/vendor/owl/owl.carousel.js', CClientScript::POS_END);
		$cs->registerCssFile($appAssetsPath.'/vendor/owl/owl.carousel.css');
	}
}