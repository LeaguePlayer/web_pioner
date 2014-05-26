<?php
/**
 * Миграция m140526_122444_insert_material
 *
 * @property string $prefix
 */
 
class m140526_122444_insert_material extends CDbMigration
{
    public function safeUp()
    {
		$this->insert('{{materials}}', array(
			'class_name' => 'CollectiveEventList',
			'name' => 'Мероприятия'
		));
    }
 
    public function safeDown()
    {
		$this->delete('{{materials}}', "class_name='CollectiveEventList'");
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