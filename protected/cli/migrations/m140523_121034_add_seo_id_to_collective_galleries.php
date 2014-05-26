<?php
/**
 * Миграция m140523_121034_add_seo_id_to_collective_galleries
 *
 * @property string $prefix
 */
 
class m140523_121034_add_seo_id_to_collective_galleries extends CDbMigration
{
	public function safeUp()
	{
		$this->addColumn('{{collective_galleries}}', 'seo_id', 'integer');
	}

	public function safeDown()
	{
		$this->dropColumn('{{collective_galleries}}', 'seo_id');
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