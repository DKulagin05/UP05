<?php
use api\RemoveData;
require_once './RemoveData.php';

$entityBodyReg = json_decode(file_get_contents('php://input'),true);
$id = $entityBodyReg['id_hotel'];
$remove = new RemoveData();
$result = $remove->RemoveFromWhere('Hotels',"id = $id");
echo json_encode($result);