<?php

/**
* This is the model class for table "{{places}}".
*
* The followings are the available columns in table '{{places}}':
    * @property integer $id
    * @property string $name
    * @property string $img_preview
    * @property string $description
    * @property string $address
    * @property integer $list_id
    * @property integer $seo_id
    * @property integer $status
    * @property integer $sort
    * @property string $create_time
    * @property string $update_time
*/
class Place extends EActiveRecord
{
    public function tableName()
    {
        return '{{places}}';
    }


    public function rules()
    {
        return array(
            array('name', 'required'),
            array('list_id, seo_id, status, sort', 'numerical', 'integerOnly'=>true),
            array('name, address', 'length', 'max'=>255),
            array('create_time, update_time, json_schedule, description', 'safe'),
            // The following rule is used by search().
            array('id, name, img_preview, description, address, list_id, seo_id, status, sort, create_time, update_time', 'safe', 'on'=>'search'),
        );
    }


	public function relations()
	{
		return array(
			'list'=>array(self::BELONGS_TO, 'PlacesList', 'list_id'),
		);
	}


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Наименование',
            'img_preview' => 'Фото объекта',
            'description' => 'Описание',
            'address' => 'Адрес',
            'list_id' => 'List',
            'seo_id' => 'Seo',
            'status' => 'Статус',
            'sort' => 'Вес для сортировки',
            'create_time' => 'Дата создания',
            'update_time' => 'Дата последнего редактирования',
        );
    }


    public function behaviors()
    {
        return CMap::mergeArray(parent::behaviors(), array(
			'imgBehaviorPreview' => array(
				'class' => 'application.behaviors.UploadableImageBehavior',
				'attributeName' => 'img_preview',
				'versions' => array(
					'icon' => array(
						'centeredpreview' => array(90, 90),
					),
					'small' => array(
						'resize' => array(200, 180),
					)
				),
			),
			'CTimestampBehavior' => array(
				'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'create_time',
                'updateAttribute' => 'update_time',
                'setUpdateOnCreate' => true,
			),
			'Seo' => array(
				'class' => 'application.behaviors.SeoBehavior',
			),
        ));
    }

    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('img_preview',$this->img_preview,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('list_id',$this->list_id);
		$criteria->compare('seo_id',$this->seo_id);
		$criteria->compare('status',$this->status);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
        $criteria->order = 'sort';
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

	public function getScheduleInfo()
	{
		return CJSON::decode($this->json_schedule);
	}
}
