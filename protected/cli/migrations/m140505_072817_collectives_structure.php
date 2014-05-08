<?php
/**
 * Миграция m140505_072817_collectives_list
 *
 * @property string $prefix
 */
 
class m140505_072817_collectives_structure extends CDbMigration
{
	// таблицы к удалению, можно использовать '{{table}}'
	private $dropped = array('{{collectives_structure}}');

	public function safeUp()
	{
		$this->_checkTables();

		// Данная таблица описывает структуру разделов коллективов
		$this->createTable('{{collectives_structure}}', array(
				'id' => 'pk', // auto increment
				'material_id' => "integer UNSIGNED NOT NULL",
				'name' => "string NOT NULL COMMENT 'Название раздела'",
				'url' => "string NOT NULL COMMENT 'Ссылка'",
				'collective_id' => "integer UNSIGNED NOT NULL COMMENT 'Привязка к коллективу'",
				'seo_id' => "integer UNSIGNED NOT NULL",
				'status' => "integer UNSIGNED NOT NULL",
				'sort' => "integer COMMENT 'Вес для сортировки'",
				'create_time' => "datetime COMMENT 'Дата создания'",
				'update_time' => "datetime COMMENT 'Дата последнего редактирования'",
			),
			'ENGINE=MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci');
	}

	public function safeDown()
	{
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