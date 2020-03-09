<?php
require('model/model.php');

//////////////////////////////////////// ORDERS
function showOrders()
{
    $orders_list = getAllOrders();
    require('view/back-office/ordersView.php');

}

function getDeleteOrder()
{
    deleteOrder();
    $orders_list = getAllOrders();
    require('view/back-office/ordersView.php');
}
//////////////////////////////////////// ORDERS

//////////////////////////////////////// ROOMS
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
//////////////////////////////////////// ROOMS

//////////////////////////////////////// RATINGS
function showRates(){
    $notice_list = getAllrates();
    require('view/back-office/ratingsView.php');

}
//////////////////////////////////////// RATINGS

//////////////////////////////////////// PRODUCTS
function listProductsIndex()
{
    $products_list = getAllProductsIndex();
    require('indexView.php');
}

function searchProducts()
{
    $products_list = getSearchedProducts();
    require('indexView.php');
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
//////////////////////////////////////// PRODUCTS

//////////////////////////////////////// LOG&SIGN
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
//////////////////////////////////////// LOG&SIGN

//////////////////////////////////////// USERS
function createUser()
{
    $users_list = getAllUsers();
    $msg = saveUser();
    require('view/back-office/usersView.php');
}

function showUser($user_id)
{
    $current_user = getUserForUpdate($user_id);
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
//////////////////////////////////////// USERS
//////////////////////////////////////// PROFILE

function showProfile($user_id){
    $profile_details = getAllDetails($user_id);
    require('view/front-office/profileView.php');

}
//////////////////////////////////////// PROFILE
//////////////////////////////////////// PRODUCT DETAILS

function showProductDetails($product_id, $room_id)
{
    $product = getProduct();
    require('view/back-office/productsDetailsView.php');
}