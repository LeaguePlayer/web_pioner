<?php
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile('//vk.com/js/api/openapi.js?113', CClientScript::POS_HEAD);
    $cs->registerScript('VK_Init', "VK.init({apiId: 4415637, onlyWidgets: true});", CClientScript::POS_END);

    $options = CMap::mergeArray(array(
        'limit' => 10,
        'width' => 664,
        'attach' => '*'
    ), $widgetOptions);
$cs->registerScript('VK_Comments', 'VK.Widgets.Comments("vk_comments", '.CJSON::encode($options).');', CClientScript::POS_END);
?>

<div id="vk_comments"></div>