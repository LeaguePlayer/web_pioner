<?php

/**
* This is the model class for table "{{collective_news}}".
*
* The followings are the available columns in table '{{collective_news}}':
    * @property integer $id
    * @property string $title
    * @property string $img_preview
    * @property string $short_description
    * @property string $body_content
    * @property string $tags
    * @property integer $list_id
    * @property integer $seo_id
    * @property integer $status
    * @property integer $sort
    * @property string $create_time
    * @property string $update_time
    * @property string $date_public
    * @property string $type
*/
class CollectiveNews extends EActiveRecord
{
	const TYPE_NEWS = 1;
	const TYPE_EVENT = 2;


	public static function getTypes()
	{
		return array(
			self::TYPE_NEWS => 'Новость',
			self::TYPE_EVENT => 'Мероприятие',
		);
	}


	public function getCurrentType()
	{
		$types = self::getTypes();
		return $types[$this->type];
	}


    public function tableName()
    {
        return '{{collective_news}}';
    }

    public function rules()
    {
        return array(
            array('title, type', 'required'),
            array('list_id, seo_id, status, sort, type', 'numerical', 'integerOnly'=>true),
            array('title', 'length', 'max'=>255),
            array('create_time, update_time, short_description, body_content, tags, date_public', 'safe'),
            // The following rule is used by search().
            array('id, title, img_preview, short_description, body_content, tags, list_id, seo_id, status, sort, create_time, update_time', 'safe', 'on'=>'search'),
        );
    }


	public function relations()
	{
		return array(
			'list'=>array(self::BELONGS_TO, 'CollectiveNewsList', 'list_id'),
		);
	}


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
			'type' => 'Тип',
            'title' => 'Заголовок',
            'img_preview' => 'Превью',
            'short_description' => 'Краткое описание',
            'body_content' => 'Контент',
            'tags' => 'Тэги',
            'list_id' => 'List',
            'seo_id' => 'Seo',
            'status' => 'Статус',
            'sort' => 'Вес для сортировки',
            'create_time' => 'Дата создания',
            'update_time' => 'Дата последнего редактирования',
			'date_public' => 'Укажите дату',
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
						'centeredpreview' => array(112, 96),
					),
					'small' => array(
						'resize' => array(265),
					),
					'slider' => array(
						'adaptiveResize' => array(450, 250),
					),
					'big' => array(
						'resize' => array(800, 600),
					),
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('img_preview',$this->img_preview,true);
		$criteria->compare('short_description',$this->short_description,true);
		$criteria->compare('body_content',$this->body_content,true);
		$criteria->compare('tags',$this->tags,true);
		$criteria->compare('list_id',$this->list_id);
		$criteria->compare('seo_id',$this->seo_id);
		$criteria->compare('status',$this->status);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('type',$this->type);
        $criteria->order = 'create_time DESC';
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
			$this->date_public = ($this->date_public !== '0000-00-00 00:00:00' ) ? date('d-m-Y', strtotime($this->date_public)) : '';
		}
	}

	public function beforeSave()
	{
		if (parent::beforeSave()) {
			Tag::model()->updateValues($this->tags);
			if ( !empty( $this->date_public ) ) {
				$this->date_public = date('Y-m-d H:i', strtotime($this->date_public));
			}
			return true;
		}
		return false;
	}

	private $_tags;
	public function getTagObjects()
	{
		if ( $this->_tags === null ) {
			$this->_tags = explode(',', $this->tags);
		}
		return $this->_tags;
	}

	public function getUrl()
	{
		if ( $this->type == self::TYPE_NEWS ) {
			return Yii::app()->createUrl('/news/view', array('id'=>$this->id));
		} else {
			return Yii::app()->createUrl('/event/view', array('id'=>$this->id));
		}
	}

	public function getBreadcrumbs()
	{
		$breadcrumbs = $this->list->node->getBreadcrumbs();
		$name = array_pop($breadcrumbs);
		$breadcrumbs[$name] = $this->list->node->getUrl();
		$breadcrumbs[] = $this->title;
		return $breadcrumbs;
	}
}
