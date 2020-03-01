<!-- I AM CONTROLLER -->
<?php
require('model/model.php');

function listRoomsIndex()
{
    $rooms_list = getAllRooms();
    require('indexView.php');
}
function listRooms()
{
    $rooms_list = getAllRooms();
    require('view/back-office/roomsView.php');
}

function showRoom($room_id)
{
    $current_room = getRoomForUpdate($room_id);
    $rooms_list = getAllRooms();
    require('view/back-office/roomsView.php');
}

function getDeleteRoom()
{
    deleteRoom();
    require('view/back-office/roomsView.php');
}

function saveRoom() {

    $msg = saveOrUpdateRoom();

    $rooms_list = getAllRooms();
    require('view/back-office/roomsView.php');
}