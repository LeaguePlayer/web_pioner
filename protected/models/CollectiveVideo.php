<?php

/**
* This is the model class for table "{{collective_videos}}".
*
* The followings are the available columns in table '{{collective_videos}}':
    * @property integer $id
    * @property string $name
    * @property string $code
    * @property string $date_publish
    * @property integer $status
    * @property integer $list_id
    * @property string $create_time
    * @property string $update_time
*/
class CollectiveVideo extends EActiveRecord
{
    public function tableName()
    {
        return '{{collective_videos}}';
    }


    public function rules()
    {
        return array(
            array('name, code, list_id', 'required'),
            array('status, list_id', 'numerical', 'integerOnly'=>true),
            array('name, img_preview', 'length', 'max'=>255),
            array('description, date_publish, create_time, update_time', 'safe'),
            // The following rule is used by search().
            array('id, name, code, date_publish, status, list_id, create_time, update_time', 'safe', 'on'=>'search'),
        );
    }


    public function relations()
    {
        return array(
            'list'=>array(self::BELONGS_TO, 'CollectiveVideosList', 'list_id'),
        );
    }


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'img_preview' => 'Превью к видео',
            'description' => 'Описание',
            'name' => 'Название видео',
            'code' => 'Скопируйте сюда код видео или ссылку',
            'date_publish' => 'Дата публикации',
            'status' => 'Статус',
            'list_id' => 'List',
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
            'imgBehaviorPreview' => array(
                'class' => 'application.behaviors.UploadableImageBehavior',
                'attributeName' => 'img_preview',
                'versions' => array(
                    'icon' => array(
                        'centeredpreview' => array(90, 90),
                    ),
                    'small' => array(
                        'centeredpreview' => array(200, 180),
                    )
                ),
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
		$criteria->compare('code',$this->code,true);
		$criteria->compare('date_publish',$this->date_publish,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('list_id',$this->list_id);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
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
            if ( !empty( $this->date_publish ) ) {
                $this->date_publish = date('Y-m-d H:i', strtotime($this->date_publish));
            }
            return true;
        }
        return false;
    }

    public function getBreadcrumbs()
    {
        $breadcrumbs = $this->list->node->getBreadcrumbs();
        $name = array_pop($breadcrumbs);
        $breadcrumbs[$name] = $this->list->node->getUrl();
        $breadcrumbs[] = $this->name;
        return $breadcrumbs;
    }
}
