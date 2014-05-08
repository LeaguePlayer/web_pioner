<?php

/**
* This is the model class for table "{{collective_shedule}}".
*
* The followings are the available columns in table '{{collective_shedule}}':
    * @property integer $id
    * @property string $json_events
    * @property string $node_id
    * @property integer $status
    * @property integer $sort
    * @property string $create_time
    * @property string $update_time
*/
class CollectiveShedule extends EActiveRecord
{
    public function tableName()
    {
        return '{{collective_shedule}}';
    }


    public function rules()
    {
        return array(
            array('node_id', 'required'),
            array('status, sort', 'numerical', 'integerOnly'=>true),
            array('node_id', 'length', 'max'=>11),
            array('json_events, create_time, update_time', 'safe'),
            // The following rule is used by search().
            array('id, json_events, node_id, status, sort, create_time, update_time', 'safe', 'on'=>'search'),
        );
    }


	public function relations()
	{
		return array(
			'node' => array(self::BELONGS_TO, 'CollectivesStructure', 'node_id'),
		);
	}


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'json_events' => 'Json Events',
            'node_id' => 'Node',
            'status' => 'Статус',
            'sort' => 'Вес для сортировки',
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
		$criteria->compare('json_events',$this->json_events,true);
		$criteria->compare('node_id',$this->node_id,true);
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
}
