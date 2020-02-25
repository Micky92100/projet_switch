<!-- I AM CONTROLLER -->
<?php
require('model/model.php');

//if homepage and user logged in
$rooms_list = getAllRooms();
require('indexView.php');

if (isset($_GET['action']) && $_GET['action'] == 'edit' && !empty($_GET['room-id'])) {
    $current_room = getRoomForUpdate();

    $room_id = $current_room['id_salle'];
    $title = $current_room['titre'];
    $description = $current_room['description'];
    $country = $current_room['pays'];
    $city = $current_room['ville'];
    $address = $current_room['adresse'];
    $current_img = $current_room['photo'];
    $zip = $current_room['cp'];
    $capacity = $current_room['capacite'];
    $category = $current_room['categorie'];

    $rooms_list = getAllRooms();
    require('view/back-office/roomsView.php');
}

if (isset($_GET['action']) && $_GET['action'] == 'delete' && !empty($_GET['room-id'])) {
    deleteRoom();
    require('view/back-office/roomsView.php');
}

if (
    isset($_POST['room-id']) &&
    isset($_POST['title']) &&
    isset($_POST['description']) &&
    isset($_POST['country']) &&
    isset($_POST['city']) &&
    isset($_POST['address']) &&
    isset($_POST['zip']) &&
    isset($_POST['capacity']) &&
    isset($_POST['category'])
) {
//    $room_id = "";
//    $title = "";
//    $description = "";
//    $db_img = "";
//    $country = "";
//    $city = "";
//    $address = "";
//    $zip = "";
//    $capacity = "";
//    $category = "";
    $room_id = trim($_POST['room-id']);
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $country = trim($_POST['country']);
    $city = trim($_POST['city']);
    $address = trim($_POST['address']);
    $zip = trim($_POST['zip']);
    $capacity = trim($_POST['capacity']);
    $category = trim($_POST['category']);

    $msg = saveOrUpdateRoom();
    require('view/back-office/roomsView.php');
}