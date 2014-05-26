<?php
/**
 * Created by JetBrains PhpStorm.
 * User: megakuzmitch
 * Date: 26.05.14
 * Time: 12:45
 *
 * @property $node a Structure model
 */

class ChildNodes extends CWidget
{
	public $node_id;
	protected $node;

	public function init()
	{
		$this->node = Structure::model()->findByPk($this->node_id);
	}

	public function run()
	{
		if ( $this->node ) {
			$this->render('index');
		}
	}
}