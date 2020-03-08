<!-- I AM CONTROLLER -->
<?php
require('model/model.php');

function showOrders(){
    $orders_list = getAllOrders();
    require('view/back-office/ordersView.php');

}
function showRates(){
    $notice_list = getAllrates();
    require('view/back-office/ratingsView.php');

}

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
        $products_list = getAllProducts();
        require('indexView.php');
    } else {
        $_POST='';
        require('view/front-office/signupView.php');
    }
}

function getLogin() {
    require('view/front-office/loginView.php');
}

function doLogin() {
    $msg = verifyLogin();
    if(!$msg){
        $products_list = getAllProducts();
        require('indexView.php');
    } else {
        $_POST='';
        require('view/front-office/loginView.php');
    }
}
//function getIduser(){
//      header('view/front-office/profileView.php');
//
//}
//function showProfile(){
//
//    require('view/front-office/profileView.php');
//}

function searchProducts(){
    $products_list = getSearchedProducts();
    require('indexView.php');
}

function getUsers(){
    $user = "";
    $users_list = getAllUsers();
    require('view/back-office/usersView.php');
}

function showUsers($user_id)
{
    $current_user = getRoomForUpdate($user_id);
    $users_list = getUsers();
    require('view/back-office/usersView.php');
}
function getDeleteUser()
{
    deleteUser();
    $users_list = getAllUsers();
    require('view/back-office/usersView.php');
}
function listUsers()
{
    $users_list = getAllUsers();
    require('view/back-office/usersView.php');
}