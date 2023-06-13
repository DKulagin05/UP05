<?php

use api\Create;
require_once './CreateData.php';


$entityBodyReg = json_decode(file_get_contents('php://input'),true);

$create = new Create();
$id_user = $entityBodyReg['id_user'];
$user_name = $entityBodyReg['user_name'];
$title = $entityBodyReg['title'];
$description = $entityBodyReg['description'];
$rating = $entityBodyReg['rating'];

$result = $create->createReview($id_user, $user_name, $title, $description, $rating);
echo json_encode($result);