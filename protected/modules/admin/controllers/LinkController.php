<?php

class LinkController extends AdminController
{
	public function actionJsonSections()
    {
        $criteria = new CDbCriteria();
        $criteria->select = 'id, name, level, lft, rgt';
        $criteria->order = 'lft';
        $structureItems = Structure::model()->findAll($criteria);
        $structureList = array();
        foreach ( $structureItems as $item ) {
            $structureList[] = array(
                'id' => $item->id,
                'url' => $item->getUrl(),
                'level' => $item->level,
                'text' => $item->name
            );
        }
        echo CJSON::encode($structureList);
    }
}
