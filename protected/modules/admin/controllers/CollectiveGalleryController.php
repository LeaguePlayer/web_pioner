<?php

class CollectiveGalleryController extends AdminController
{
	public function actionCreate($list_id)
	{
		$model = new CollectiveGallery();
		$model->list_id = $list_id;
		$model->date_publish = date('d-m-Y');
		$model->name = 'Новый фотоотчет';
		$model->status = CollectiveGallery::STATUS_CLOSED;

		$gallery = new Gallery();
		$gallery->gallery_name = 'Новый фотоотчет';
		$gallery->versions = array(
			'small' => array(
				'adaptiveResize' => array(200, 160),
			),
			'medium' => array(
				'resize' => array(480),
			),
			'big' => array(
				'resize' => array(600, 800),
			),
		);
		$gallery->description = true;
		$gallery->name = true;
		if ( $gallery->save() ) {
			$model->gallery_id = $gallery->id;
			if ( $model->save() ) {
				$this->redirect(array('update', 'id'=>$model->id));
			} else {
				$gallery->delete();
			}
		}


		if ( isset($_POST['CollectiveGallery']) )
		{
			$model->attributes = $_POST['CollectiveGallery'];
			$gallery->gallery_name = $model->name;
			$gallery->alias = Gallery::translit( $model->name );
			if ( $gallery->save() ) {
				$model->gallery_id = $gallery->id;
			}
			if ( $model->save() ) {
				$this->redirect(array('/admin/collectiveGalleriesList/update', 'id'=>$model->list_id));
			} else {
				$gallery->delete();
			}
		}

		$this->render('create', array(
			'model' => $model,
			'gallery' => $gallery,
		));
	}


	public function actionUpdate($id)
	{
		$model = $this->loadModel('CollectiveGallery', $id);
		$oldName = $model->name;
		if ( isset($_POST['CollectiveGallery']) )
		{
			$model->attributes = $_POST['CollectiveGallery'];
			$success = $model->save();
			if ( $success ) {
				if ( $model->name != $oldName ) {
					$model->gallery->gallery_name = $model->name;
					$model->gallery->alias = Gallery::translit( $model->name );
					$model->gallery->save();
				}
				$this->redirect(array('/admin/collectiveGalleriesList/update', 'id'=>$model->list_id));
			}
		}
		$this->render('update', array(
			'model' => $model
		));
	}


	public function actionDelete($id)
	{
		$model = $this->loadModel('CollectiveGallery', $id);
		$model->delete();
		$this->redirect(array('/admin/collectiveGalleriesList/update', 'id'=>$model->list_id));
	}
}
