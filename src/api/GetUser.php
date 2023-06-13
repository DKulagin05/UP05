<?php
use api\GetData;

require_once './GetData.php';

$entityBodyReg = json_decode(file_get_contents('php://input'),true);
$phone = $entityBodyReg['user_phone'];
$getData = new GetData();
$result = $getData->GetFromWhere('Clients',"client_phone = $phone");
echo json_encode($result);