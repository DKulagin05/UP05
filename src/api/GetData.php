<?php

namespace api;
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
require_once 'Database.php';
header('Content-Type: application/json');

class GetData
{
    public function GetAllFrom($table)
    {
        $conn = new Database();
        $check_query = "SELECT * FROM $table";
        $result = mysqli_query($conn->getConnection(), $check_query);
        $data = array();
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
            mysqli_close($conn->getConnection());
            return $data;
        } else {
            mysqli_close($conn->getConnection());
            return 'Error';
        }
    }
    public function GetFromWhere($table,$where)
    {
        $conn = new Database();
        $check_query = "SELECT * FROM $table WHERE $where";
        $result = mysqli_query($conn->getConnection(), $check_query);
        $data = array();
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
            mysqli_close($conn->getConnection());
            return $data;
        } else {
            mysqli_close($conn->getConnection());
            return 'По вашему запросу ничего не найдено';
        }
    }
}
