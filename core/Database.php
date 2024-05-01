<?php
class Database 
{
    private $__connection;
    //Kết nối database
    function __construct() {
        global $db_config;
        $this->__connection = Connection::getInstance($db_config);
    }

    //Thêm dữ liệu
    function insert($table,$data) {
        if(!empty($data)) {
            $fieldStr = '';
            $valueStr = '';
            foreach($data as $key  => $value) {
                $fieldStr .= $key;
                $valueStr .= "'".$value."',"; 
            }
            $fieldStr = rtrim($fieldStr,',');
            $valueStr = rtrim($valueStr,',');
            $sql = " INSERT INTO $table($fieldStr) VALUE ($valueStr) ";
            $status = $this->query($sql);
            if($status) {
                return true;
            }
        }
        return false;
    }

    //Sửa dữ liệu
    function update($table,$data,$condition="") {
        if(!empty($data)) {
            $updateStr = '';
            foreach($data as $key  => $value) {
                $updateStr .= "$key='$value',";
            }
            $updateStr = rtrim($updateStr,',');

            if(!empty($condition)) {
                $sql = "UPDATE $table SET $updateStr WHERE $condition";
            }else {
                $sql = "UPDATE $table SET $updateStr";
            }
            $status = $this->query($sql);
            if($status) {
                return true;
            }
            
        }
    }

    //Xoá dữ liệu
    function delete($table,$condition="") {
        if(!empty($table)) {
            if(!empty($condition)) {
                $sql = "DELETE FROM $table WHERE $condition";
            }else {
                $sql = "DELETE FROM $table ";
            }
            $status = $this->query($sql);
            if($status) {
                return true;
            }
        }
    }

    //Truy vấn câu lệnh SQL
    function query($sql) {

        try {
            $statement = $this->__connection->prepare($sql);
            $statement->execute();
            return $statement;
        } catch (Exception $exception) {
            $mess = $exception->getMessage();
            $data['message'] = $mess;
            App::$app->loadError('database', $data);
            die();
        }
       
    }

    //Trả về id mới nhất sau khi đã insert
    function lastInsertId() {
        return $this->__connection->lastInsertId();
    }
}