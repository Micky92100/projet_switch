<!-- I AM CONTROLLER -->
<?php
require('model/model.php');

function showOrders()
{
    $orders_list = getAllOrders();
    require('view/back-office/ordersView.php');

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
    listRooms();
}

function getDeleteRoom()
{
    deleteRoom();
    listRooms();
}

function saveRoom()
{
    $msg = saveOrUpdateRoom();
    listRooms();
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

function getUsers()
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

function showProduct($product_id)
{
    $current_product = getProductForUpdate($product_id);
    $current_room = getProductRoom($current_product);
    listProducts();
}
function getDeleteProduct()
{
    deleteProduct();
    listProducts();
}

function saveProduct()
{
    $msg = saveOrUpdateProduct();
    listProducts();
}
