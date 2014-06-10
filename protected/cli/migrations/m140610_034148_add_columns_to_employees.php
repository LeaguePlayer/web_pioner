<?php
/**
 * Миграция m140610_034148_add_columns_to_employees
 *
 * @property string $prefix
 */
 
class m140610_034148_add_columns_to_employees extends CDbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{employees}}', 'description', 'text');
        $this->addColumn('{{employees}}', 'rank', 'string');
    }
 
    public function safeDown()
    {
        $this->dropColumn('{{employees}}', 'description');
        $this->dropColumn('{{employees}}', 'rank');
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