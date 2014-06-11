<?php

/**
* This is the model class for table "{{collective_videos_list}}".
*
* The followings are the available columns in table '{{collective_videos_list}}':
    * @property integer $id
    * @property integer $node_id
    * @property integer $status
    * @property string $create_time
    * @property string $update_time
*/
class CollectiveVideosList extends EActiveRecord
{
    public function tableName()
    {
        return '{{collective_videos_list}}';
    }


    public function rules()
    {
        return array(
            array('node_id, status', 'numerical', 'integerOnly'=>true),
            array('create_time, update_time', 'safe'),
            // The following rule is used by search().
            array('id, node_id, status, create_time, update_time', 'safe', 'on'=>'search'),
        );
    }


    public function relations()
    {
        return array(
            'node' => array(self::BELONGS_TO, 'CollectivesStructure', 'node_id'),
            'videos' => array(self::HAS_MANY, 'CollectiveVideo', 'list_id'),
        );
    }


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'node_id' => 'Ссылка на раздел',
            'status' => 'Status',
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
        ));
    }

    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('node_id',$this->node_id);
		$criteria->compare('status',$this->status);
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


}
