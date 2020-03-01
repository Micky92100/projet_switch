<!-- I AM ROUTER -->
<?php
require('controller/controller.php');
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
    saveRoom();
} else if (isset($_GET['action']) && $_GET['action'] == 'editRoom' && !empty($_GET['room-id'])) {
    showRoom($_GET['room-id']);
} else if (isset($_GET['action']) && $_GET['action'] == 'deleteRoom' && !empty($_GET['room-id'])) {
    getDeleteRoom();
} else if (isset($_GET['action']) && $_GET['action'] == 'listRooms') {
    listRooms();
} /*else if (isset($_GET['action']) && $_GET['action'] == 'home') {
    listRoomsIndex();
}*/ else {
    listRoomsIndex();
}