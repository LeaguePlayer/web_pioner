<?php

/**
* This is the model class for table "{{collectives}}".
*
* The followings are the available columns in table '{{collectives}}':
    * @property integer $id
    * @property string $name
    * @property string $img_preview
    * @property string $age_limits
    * @property string $description
    * @property integer $list_id
    * @property integer $status
    * @property integer $sort
    * @property string $create_time
    * @property string $update_time
*/
class Collective extends EActiveRecord
{
	public $ageLeft;
	public $ageRight;

    public function tableName()
    {
        return '{{collectives}}';
    }


    public function rules()
    {
        return array(
            array('name', 'required'),
            array('list_id, status, sort, ageLeft, ageRight', 'numerical', 'integerOnly'=>true),
            array('name, img_preview', 'length', 'max'=>255),
            array('description, create_time, update_time', 'safe'),
            // The following rule is used by search().
            array('id, name, img_preview, age_limits, description, list_id, status, sort, create_time, update_time', 'safe', 'on'=>'search'),
        );
    }


	public function relations()
	{
		return array(
			'list'=>array(self::BELONGS_TO, 'CollectivesList', 'list_id'),
		);
	}


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Название',
            'img_preview' => 'Превью',
            'age_limits' => 'Возраст',
            'ageLeft' => 'Не младше',
            'ageRight' => 'Не старше',
            'description' => 'Описание',
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
        ));
    }

    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('img_preview',$this->img_preview,true);
		$criteria->compare('age_limits',$this->age_limits,true);
		$criteria->compare('description',$this->description,true);
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


	public function beforeSave()
	{
		if (parent::beforeSave()) {
			$this->age_limits = $this->ageLeft.'-'.$this->ageRight;
			return true;
		}
		return false;
	}

	public function afterFind()
	{
		parent::afterFind();
		$ageRange = explode('-', $this->age_limits);
		$this->ageLeft = $ageRange[0];
		$this->ageRight = $ageRange[1];
	}
}
