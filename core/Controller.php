<?php 
class Controller
{
    public $db;
    public function model($model) {
        $fileModel = _DIR_ROOT.'/app/Models/'.$model.'.php';
        if(file_exists($fileModel)) {
            require_once $fileModel;
            if(class_exists($model)) {
                $model = new $model();
                return $model;
            }
        }
        return false;
    }

    public function render($view,$data=[]) {
        extract($data);// chuyển key thành biến
        $fileView = _DIR_ROOT.'/app/Views/'.$view.'.php';
        if(file_exists($fileView)) {
            require_once $fileView;
        }
    }
}