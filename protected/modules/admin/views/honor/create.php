<?php
$this->breadcrumbs=array(
	"Достижения и награды"=>array('list'),
	'Создание',
);

$this->menu=array(
	array('label'=>'Список','url'=>array('list')),
);
?>

<h3>Добавление</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>