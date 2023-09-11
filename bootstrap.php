<?php
define('_DIR_ROOT',__DIR__);
$configs_dir = scandir('configs');
if(!empty($configs_dir)) {
    foreach($configs_dir as $val) {
        if($val != '.' && $val != '..' && file_exists('configs/'.$val)) {
            require_once 'configs/'.$val;
        }
    }
}
require_once 'core/Route.php';
require_once 'app/App.php';
if(!empty($config['database'])) {
    $db_config = array_filter($config['database']);
    if(!empty($db_config)) {
        require_once  'core/Connection.php';
        require_once  'core/Database.php';
    }
}
require_once 'core/Model.php';
require_once 'core/Controller.php';