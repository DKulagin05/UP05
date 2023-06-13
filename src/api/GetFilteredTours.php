<?php
use api\GetData;

require_once './GetData.php';
$entityBodyReg = json_decode(file_get_contents('php://input'),true);
$priceFrom = $entityBodyReg['priceFrom'];
$priceTo = $entityBodyReg['priceTo'];
$departure = $entityBodyReg['departure'];
$destination = $entityBodyReg['destination'];
if ($priceTo === null) $priceTo = "price <= 99999"; else $priceTo = "price <= $priceTo";
if ($priceFrom === null) $priceFrom = "and price >= 0"; else $priceFrom = "and price >= $priceFrom";
if ($departure !== '') $departure = "and departure = '$departure'";
if ($destination !== '') $destination = "and destination = '$destination'";
$getData = new GetData();
$result = $getData->GetFromWhere('Tours',"$priceTo $priceFrom $departure $destination");
echo json_encode($result);