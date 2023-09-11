<?php 
class HomeController extends Controller {
    public $user;

    public function __construct() {
        $this->user = $this->model('UserModel');
    }

    function index() {
        $listUsers = $this->user->gitList();
        $data['content'] = 'Home/index';
        $data['subContent']['title'] = 'home page';
        $data['subContent']['listUsers'] = $listUsers;
        $this->render('Layouts/clientLayout',$data);
    }

    function detail($id='') {
        echo 'id : '.$id;
    }
}