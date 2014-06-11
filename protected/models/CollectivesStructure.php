<?php

/**
 * This is the model class for table "{{collectives_structure}}".
 *
 * The followings are the available columns in table '{{collectives_structure}}':
 * @property integer $id
 * @property string $root
 * @property string $lft
 * @property string $rgt
 * @property integer $level
 * @property string $material_id
 * @property string $url
 * @property string $name
 * @property string $collective_id
 * @property string $create_time
 * @property string $update_time
 */
class CollectivesStructure extends EActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{collectives_structure}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('material_id, name, collective_id', 'required'),
			array('sort, status', 'numerical', 'integerOnly'=>true),
			array('material_id, collective_id', 'length', 'max'=>11),
			array('url, name', 'length', 'max'=>255),
			array('create_time, update_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, material_id, url, name, collective_id, create_time, update_time, sort', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'material' => array(self::BELONGS_TO, 'Material', 'material_id'),
			'collective' => array(self::BELONGS_TO, 'Collective', 'collective_id'),
		);
	}

	public function behaviors()
	{
		return CMap::mergeArray(parent::behaviors(), array(
			'timestamp' => array(
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

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'root' => 'Root',
			'lft' => 'Lft',
			'rgt' => 'Rgt',
			'level' => 'Level',
			'material_id' => 'Тип раздела',
			'url' => 'Ссылка',
			'status' => 'Статус',
			'name' => 'Название раздела',
			'collective_id' => 'Привязка к коллективу',
			'create_time' => 'Дата создания',
			'update_time' => 'Дата последнего редактирования',
		);
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
		$criteria->compare('material_id',$this->material_id,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('collective_id',$this->collective_id,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->order = 'sort';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CollectivesStructure the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


	public function afterDelete()
	{
		$modelName = ucfirst( $this->material->class_name );
		$components = CActiveRecord::model($modelName)->findAllByAttributes(array(
			'node_id'=>$this->id
		));
		foreach ( $components as $component ) {
			$component->delete();
		}
		parent::afterDelete();
	}


	private $_component;
	public function getComponent($component_name = false)
	{
		if ( $component_name ) {
			$material_id = Yii::app()->db->createCommand()
				->select('id')
				->from('{{materials}}')
				->where('class_name=:cn', array(':cn'=>$component_name))
				->queryScalar();
			if ( $material_id ) {
				$node = $this->findByAttributes(array('material_id'=>$material_id));
				if ( $node ) {
					return $node->getComponent();
				}
			}
		} else if ( $this->_component === null ) {
			$component_name = $this->material->class_name;
			$this->_component = CActiveRecord::model($component_name)->findByAttributes(array('node_id'=>$this->id));
		}
		return $this->_component;
	}


	private $_url;
	public function getUrl()
	{
		if ( $this->_url === null ) {
			$component = $this->getComponent();
			if ( !$component )
				return '';
			$component_name = get_class($component);
			switch ( $component_name ) {
				case 'CollectiveNewsList':
					$this->_url = Yii::app()->createUrl('/news/index', array('collective_id'=>$this->collective_id));
					break;
				case 'CollectiveEventList':
					$this->_url = Yii::app()->createUrl('/event/index', array('collective_id'=>$this->collective_id));
					break;
				case 'CollectiveGalleriesList':
					$this->_url = Yii::app()->createUrl('/gallery/index', array('collective_id'=>$this->collective_id));
					break;
                case 'CollectiveVideosList':
                    $this->_url = Yii::app()->createUrl('/video/index', array('collective_id'=>$this->collective_id));
                    break;
				default:
					$this->_url = Yii::app()->createUrl(lcfirst($component_name).'/view', array('url'=>$this->url));
			}
		}

		return $this->_url;
	}


	public function getBreadcrumbs()
	{
		$breadcrumbs = $this->collective->list->node->getBreadcrumbs();
		array_pop($breadcrumbs);
		$breadcrumbs[$this->collective->name] = $this->collective->getUrl();
		$breadcrumbs[] = $this->name;
		return $breadcrumbs;
	}


	public function getAdminBreadcrumbs()
	{
		$breadcrumbs = $this->collective->list->node->getAdminBreadcrumbs();
        $name = array_pop($breadcrumbs);
        $breadcrumbs[$name] = Yii::app()->urlManager->createUrl('/admin/collectivesList/update', array('id' => $this->collective->list->id));
        $breadcrumbs[$this->collective->name] = Yii::app()->urlManager->createUrl('/admin/collectivesStructure/list', array('collective_id' => $this->collective->id));
        if ( $this->isNewRecord )
			$breadcrumbs[] = 'Добавление раздела';
		else
			$breadcrumbs[] = $this->name;
		return $breadcrumbs;
	}
}
