<?php
/**
 * Миграция m140512_065245_places_list
 *
 * @property string $prefix
 */
 
class m140512_065245_places_list extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	private $dropped = array('{{places_list}}', '{{places}}');
 
    public function safeUp()
    {
        $this->_checkTables();

		$this->createTable('{{places}}', array(
			'id' => 'pk', // auto increment
			'name' => 'string NOT NULL',
			'img_preview' => 'string NOT NULL',
			'description' => 'text NOT NULL',
			'address' => 'string NOT NULL',
			'json_schedule' => 'text',
			'list_id' => 'integer NOT NULL',
			'seo_id' => 'integer NOT NULL',
			'status' => "integer COMMENT 'Статус'",
			'sort' => "integer COMMENT 'Вес для сортировки'",
			'create_time' => "datetime COMMENT 'Дата создания'",
			'update_time' => "datetime COMMENT 'Дата последнего редактирования'",
		), 'ENGINE=MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci');

		$this->createTable('{{places_list}}', array(
			'id' => 'pk', // auto increment
			'node_id' => 'integer NOT NULL',
		), 'ENGINE=MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci');

		$this->insert('{{materials}}', array(
			'class_name' => 'PlacesList',
			'name' => 'Места',
		));
    }
 
    public function safeDown()
    {
		$this->delete('{{materials}}', "class_name='PlacesList'");
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