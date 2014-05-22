imperavi-elfinder
================

imperavi elfinder

Интеграция wysiwyg редактора  <a href="https://github.com/yiiext/imperavi-redactor-widget">imperavi</a>  и файлового менеджера  <a href="https://github.com/ezze/ezze-elfinder">elfinder</a>

Установка
------------

Скопировать содержимое в папку `protected/extensions`

Использование
-----

Предположим у нас есть модуль `admin`, Контроллер `PostController`, модель `Post` и view `post/edit` для модели `Post`.
Кроме этого у нас есть контроллер `FileController` в котором прописаны `action` для imperavi.

1 Пропишем `actions` для `FileController`, нас интересует action `fileUploaderConnector`

```php
public function actions()
    {
        return array(
            

			'fileUploaderConnector'=>array(
			'class'=>'application.extensions.ezzeelfinder.ElFinderConnectorAction',
			
			),
           
            
        );
    }
```


2 в view `post\edit` подключаем виджет imperavi:


```php
 $this->widget('ImperaviRedactorWidget', array(
            // You can either use it for model attribute
            'model' => $model,
            'attribute' => 'text',

            'plugins' => array(
                'fontfamily' => array(
                'js' => array('fontfamily.js',),
                ),
                 'fontcolor' => array(
                'js' => array('fontcolor.js',),
                ),
                 'fontsize' => array(
                'js' => array('fontsize.js',),
                ),
                'fullscreen' => array(
                'js' => array('fullscreen.js',),
                ),
                 'extelf' => array(
                'js' => array('extelf.js',),
                ), //подключаем плагин для работы с elfinder

               
                
                ),


            'options'=>array(
                
                'buttons'=>array(
                    'formatting', '|', 'bold', 'italic', 'deleted', '|',
                    'unorderedlist', 'orderedlist', 'outdent',  'indent', 'alignment', 'table','horizontalrule', '|',
                    'image', 'video', 'file', 'link',  '|', 'html',
                ),
                'lang'=>'ru',
                'rows'=> '2',
                'minHeight' => 300,
                'thumbLinkClass'=>'athumbnail', //Класс по-умолчанию для ссылки на полное изображение вокруг thumbnail
                'thumbClass'=>'thumbnail pull-left', //Класс по-умолчанию для  thumbnail
                'defaultUplthumb'=>true, //Вставлять по-умолчанию после загрузки превью? если нет - полное изображение
                // 'iframe' => true,
                'toolbar' => true,

                'fmUrl'=>Yii::app()->createUrl('/admin/file/fileUploaderConnector'), //ссылка на ElFinderConnectorAction
               
                


            ),
        )); 

```
3 в тоже view файле `post/edit` подключаем elfinder, для это добавляем в файл контейнер и сам виджет

`<div id="file-uploader"></div>`

```php
$this->widget("application.extensions.ezzeelfinder.ElFinderWidget", array(
    'selector' => "div#file-uploader",
    'clientOptions' => array(
        'lang' => "ru",
        'resizable' => true,
    ),
));
```

4 В файле `ElFinderConnectorAction` прописываем параметры подключения

```php
$connectorOptions = array(
            'roots' => array(
                array(
                    'driver'  => "LocalFileSystem",
                    'path' => realpath(Yii::app()->basePath.'/../file'),
                    'URL' => Yii::app()->request->baseUrl .'/file',
                    'accessControl' => "access",
                    'mimeDetect' => "internal", //параметр должен быть заполнен !!!
                    'resizable' => true,
                    'locale' => 'ru_RU.UTF-8',
                )   
            )

        );
```

<b>Важно чтобы параметр `mimeDetect` был установлен, иначе будет ошибка соединения.

Чтобы поменять иконку для elfinder идем в файл `redactor.js` (строчка 2684) тут я подключаю класс для кнопки с font иконкой
```js
if (btnName =='elfinder') {
				var $button = $('<a href="javascript:;" title="' + btnObject.title + '" tabindex="-1" class="fa fa-folder"></a>');
			}
			else {
				var $button = $('<a href="javascript:;" title="' + btnObject.title + '" tabindex="-1" class="re-icon re-' + btnName + '"></a>');
			}
```












