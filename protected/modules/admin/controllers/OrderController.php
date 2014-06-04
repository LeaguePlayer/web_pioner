<?php

class OrderController extends AdminController
{
	public function filters()
	{
		return CMap::mergeArray(parent::filters(), array(
			'success + ajaxOnly',
			'success + postOnly',
		));
	}

	public function actionView($id)
	{
		$model = $this->loadModel('Order', $id);
		$model->status = Order::STATUS_PROCESS;

		if ( isset($_POST['Order']) ) {
			$model->attributes = $_POST['Order'];
			if ( $_POST['action'] == 'success' ) {
				$model->status = Order::STATUS_SUCCESS;
			}
			if ( $model->save() ) {
				$this->redirect(array('/admin/order/list'));
			}
		}

		$this->render('view', array(
			'model' => $model
		));
	}

	public function actionSuccess($id)
	{
		$model = $this->loadModel('Order', $id);
		$model->status = Order::STATUS_SUCCESS;
		$model->save();
	}
}
