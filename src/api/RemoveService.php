<?php
use api\RemoveData;
require_once './RemoveData.php';

$entityBodyReg = json_decode(file_get_contents('php://input'),true);
$id = $entityBodyReg['id_service'];
$remove = new RemoveData();
$result = $remove->RemoveFromWhere('Services',"id = $id");
echo json_encode($result);