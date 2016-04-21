<?php

use Core\Database\MysqlDatabase;
use Core\Config;

class App
{

    public $title = 'FitnessPark';
    private static $_instance;
    private $db_instance;

    public static function getInstance(){
        if( self::$_instance === null ){
            self::$_instance = new App();
        }
        return self::$_instance;
    }


    public static function load()
    {
        session_start();
        require ROOT . '/app/Autoloader.php';
        App\Autoloader::register();
        require ROOT . '/core/Autoloader.php';
        Core\Autoloader::register();
    }


    public function getTable($name)
    {
        $class_name = '\\App\\Table\\' . ucfirst($name) . 'Table';
        return new $class_name($this->getDb());
    }


    public function getDb()
    {
        $config = Config::getInstance(ROOT . '/config/config.php');
        if( is_null($this->db_instance) ){
            $this->db_instance = new MysqlDatabase(
                $config->get('db_name'),
                $config->get('db_user'),
                $config->get('db_pass'),
                $config->get('db_host')
            );
        }
        return $this->db_instance;
    }


    public function getTitle()
    {
        return $this->title;
    }


    public function setTitle($title)
    {
        $this->title = $this->getTitle() . ' | ' . $title;
    }
    
}