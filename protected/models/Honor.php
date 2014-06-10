<?php

/**
* This is the model class for table "{{honors}}".
*
* The followings are the available columns in table '{{honors}}':
    * @property integer $id
    * @property string $img_preview
    * @property string $date
    * @property string $description
    * @property integer $status
    * @property integer $sort
    * @property string $create_time
    * @property string $update_time
*/
class Honor extends EActiveRecord
{
    public function tableName()
    {
        return '{{honors}}';
    }


    public function rules()
    {
        return array(
            array('status, sort', 'numerical', 'integerOnly'=>true),
            array('img_preview', 'length', 'max'=>255),
            array('dt_date, description, create_time, update_time', 'safe'),
            // The following rule is used by search().
            array('id, img_preview, dt_date, description, status, sort, create_time, update_time', 'safe', 'on'=>'search'),
        );
    }


    public function relations()
    {
        return array(
        );
    }


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'img_preview' => 'Превью',
            'dt_date' => 'Укажите дату',
            'description' => 'Описание',
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
						'adaptiveResize' => array(150, 220),
					),
                    'big' => array(
                        'resize' => array(800),
                    ),
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
		$criteria->compare('img_preview',$this->img_preview,true);
		$criteria->compare('dt_date',$this->dt_date,true);
		$criteria->compare('description',$this->description,true);
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
            $this->dt_date = ($this->dt_date !== '0000-00-00' ) ? date('d-m-Y', strtotime($this->dt_date)) : '';
        }
    }

    public function beforeSave()
    {
        if (parent::beforeSave()) {
            $this->dt_date = date('Y-m-d', strtotime($this->dt_date));
            return true;
        }
        return false;
    }
}
