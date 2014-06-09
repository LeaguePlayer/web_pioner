<?php
/**
 * Created by JetBrains PhpStorm.
 * User: megakuzmitch
 * Date: 05.06.14
 * Time: 11:10
 */

class Schedule extends CWidget
{
	public $collective;

	public function run()
	{
		$schedule = array();
		$places = Place::model()->findAll();
		foreach ( $places as $place ) {
			$scheduleInfo = $place->getScheduleInfo();
			$placeItems = array();
			foreach ( $scheduleInfo as $cabinet => $events ) {
				$cabinetItems = array();
				foreach ( $events as $event ) {
					if ( $this->collective !== null && $this->collective->id != $event['collective']['id'] ) {
						continue;
					}
					$weekDay = date('w', strtotime($event['start']));
                    $teachers = array();
                    foreach ( $event['teachers'] as $teacherInfo ) {
                        $teachers[] = $teacherInfo['name'];
                    }
					$cabinetItems[$weekDay][] = array(
						'title' => $event['title'],
						'collective' => $event['collective']['name'],
						'start' => date('H:i', strtotime($event['start'])),
						'end' => date('H:i', strtotime($event['end'])),
						'teachers' => $teachers
					);
				}
                if ( empty($cabinetItems) ) {
                    continue;
                }
				$placeItems[$cabinet] = $cabinetItems;
			}
            if ( empty($placeItems) ) {
                continue;
            }
			$schedule[$place->name] = $placeItems;
		}

		$path = __DIR__.DIRECTORY_SEPARATOR.'assets';
		$assetsPath = CHtml::asset($path);
		Yii::app()->clientScript->registerScriptFile( $assetsPath.'/schedule.js', CClientScript::POS_END );
		$this->render('index', array(
			'schedule' => $schedule
		));
	}
}