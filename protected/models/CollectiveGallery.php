<?php

/**
* This is the model class for table "{{collective_galleries}}".
*
* The followings are the available columns in table '{{collective_galleries}}':
    * @property integer $id
    * @property string $name
    * @property string $date_publish
    * @property integer $status
    * @property string $create_time
    * @property string $update_time
*/
class CollectiveGallery extends EActiveRecord
{
    public function tableName()
    {
        return '{{collective_galleries}}';
    }


    public function rules()
    {
        return array(
			array('name', 'required'),
            array('status', 'numerical', 'integerOnly'=>true),
            array('name', 'length', 'max'=>255),
            array('date_publish, create_time, update_time', 'safe'),
            // The following rule is used by search().
            array('id, name, date_publish, status, create_time, update_time, list_id', 'safe', 'on'=>'search'),
        );
    }


    public function relations()
    {
		return array(
			'list'=>array(self::BELONGS_TO, 'CollectiveGalleriesList', 'list_id'),
			'gallery'=>array(self::BELONGS_TO, 'Gallery', 'gallery_id'),
		);
    }


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Название галереи',
            'date_publish' => 'Дата публикации',
            'status' => 'Статус',
            'create_time' => 'Дата создания',
            'update_time' => 'Дата последнего редактирования',
        );
    }


    public function behaviors()
    {
        return CMap::mergeArray(parent::behaviors(), array(
			'CTimestampBehavior' => array(
				'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'create_time',
                'updateAttribute' => 'update_time',
                'setUpdateOnCreate' => true,
			),
			'seo' => array(
				'class' => 'application.behaviors.SeoBehavior',
			),
        ));
    }

    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('date_publish',$this->date_publish,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('list_id',$this->list_id);
		$criteria->order = 'date_publish DESC';
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }


	public function afterFind()
	{
		parent::afterFind();
		if ( in_array($this->scenario, array('insert', 'update')) ) {
			$this->date_publish = ($this->date_publish !== '0000-00-00 00:00:00' ) ? date('d-m-Y', strtotime($this->date_publish)) : '';
		}
	}

	public function beforeSave()
	{
		if (parent::beforeSave()) {
			$this->date_publish = date('Y-m-d H:i:s', strtotime($this->date_publish));
			return true;
		}
		return false;
	}

	public function afterDelete()
	{
		parent::afterDelete();
		$this->gallery->delete();
	}

	public function getFirstPhoto($version = '')
	{
		$photo = $this->gallery->firstPhoto;
		if ( $photo ) {
			return $photo->getImage($version);
		}
	}
}
