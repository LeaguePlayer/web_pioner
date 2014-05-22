<?php
/**
 * Created by JetBrains PhpStorm.
 * User: megakuzmitch
 * Date: 21.05.14
 * Time: 13:49
 */

class FileController extends AdminController
{
	public function actions()
	{
		return array(
			'fileUploaderConnector'=>array(
				'class' => 'application.extensions.ezzeelfinder.ElFinderConnectorAction',
			),
		);
	}
}