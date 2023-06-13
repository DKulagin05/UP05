<?php
use api\GetData;

require_once './GetData.php';

$getData = new GetData();
$result = $getData->GetAllFrom('ClientCategories');
echo json_encode($result);