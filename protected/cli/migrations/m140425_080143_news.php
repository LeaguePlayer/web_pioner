<?php
/**
 * Миграция m140425_080143_news
 *
 * @property string $prefix
 */
 
class m140425_080143_news extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	private $dropped = array('{{news}}', '{{news_lists}}');
 
    public function safeUp()
    {
        $this->_checkTables();
 
        $this->createTable('{{news}}', array(
            'id' => 'pk', // auto increment
            'title' => 'string NOT NULL',
            'img_preview' => 'string NOT NULL',
            'short_description' => 'text NOT NULL',
            'body_content' => 'text NOT NULL',
            'tags' => 'text NOT NULL',
            'list_id' => 'integer NOT NULL',
            'seo_id' => 'integer NOT NULL',
			'status' => "integer COMMENT 'Статус'",
			'sort' => "integer COMMENT 'Вес для сортировки'",
            'create_time' => "datetime COMMENT 'Дата создания'",
            'update_time' => "datetime COMMENT 'Дата последнего редактирования'",
        ),
        'ENGINE=MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci');

		$this->createTable('{{news_lists}}', array(
			'id' => 'pk', // auto increment
			'page_size' => 'integer NOT NULL',
			'node_id' => 'integer NOT NULL',
		),
		'ENGINE=MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci');

		$this->insert('{{materials}}', array(
			'class_name' => 'NewsList',
			'name' => 'Новости',
		));
	}

	public function safeDown()
	{
		$this->delete('{{materials}}', "class_name='NewsList'");
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