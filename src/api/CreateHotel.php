<?php

use api\Create;

require_once './CreateData.php';

$entityBodyReg = json_decode(file_get_contents('php://input'),true);
$create = new Create();
$name = $_POST['name'];
$description = $_POST['description'];
$img =  "C:\\OSPanel\\domains\\Practic\\src\\assets\\img\\hotels\\" . $_FILES['img']['name'];
move_uploaded_file($_FILES['img']['tmp_name'], $img);
$img = $_FILES['img']['name'];
$location = $_POST['location'];
$rating = $_POST['rating'];
$result = $create->createHotel($name, $description, $img, $location, $rating);
echo json_encode($result);