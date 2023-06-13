<?php

use api\Create;

require_once './CreateData.php';

$entityBodyReg = json_decode(file_get_contents('php://input'),true);
$create = new Create();
$name = $entityBodyReg['name'];
$result = $create->createLocation($name);
echo json_encode($result);