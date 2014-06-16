<?php
$this->breadcrumbs=array(
	"Полезные ссылки"=>array('list'),
	'Создание',
);

$this->menu=array(
	array('label'=>'Список','url'=>array('list')),
);
?>

<h3>Добавление ссылки</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>