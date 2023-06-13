<?php

use api\Create;

require_once './CreateData.php';

$entityBodyReg = json_decode(file_get_contents('php://input'),true);
$create = new Create();
$discount_title = $entityBodyReg['name'];
$discount_description = $entityBodyReg['description'];
$discount_type = $entityBodyReg['discountType'];
$discount_value = $entityBodyReg['discountAmount'];
$direction = $entityBodyReg['direction'];
$client_category = $entityBodyReg['clientCategory'];
$end_date = isset($entityBodyReg['date']) ? $entityBodyReg['date'] : '';
$result = $create->createPromotion($discount_type, $discount_title, $discount_description, $discount_value, $end_date, $direction, $client_category);
echo json_encode($result);