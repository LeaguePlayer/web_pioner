<?php
/**
 * Миграция m140520_063917_add_date_public_to_news
 *
 * @property string $prefix
 */
 
class m140520_063917_add_date_public_to_news extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	private $dropped = array('{{add_date_public_to_news}}');
 
    public function safeUp()
    {
		$this->addColumn('{{news}}', 'date_public', 'datetime');
    }
 
    public function safeDown()
    {
		$this->dropColumn('{{news}}', 'date_public');
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