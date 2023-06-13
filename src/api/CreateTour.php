<?php

use api\Create;

require_once './CreateData.php';

$entityBodyReg = json_decode(file_get_contents('php://input'),true);
$create = new Create();
$title = $_POST['title'];
$description = $_POST['description'];
$img =  "C:\\OSPanel\\domains\\Practic\\src\\assets\\img\\tours\\" . $_FILES['img']['name'];
move_uploaded_file($_FILES['img']['tmp_name'], $img);
$img = $_FILES['img']['name'];
$departure = $_POST['departure'];
$destination = $_POST['destination'];
$date = $_POST['date'];
$duration = $_POST['duration'];
$price = $_POST['price'];
$hotel_id = $_POST['hotel_id'];
$result = $create->createTour($title,$description,$img,$departure,$destination,$date,$duration,$price,$hotel_id);
echo json_encode($result);