<?php

return array(
    'components' => array(
        'db' => array(
            'schemaCachingDuration' => 86400,
        ),
        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    'levels'=>'error, warning',
                ),
            ),
        ),
    ),
);