<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/simple';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

	//for link in main menu
	public $action = null;

	public $cs;

	protected $forceCopyAssets = true;

	protected $assetsUrl;
	
	/*
	 * Текущее заведение
	 */
	public $place;
	
	/*
	 * Слайдер
	 */
	public $sliderManager;

	protected function preinit()
	{
		parent::preinit();
	}

	public function init(){
		parent::init();
		
		$this->cs = Yii::app()->clientScript;
		$this->cs->registerCoreScript('jquery');

		//Change theme
		Yii::app()->theme = 'default';

		if(Yii::app()->getRequest()->getParam('update_assets')) $this->forceCopyAssets = true;

		//Css initialize
		/*$cs->registerCssFile($this->getAssetsUrl().'/css/ui-lightness/jquery-ui-1.10.3.custom.min.css');
		$cs->registerCssFile($this->getAssetsUrl().'/css/reset.css');
		$cs->registerCssFile($this->getAssetsUrl().'/css/style.css');
		$cs->registerCssFile($this->getAssetsUrl().'/css/buttons.css');
		$cs->registerCssFile($this->getAssetsUrl().'/css/chosen.css');*/

		
		// Определение текущего заведения
		$placeState;
		$cookie = Yii::app()->request->cookies['CURRENT_PLACE'];
		if ( isset($cookie) ) {
			$placeState = CJSON::decode($cookie->value);
		} else {
			$place = Places::model()->find(array('order'=>'id'));
			if ($place !== null) {
				$placeState['id'] = $place->id;
				$placeState = $place->attributes;
				$cookie = new CHttpCookie('CURRENT_PLACE', CJSON::encode($placeState));
				Yii::app()->request->cookies['CURRENT_PLACE'] = $cookie;
			}
		}
		$this->place = $placeState;
	}

	//Get Clip
	public function getClip($name){
		if (isset($this->clips[$name])) return $this->clips[$name];
		return '';
	}

	//Check home page
	public function is_home(){
		return $this->route == 'site/index';
	}

/*	protected function beforeAction($action){

		return parent::beforeAction($action);
	}*/

	public function getAssetsUrl()
    {
        if (Yii::app()->getRequest()->getParam('update_assets') || !isset($this->assetsUrl))
        {
            $assetsPath = Yii::getPathOfAlias('webroot.themes.'.Yii::app()->theme->name.'.assets');
            $this->assetsUrl = Yii::app()->assetManager->publish($assetsPath, false, -1, $this->forceCopyAssets);
        }
        return $this->assetsUrl;
    }

	public function beforeRender($view)
    {
        $this->renderPartial('//layouts/clips/_main_menu');

        return parent::beforeRender($view);
    }

	/**
	 * Loads the requested data model.
	 * @param string the model class name
	 * @param integer the model ID
	 * @param array additional search criteria
	 * @param boolean whether to throw exception if the model is not found. Defaults to true.
	 * @return CActiveRecord the model instance.
	 * @throws CHttpException if the model cannot be found
	 */
	protected function loadModel($class, $id, $criteria = array(), $exceptionOnNull = true)
	{
		if (empty($criteria)) {
			$model = CActiveRecord::model($class)->findByPk($id);
		} else {
			$finder = CActiveRecord::model($class);
			$c = new CDbCriteria($criteria);
			$c->mergeWith(array(
				'condition' => $finder->tableSchema->primaryKey . '=:id',
				'params' => array(':id' => $id),
			));
			$model = $finder->find($c);
		}
		if (isset($model))
			return $model;
		else if ($exceptionOnNull)
			throw new CHttpException(404, 'Unable to find the requested object.');
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax'] === $model->formId)
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	/**
	 * Outputs (echo) json representation of $data, prints html on debug mode.
	 * NOTE: json_encode exists in PHP > 5.2, so it's safe to use it directly without checking
	 * @param array $data the data (PHP array) to be encoded into json array
	 * @param int $opts Bitmask consisting of JSON_HEX_QUOT, JSON_HEX_TAG, JSON_HEX_AMP, JSON_HEX_APOS, JSON_FORCE_OBJECT.
	 */
	public function renderJson($data, $opts=null)
	{
		if(YII_DEBUG && isset($_GET['debug']) && is_array($data))
		{
			foreach($data as $type => $v)
				printf('<h1>%s</h1>%s', $type, is_array($v) ? json_encode($v, $opts) : $v);
		}
		else
		{
			header('Content-Type: application/json; charset=UTF-8');
			echo json_encode($data, $opts);
		}
	}

	/**
	 * Utility function to ensure the base url.
	 * @param $url
	 * @return string
	 */
	public function baseUrl( $url = '' )
	{
		static $baseUrl;
		if ($baseUrl === null)
			$baseUrl = Yii::app()->request->baseUrl;
		return $baseUrl . '/' . ltrim($url, '/');
	}
}