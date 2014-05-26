<?php
/**
 * Created by JetBrains PhpStorm.
 * User: megakuzmitch
 * Date: 26.05.14
 * Time: 13:46
 */

class Contacts extends CWidget
{
	public $title = '';

	protected $cs;

	public function init()
	{
		$this->cs = Yii::app()->getClientScript();
	}

	public function run()
	{
		$places = Place::model()->findAll();
		$this->registerCoreScripts();

		$javaScript = "$(function() {";
		$javaScript .= "$('.contacts .map').each(function() { var map = $(this); var info = map.prev('.info'); if (info.height() > 150) { map.height(info.height()) } });";
		foreach ( $places as $i => $place ) {
			$n = $i + 1;
			$javaScript .= "GMaps.geocode({
				address: '".$place->address."',
				callback: function(results, status) {
					if (status == 'OK') {
						var latlng = results[0].geometry.location;
						var map = new GMaps({
							  div: '#map-".$n."',
							  zoom: 16,
							  lat: latlng.lat(),
							  lng: latlng.lng()
						});
						map.addMarker({
							lat: latlng.lat(),
							lng: latlng.lng(),
							infoWindow: {
								content: '<p>".$place->address."</p>'
							}
						});
					}
				}
			});";
		}
		$javaScript .= "});";

		$this->cs->registerScript('contacts', $javaScript);

		$this->render('index', array(
			'places' => $places
		));
	}

	protected function registerCoreScripts()
	{
		$path = __DIR__.DIRECTORY_SEPARATOR.'assets';
		$assetsPath = CHtml::asset($path);
		$this->cs->registerScriptFile( 'http://maps.google.com/maps/api/js?sensor=true', CClientScript::POS_END );
		$this->cs->registerScriptFile( $assetsPath.'/gmaps.js', CClientScript::POS_END );
	}
}