<?php

namespace api;
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
require_once 'Database.php';
header('Content-Type: application/json');

class RemoveData
{
    public function RemoveFromWhere($table, $where)
    {
        $conn = new Database();
        $check_query = "DELETE FROM $table WHERE $where";
        mysqli_query($conn->getConnection(), $check_query);
        return 'Успешно удалено';
    }
}
