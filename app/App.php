<?php 
class App {
    private $_controller,$_action,$_params,$_route;//avoid the same name
    static public $app;
    function __construct() {
        global $routes;
        self::$app = $this;
        $this->_route = new Route();
        if(!empty($routes['default_controller'])) {
            $this->_controller = $routes['default_controller'];
        }

        $this->_action = 'index';
        $this->_params = [];
        $this->handleUrl();
    }

    function getUrl() {
        if(!empty($_SERVER['REQUEST_URI'])) {
            $url =$_SERVER['REQUEST_URI'];
        }else {
            $url = '/';
        }
        return $url;
    }
    
    public function handleUrl() {
        $url = $this->getUrl();
        $url = $this->_route->handleRoute($url);
        $urlArray = array_values(array_filter(explode('/',$url)));
        $checkUrl = '';
        if(!empty($urlArray)) {
            foreach($urlArray as $key => $item) {
                $checkUrl .= ucfirst($item).'/';
                $fileCheck = rtrim($checkUrl,'/');
                if(!empty($urlArray[$key-1])) {
                    unset($urlArray[$key-1]);
                }
                if(file_exists('app/Controllers/'.$fileCheck.'Controller.php')) {
                    $checkUrl = $fileCheck.'Controller';
                    break;
                }
            }
            $urlArray = array_values($urlArray);
        }

        if(!empty($urlArray[0])) {
            $this->_controller = ucfirst($urlArray[0]).'Controller';
        }else {
            $this->_controller = ucfirst($this->_controller).'Controller';
        }

        if(empty($checkUrl)) {
            $checkUrl = $this->_controller;
        }

        $fileController = 'Controllers/'.$checkUrl.'.php';
        if(file_exists('app/'.$fileController)) {
            require_once $fileController;

            if(class_exists($this->_controller)) {
                $this->_controller = new $this->_controller();
                unset($urlArray[0]);
            }else {
                $this->loadError();
            }
                      
        }else {
            $this->loadError();
        }

        if(!empty($urlArray[1])) {
            $this->_action = $urlArray[1];
            unset($urlArray[1]);
        }

        $this->_params = array_values($urlArray);
        if(method_exists($this->_controller,$this->_action)) {
            call_user_func_array([$this->_controller,$this->_action],$this->_params);
        }else {
            $this->loadError();
        }
        
    }

    public function loadError($name='404',$data = []) {
            extract($data);
            require_once 'Errors/'.$name.'.php';    
    }
}