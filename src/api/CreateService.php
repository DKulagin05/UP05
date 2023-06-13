<?php

use api\Create;

require_once './CreateData.php';

$entityBodyReg = json_decode(file_get_contents('php://input'),true);
$create = new Create();
$name = $entityBodyReg['name'];
$description = $entityBodyReg['description'];
$price = $entityBodyReg['price'];
$result = $create->createService($name, $description, $price);
echo json_encode($result);