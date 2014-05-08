<?php

/**
* This is the model class for table "{{collective_teachers}}".
*
* The followings are the available columns in table '{{collective_teachers}}':
    * @property integer $id
    * @property string $first_name
    * @property string $last_name
    * @property string $family
    * @property string $short_name
    * @property string $birth_day
    * @property string $img_photo
    * @property string $post
    * @property integer $list_id
    * @property integer $status
    * @property integer $sort
    * @property string $create_time
    * @property string $update_time
*/
class CollectiveTeacher extends EActiveRecord
{
    public function tableName()
    {
        return '{{collective_teachers}}';
    }


    public function rules()
    {
        return array(
			array('family, first_name, last_name', 'required'),
            array('list_id, status, sort', 'numerical', 'integerOnly'=>true),
            array('first_name, last_name, family, short_name, img_photo, post', 'length', 'max'=>255),
            array('birth_day, create_time, update_time', 'safe'),
            // The following rule is used by search().
            array('id, first_name, last_name, family, short_name, birth_day, img_photo, post, list_id, status, sort, create_time, update_time', 'safe', 'on'=>'search'),
        );
    }


	public function relations()
	{
		return array(
			'list'=>array(self::BELONGS_TO, 'CollectiveTeachersList', 'list_id'),
		);
	}


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'first_name' => 'Имя',
            'last_name' => 'Отчество',
            'family' => 'Фамилия',
            'short_name' => 'Фамилия, инициалы',
            'birth_day' => 'Дата рождения',
            'img_photo' => 'Фото',
            'post' => 'Должность',
            'list_id' => 'List',
            'status' => 'Статус',
            'sort' => 'Вес для сортировки',
            'create_time' => 'Дата создания',
            'update_time' => 'Дата последнего редактирования',
        );
    }


    public function behaviors()
    {
        return CMap::mergeArray(parent::behaviors(), array(
			'imgBehaviorPhoto' => array(
				'class' => 'application.behaviors.UploadableImageBehavior',
				'attributeName' => 'img_photo',
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
        ));
    }

    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('family',$this->family,true);
		$criteria->compare('short_name',$this->short_name,true);
		$criteria->compare('birth_day',$this->birth_day,true);
		$criteria->compare('img_photo',$this->img_photo,true);
		$criteria->compare('post',$this->post,true);
		$criteria->compare('list_id',$this->list_id);
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


	public function afterFind()
	{
		parent::afterFind();
		if ( in_array($this->scenario, array('insert', 'update')) ) {
			$this->birth_day = ($this->birth_day !== '0000-00-00' ) ? date('d-m-Y', strtotime($this->birth_day)) : '';
		}
	}


	public function beforeSave()
	{
		if (parent::beforeSave()) {
			$this->short_name = mb_ucfirst($this->family).' '.mb_ucfirst(mb_substr($this->first_name, 0, 1)).'. '.mb_ucfirst(mb_substr($this->last_name, 0, 1)).'.';
			$this->birth_day = date('Y-m-d', strtotime($this->birth_day));
			return true;
		}
		return false;
	}
}
