<?php
$this->breadcrumbs=array(
	"Достижени и награды"=>array('list'),
	'Редактирование',
);

$this->menu=array(
	array('label'=>'Список', 'url'=>array('list')),
	array('label'=>'Добавить','url'=>array('create')),
);
?>

<h3>Редактирование</h3>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>