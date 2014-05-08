<?php

/**
* This is the model class for table "{{collectives_list}}".
*
* The followings are the available columns in table '{{collectives_list}}':
    * @property integer $id
    * @property string $node_id
    * @property string $create_time
    * @property string $update_time
*/
class CollectivesList extends CActiveRecord
{
    public function tableName()
    {
        return '{{collectives_list}}';
    }


    public function rules()
    {
        return array(
            array('node_id', 'length', 'max'=>11),
            array('create_time, update_time', 'safe'),
            // The following rule is used by search().
            array('id, node_id, create_time, update_time', 'safe', 'on'=>'search'),
        );
    }


	public function relations()
	{
		return array(
			'node' => array(self::BELONGS_TO, 'Structure', 'node_id'),
		);
	}


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'node_id' => 'Ссылка на рздел структуры сайта',
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
			'StructureComponent' => array(
				'class' => 'application.behaviors.StructureComponentBehavior',
			),
        ));
    }

    public function search()
    {
        $criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('node_id',$this->node_id,true);
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
