<?php
use api\RemoveData;
require_once './RemoveData.php';

$entityBodyReg = json_decode(file_get_contents('php://input'),true);
$id = $entityBodyReg['remove_id'];
$remove = new RemoveData();
$result = $remove->RemoveFromWhere('Reviews',"id = $id");
echo json_encode($result);