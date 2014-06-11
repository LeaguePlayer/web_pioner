<?php
/**
 * Миграция m140610_090752_collective_videos
 *
 * @property string $prefix
 */
 
class m140610_090752_collective_videos extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	private $dropped = array('{{collective_videos}}', '{{collective_videos_list}}');

    public function safeUp()
    {
        $this->_checkTables();

        $this->createTable('{{collective_videos_list}}', array(
            'id' => 'pk', // auto increment
            'node_id' => "integer DEFAULT NULL COMMENT 'Ссылка на раздел'",
            'status' => "integer",
            'create_time' => "datetime COMMENT 'Дата создания'",
            'update_time' => "datetime COMMENT 'Дата последнего редактирования'",
        ),
        'ENGINE=MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci');

        $this->createTable('{{collective_videos}}', array(
            'id' => 'pk', // auto increment
            'name' => "string COMMENT 'Название видео'",
            'code' => "text NOT NULL",
            'img_preview' => "string",
            'description' => "text",
            'date_publish' => "datetime COMMENT 'Дата публикации'",
            'status' => "smallint(5) COMMENT 'Статус'",
            'list_id' => "integer NOT NULL",
            'seo_id' => "integer NOT NULL",
            'create_time' => "datetime COMMENT 'Дата создания'",
            'update_time' => "datetime COMMENT 'Дата последнего редактирования'",
        ),
        'ENGINE=MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci');

        $this->insert('{{materials}}', array(
            'class_name' => 'CollectiveVideosList',
            'name' => 'Видеоотчеты'
        ));
    }


    public function safeDown()
    {
        $this->delete('{{materials}}', "class_name='CollectiveVideosList'");
        $this->_checkTables();
    }
 
    /**
     * Удаляет таблицы, указанные в $this->dropped из базы.
     * Наименование таблиц могут сожержать двойные фигурные скобки для указания
     * необходимости добавления префикса, например, если указано имя {{table}}
     * в действительности будет удалена таблица 'prefix_table'.
     * Префикс таблиц задается в файле конфигурации (для консоли).
     */
    private function _checkTables ()
    {
        if (empty($this->dropped)) return;
 
        $table_names = $this->getDbConnection()->getSchema()->getTableNames();
        foreach ($this->dropped as $table) {
            if (in_array($this->tableName($table), $table_names)) {
                $this->dropTable($table);
            }
        }
    }
 
    /**
     * Добавляет префикс таблицы при необходимости
     * @param $name - имя таблицы, заключенное в скобки, например {{имя}}
     * @return string
     */
    protected function tableName($name)
    {
        if($this->getDbConnection()->tablePrefix!==null && strpos($name,'{{')!==false)
            $realName=preg_replace('/{{(.*?)}}/',$this->getDbConnection()->tablePrefix.'$1',$name);
        else
            $realName=$name;
        return $realName;
    }
 
    /**
     * Получение установленного префикса таблиц базы данных
     * @return mixed
     */
    protected function getPrefix(){
        return $this->getDbConnection()->tablePrefix;
    }
}