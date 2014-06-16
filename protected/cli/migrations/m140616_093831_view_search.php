<?php
/**
 * Миграция m140616_093831_view_search
 *
 * @property string $prefix
 */
 
class m140616_093831_view_search extends CDbMigration
{
    public function safeUp()
    {
        $this->execute("CREATE OR REPLACE VIEW {{view_search}} AS
            SELECT id, title, short_description AS text, 'CollectiveNews' AS material_class FROM {{collective_news}} UNION
            SELECT id, name AS title, '' AS text, 'CollectiveGallery' AS material_class FROM {{collective_galleries}} UNION
            SELECT id, name AS title, '' AS text, 'CollectiveVideo' AS material_class FROM {{collective_videos}} UNION
            SELECT id, name AS title, description AS text, 'Collective' AS material_class FROM {{collectives}} UNION
            SELECT id, title, description AS text, 'Page' AS material_class FROM {{pages}} UNION
            SELECT id, title, description AS text, 'CollectivePage' AS material_class FROM {{collective_pages}}");
    }
 
    public function safeDown()
    {
        $this->execute('DROP VIEW {{view_search}}');
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