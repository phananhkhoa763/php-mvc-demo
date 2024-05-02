<?php
class UserModel extends Model 
{
    protected $_table = 'users';

    function __construct() {
        parent::__construct();
    }

    function tableFill() {
        return 'users';
    }

    function fieldFill() {
        return 'id';
    }

    function primaryKey() {
        return 'id';
    }

    public function getList() {
        $data = $this->db->query("SELECT * FROM $this->_table limit 10")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getID($id) {
        $data = $this->db->select()->table('users')->where('id','=',$id)->get();
        return $data;
    }
}