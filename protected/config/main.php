<?php

// Настройки, специфичные для данной машины (например, БД), рекомендуется поместить в overrides/local.php

return array_replace_recursive(
    array(
        'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
        'name'=>'Пионер',
        'language' => 'ru',
        'theme'=>'default',
        // preloading 'log' component
        'preload'=>array(
            'log',
            'config',
        ),
		'aliases'=>array(
			'appext'=>'application.extensions',
			'appwidgets'=>'application.widgets'
		),
        // autoloading model and component classes
        'import'=>array(
            'application.models.*',
            'application.components.*',
            'application.behaviors.*',
			'appext.imagesgallery.models.*'
        ),
        'modules'=>array(
            'admin'=>array(),
            'email'=>array(),
            'auth'=>array(),
            'user'=>array(
                'hash' => 'md5',
                'sendActivationMail' => true,
                'loginNotActiv' => false,
                'activeAfterRegister' => false,
                'autoLogin' => true,
                'registrationUrl' => array('/user/registration'),
                'recoveryUrl' => array('/user/recovery'),
                'loginUrl' => array('/user/login'),
                'returnUrl' => array('/user/profile'),
                'returnLogoutUrl' => array('/user/login'),
            ),
        ),
        // application components
        'components'=>array(
			'cache' => array(
				'class' => 'system.caching.CDbCache',
				'connectionID' => 'db'
			),
            'config' => array(
                'class' => 'DConfig'
            ),
            'db' => array(
                'connectionString' => 'mysql:host=localhost;dbname=magic',
                'emulatePrepare' => true,
                'username' => 'root',
                'password' => 'qwe123',
                'charset' => 'utf8',
                'tablePrefix' => 'tbl_',
            ),
            'authManager' => array(
                'class' => 'CDbAuthManager',// 'auth.components.CachedDbAuthManager',
                //'cachingDuration' => 0,
                'itemTable' => '{{authitem}}',
                'itemChildTable' => '{{authitemchild}}',
                'assignmentTable' => '{{authassignment}}',
                'behaviors' => array(
                    'auth' => array(
                        'class' => 'auth.components.AuthBehavior',
                    ),
                ),
            ),
            'user'=>array(
                'class' => 'user.components.WebUser',
            ),
            'bootstrap'=>array(
                'class'=>'appext.yiistrap.components.TbApi',
            ),
            'yiiwheels' => array(
                'class' => 'appext.yiiwheels.YiiWheels',
            ),
            'phpThumb'=>array(
                'class'=>'appext.EPhpThumb.EPhpThumb',
                'options'=>array()
            ),
            // uncomment the following to enable URLs in path-format
            'urlManager'=>array(
                'class' => 'EUrlManager',
                'showScriptName'=>false,
                'urlFormat'=>'path',
                'rules'=>array(
                    'gii'=>'gii',
                    'admin'=>'admin/structure',
                    'admin/<controller:!config>' => 'admin/<controller>/list',
                    '/'=>'site/index',
					'/contacts' => 'page/contacts',
					'<controller:page>/<url:[\w_-]+>' => '<controller>/view',
                ),
            ),
            'clientScript'=>array(
                'class'=>'EClientScript',
				'scriptMap'=>array(
					'jquery.js'=>'http://code.jquery.com/jquery-1.9.1.js',
					'jquery.min.js'=>'http://code.jquery.com/jquery-1.11.0.min.js'
				),
            ),
            'date' => array(
                'class'=>'application.components.Date',
                //And integer that holds the offset of hours from GMT e.g. 4 for GMT +4
                'offset' => 6,
            ),
            'errorHandler'=>array(
                'errorAction'=>'site/error',
            ),
			'widgetFactory' => array(
				'widgets' => array(
					'ImperaviRedactorWidget' => array(
						'options' => array(
							'lang' => 'ru',
							'iframe' => true,
							'minHeight' => 500,
							'thumbLinkClass' => 'athumbnail', //Класс по-умолчанию для ссылки на полное изображение вокруг thumbnail
							'thumbClass' => 'thumbnail pull-left', //Класс по-умолчанию для  thumbnail
							'defaultUplthumb' => true, //Вставлять по-умолчанию после загрузки превью? если нет - полное изображение
							//'allowedTags' => array('p', 'h1', 'h2', 'pre', 'div', 'ul', 'li'),
							'convertDivs' => false,
						),
						'plugins' => array(
							'fullscreen' => array(
								'js' => array('fullscreen.js',),
							),
							'fontsize' => array(
								'js' => array('fontsize.js',),
							),
							'fontcolor' => array(
								'js' => array('fontcolor.js',),
							),
							'extelf' => array(
								'js' => array('extelf.js',),
							),
						),
					)
				)
			)
        ),
        'params'=>array(),
    ),
    (file_exists(__DIR__ . '/overrides/environment.php') ? require(__DIR__ . '/overrides/environment.php') : array()),
    (file_exists(__DIR__ . '/overrides/local.php') ? require(__DIR__ . '/overrides/local.php') : array())
);