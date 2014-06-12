<?php

class LActiveRecord extends CActiveRecord
{
    public function save($runValidation=true,$attributes=null)
    {
        if ( parent::save($runValidation=true,$attributes=null) ) {
            Yii::app()->cache->flush();
            return true;
        }
        return false;
    }


    public function delete()
    {
        $result = parent::delete();
        if ( $result ) {
            Yii::app()->cache->flush();
        }
        return $result;
    }
}