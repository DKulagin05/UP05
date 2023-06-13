<?php
use api\RemoveData;
require_once './RemoveData.php';

$entityBodyReg = json_decode(file_get_contents('php://input'),true);
$id = $entityBodyReg['id_tour'];
$remove = new RemoveData();
$result = $remove->RemoveFromWhere('Tours',"id = $id");
echo json_encode($result);