<?php
/**
 * Миграция m140523_062151_add_columns_to_collective_news
 *
 * @property string $prefix
 */
 
class m140523_062151_add_columns_to_collective_news extends CDbMigration
{
    public function safeUp()
    {
		$this->addColumn('{{collective_news}}', 'type', 'smallint');
		$this->addColumn('{{collective_news}}', 'date_public', 'datetime');
    }
 
    public function safeDown()
    {
		$this->dropColumn('{{collective_news}}', 'type');
		$this->dropColumn('{{collective_news}}', 'date_public');
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