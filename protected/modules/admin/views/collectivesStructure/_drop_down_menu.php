<?php

// Пункты для выпадающего меню
$menu_items = array(
	array('label' => '<b>Открыть</b>', 'url' => array('/admin/collectivesStructure/updateMaterial', 'node_id'=>$model->id)),
	array('label' => 'Свойства раздела', 'url' => array('/admin/collectivesStructure/update/', 'id'=>$model->id)),
);

echo TbHtml::buttonDropdown(TbHtml::icon(TbHtml::ICON_TH_LIST), $menu_items, array(
	'size'=>TbHtml::BUTTON_SIZE_MINI
));

?>