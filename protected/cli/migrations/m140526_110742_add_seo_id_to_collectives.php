<?php
/**
 * Миграция m140526_110742_add_seo_id_to_collectives
 *
 * @property string $prefix
 */
 
class m140526_110742_add_seo_id_to_collectives extends CDbMigration
{
	public function safeUp()
	{
		$this->addColumn('{{collectives}}', 'seo_id', 'integer');
	}

	public function safeDown()
	{
		$this->dropColumn('{{collectives}}', 'seo_id');
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