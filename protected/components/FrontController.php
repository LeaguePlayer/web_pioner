<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class FrontController extends Controller
{
    public $layout='//layouts/main';
    public $menu=array();
    public $breadcrumbs=array();
    public $sliderImages = array();

    public function init() {
        parent::init();
        $this->title = Yii::app()->name;
    }

    //Check home page
    public function is_home() {
        return $this->route == 'site/index';
    }

    public function beforeRender($view)
    {
		$this->buildMenu();
        $slider = Gallery::model()->findByAlias('slayder');
        if ( $slider ) {
            $this->sliderImages = $slider->galleryPhotos;
        }
        return parent::beforeRender($view);
    }

    public function buildMenu()
    {
        $this->menu = Menu::model()->getMenuList(1);
    }

	public function registerSeoTags($model, $nameAttribute = false)
	{
		if ( !empty($model->seo->meta_title) ) {
			$this->title = $model->seo->meta_title;
		} else {
			$this->title = $nameAttribute ? $model->{$nameAttribute} . ' | ' . Yii::app()->config->get('app.name') : Yii::app()->config->get('app.name');
		}
		Yii::app()->clientScript->registerMetaTag($model->seo->meta_desc, 'description', null, array('id'=>'meta_description'), 'meta_description');
		Yii::app()->clientScript->registerMetaTag($model->seo->meta_keys, 'keywords', null, array('id'=>'keywords'), 'meta_keywords');
	}
}