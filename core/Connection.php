<?php
class Connection {
    private static $instance = null,$connection=null;

    private function __construct($config) {
         //Kết nối database
        try {
            //Cấu hình dsn
            $dsn = 'mysql:dbname='.$config['dbname'].';host='.$config['host'].';port='.$config['port'];
              /*
             * - Cấu hình utf8
             * - Cấu hình ngoại lệ khi truy vấn bị lỗi
             * */
            $option = [
                PDO::MYSQL_ATTR_COMPRESS => ' SET NAMES utf8', 
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ];
              //Câu lệnh kết nối
            $connection  = new PDO($dsn,$config['user'],$config['pass'],$option);
            self::$connection = $connection;
        } catch (Exception $exception) {
            $mess = $exception->getMessage();
            App::$app->loadError('database', ['message' => $mess]);
            die();
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