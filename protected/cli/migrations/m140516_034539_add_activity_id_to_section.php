<?php
/**
 * Миграция m140516_034539_add_activity_id_to_section
 *
 * @property string $prefix
 */
 
class m140516_034539_add_activity_id_to_section extends CDbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{sections}}', 'activity_id', 'integer');
    }
 
    public function safeDown()
    {
		$this->dropColumn('{{sections}}', 'activity_id');
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