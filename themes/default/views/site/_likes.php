<div class="socials">
    <!-- Кнопка ВКонтакте -->
    <div class="like_button">
        <div id="vk_like" class="button"></div>
    </div>

    <!-- Кнопка google+ -->
    <div class="like_button">
        <div class="g-plusone" data-annotation="bubble" data-href="<?= $url ?>"></div>
    </div>

    <!-- Кнопка twitter -->
    <div class="like_button">
        <a href="https://twitter.com/share" class="twitter-share-button" data-lang="ru">Твитнуть</a>
    </div>

    <!-- Кнопка facebook -->
    <div class="like_button" style="top: -2px;">
        <div data-action="like" class="fb-like" data-href="<?= $url ?>" data-send="false" data-layout="button_count" data-show-faces="false"></div>
        <div id="fb-root"></div>
    </div>
    <div class="clear" style="clear:both;"></div>

    <?php
    $cs = Yii::app()->clientScript;
    $cs->registerScriptFile('//vk.com/js/api/openapi.js?113', CClientScript::POS_END);
    $cs->registerScript('VK_Init', 'VK.init({apiId: 4415637, onlyWidgets: true});');
    $cs->registerScript('VK_Like', 'VK.Widgets.Like("vk_like", {type: "mini"});');
    $cs->registerScript('FB_Like',
        '(function(d, s, id) {'.
        'var js, fjs = d.getElementsByTagName(s)[0];'.
        'if (d.getElementById(id)) return;'.
        'js = d.createElement(s); js.id = id;'.
        'js.src = "//connect.facebook.net/ru_RU/all.js#xfbml=1&appId=251676075025009";'.
        'fjs.parentNode.insertBefore(js, fjs);'.
        '}(document, "script", "facebook-jssdk"));'
    );
    $cs->registerScript('Twitter_Like', '!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?"http":"https";if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document, "script", "twitter-wjs");');
    $cs->registerScript('Google_Like',
        'window.___gcfg = {lang: "ru"};'.
        '(function() {'.
        'var po = document.createElement("script"); po.type = "text/javascript"; po.async = true;'.
        'po.src = "https://apis.google.com/js/plusone.js";'.
        'var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(po, s);'.
        '})();'
    );
    ?>
</div>