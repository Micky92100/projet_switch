<!-- I AM CONTROLLER -->
<?php
require('model/model.php');

function listProductsIndex()
{
    $products_list = getAllProducts();
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
    $rooms_list = getAllRooms();
    require('view/back-office/roomsView.php');
}

function saveRoom() {

    $msg = saveOrUpdateRoom();

    $rooms_list = getAllRooms();
    require('view/back-office/roomsView.php');
}

function getSignUp() {
    require('view/front-office/signupView.php');
}

function doSignUp() {
    // ATTENTION //
    // $msg a un problème et ne s'affiche pas.
    // mais le comportement est ok a part ca : si le pseudo est déjà utilisé, la sauvegarde n'a pas lieu et l'utilisateur reste sur la page signup...

    $msg = saveUser();
    if(!$msg){
        listRoomsIndex();
    } else {
        $_POST='';
        require('view/front-office/signupView.php');
    }
}

function getLogin() {
    
    require('view/front-office/loginView.php');
}
function getIduser(){
      header('view/front-office/profileView.php');

}
                
function searchProducts(){
    $products_list = getSearchedProducts();
    require('indexView.php');
}
function showProfile(){
    
    require('view/front-office/profileView.php');
}