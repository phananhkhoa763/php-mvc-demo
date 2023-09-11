<?php
class UserModel extends Model {
    protected $_table = 'users';

    function __construct() {
        parent::__construct();
    }
    public function gitList() {
        $data = $this->db->query("SELECT * FROM $this->_table limit 10")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
}