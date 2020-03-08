<!-- I AM CONTROLLER -->
<?php
require('model/model.php');

function showOrders()
{
    $orders_list = getAllOrders();
    require('view/back-office/ordersView.php');

}
function showRates(){
    $notice_list = getAllrates();
    require('view/back-office/ratingsView.php');

}

function listProductsIndex()
{
    $products_list = getAllProductsIndex();
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

function saveRoom()
{
    $msg = saveOrUpdateRoom();
    $rooms_list = getAllRooms();
    require('view/back-office/roomsView.php');
}

function getSignUp()
{
    require('view/front-office/signupView.php');
}

function doSignUp()
{

    $msg = saveUser();
    if (!$msg) {
        listProductsIndex();
    } else {
        $_POST = '';
        require('view/front-office/signupView.php');
    }
}

function getLogin()
{
    if (isset($_SESSION)) {
        session_destroy();
    }
    require('view/front-office/loginView.php');
}

function doLogin()
{
    $msg = verifyLogin();
    if (!$msg) {
        listProductsIndex();
    } else {
        $_POST = '';
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

function searchProducts()
{
    $products_list = getSearchedProducts();
    require('indexView.php');
}


function getUsers(){
    $users_list = getAllUsers();
    require('view/back-office/usersView.php');
}

function showUsers($user_id)
{
    $current_user = getRoomForUpdate($user_id);
    $users_list = getAllUsers();
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

function getDeleteOrder()
{
    deleteOrder();
    $orders_list = getAllOrders();
    require('view/back-office/ordersView.php');
}

function listProducts()
{
    $products_list = getAllProducts();
    $rooms_list = getAllRooms();
    require('view/back-office/productsView.php');
}

function showProduct($product_id, $room_id)
{
    $current_product = getProductForUpdate($product_id);
    $current_room = getRoomForUpdate($room_id);
    $products_list = getAllProducts();
    $rooms_list = getAllRooms();
    require('view/back-office/productsView.php');
}
function getDeleteProduct()
{
    deleteProduct();
    $products_list = getAllProducts();
    $rooms_list = getAllRooms();
    require('view/back-office/productsView.php');
}

function saveProduct()
{
    $msg = saveOrUpdateProduct();
    $products_list = getAllProducts();
    $rooms_list = getAllRooms();
    require('view/back-office/productsView.php');
}
