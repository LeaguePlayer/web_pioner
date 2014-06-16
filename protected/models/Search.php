<?php
/**
 * @property string $title
 * @property string $text
 * @property string $material_class
 * @property integer $id
 */
class Search extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return '{{view_search}}';
    }

    private $_material;
    public function getMaterial()
    {
        if ($this->_material === null) {
            $this->_material = CActiveRecord::model($this->material_class)->findByPk($this->id);
        }

        return $this->_material;
    }
}