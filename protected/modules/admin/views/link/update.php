<?php
$this->breadcrumbs=array(
	"Полезные ссылки"=>array('list'),
	'Редактирование',
);

$this->menu=array(
	array('label'=>'Список', 'url'=>array('list')),
	array('label'=>'Добавить','url'=>array('create')),
);
?>

<h3>Редактирование ссылки</h3>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>