<?php
/**
 * Миграция m140523_034601_add_short_name_to_collectives
 *
 * @property string $prefix
 */
 
class m140523_034601_add_short_name_to_collectives extends CDbMigration
{
    public function safeUp()
    {
		$this->addColumn('{{collectives}}', 'short_name', 'string');
    }
 
    public function safeDown()
    {
		$this->dropColumn('{{collectives}}', 'short_name');
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