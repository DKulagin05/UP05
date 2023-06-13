<?php
use api\GetData;

require_once './GetData.php';

$getData = new GetData();
$result = $getData->GetAllFrom('Tours');
echo json_encode($result);