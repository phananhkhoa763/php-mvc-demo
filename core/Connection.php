<?php
class Connection {
    private static $instance = null,$connection=null;

    private function __construct($config) {
        try {
            $dsn = 'mysql:dbname='.$config['dbname'].';host='.$config['host'].';port='.$config['port'];
            $option = [
                PDO::MYSQL_ATTR_COMPRESS => ' SET NAMES utf8', 
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ];
            $connection  = new PDO($dsn,$config['user'],$config['pass'],$option);
            self::$connection = $connection;
        } catch (Exception $exception) {
            $message = $exception->getMessage();
            $data['message'] = $message;
            App::$app->loadError('database',$data);die;
        }
    }

    public static function getInstance($config) {
        if(self::$instance == null) {
           $connectionDB = new Connection($config);
           self::$instance = self::$connection;
 
        }
        return self::$instance;
    }
}