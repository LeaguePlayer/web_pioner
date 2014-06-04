<?php

/**
 * This is the model class for table "{{orders}}".
 *
 * The followings are the available columns in table '{{orders}}':
 * @property integer $id
 * @property integer $type
 * @property integer $gender
 * @property integer $age
 * @property integer $collective_id
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property integer $status
 * @property string $create_time
 * @property string $update_time
 */
class Order extends CActiveRecord
{
	const GENDER_MALE = 1;
	const GENDER_FEMALE = 2;

	const STATUS_NEW = 1;
	const STATUS_PROCESS = 2;
	const STATUS_SUCCESS = 3;

	public static function lookup($attribute)
	{
		switch ( $attribute ) {
			case 'gender':
				return array(
					self::GENDER_MALE => 'Мужской',
					self::GENDER_FEMALE => 'Женский',
				);
			case 'status':
				return array(
					self::STATUS_NEW => 'Необработанная',
					self::STATUS_PROCESS => 'В обработке',
					self::STATUS_SUCCESS => 'Выполнено',
				);
		}
	}

	public function getLookupValue($attribute)
	{
		$labels = self::lookup($attribute);
		return $labels[$this->{$attribute}];
	}

	public function getIsNew()
	{
		return $this->status == self::STATUS_NEW;
	}

	public function getIsProcess()
	{
		return $this->status == self::STATUS_PROCESS;
	}

	public function getIsSuccess()
	{
		return $this->status == self::STATUS_SUCCESS;
	}

	public function getStatusAlias()
	{
		switch ( $this->status ) {
			case self::STATUS_NEW:
				return 'new';
			case self::STATUS_PROCESS:
				return 'process';
			case self::STATUS_SUCCESS:
				return 'success';
			default:
				return '';
		}
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{orders}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, phone, collective_id', 'required'),
			array('email', 'email'),
			array('type, gender, age, collective_id, status', 'numerical', 'integerOnly'=>true),
			array('name, phone, email', 'length', 'max'=>255),
			array('create_time, update_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, type, gender, age, collective_id, name, phone, email, status, create_time, update_time', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'collective' => array(self::BELONGS_TO, 'Collective', 'collective_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'type' => 'Тип заявки',
			'gender' => 'Пол',
			'age' => 'Возраст',
			'collective_id' => 'Коллектив',
			'name' => 'Имя',
			'phone' => 'Телефон',
			'email' => 'E-mail',
			'status' => 'Статус',
			'create_time' => 'Дата создания',
			'update_time' => 'Дата последнего редактирования',
			'collective.name' => 'Название коллектива'
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

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('type',$this->type);
		$criteria->compare('gender',$this->gender);
		$criteria->compare('age',$this->age);
		$criteria->compare('collective_id',$this->collective_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->order = 'create_time DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Order the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
