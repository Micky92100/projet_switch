<!-- I AM ROUTER -->
<?php
require('controller/controller.php');

if (isset($_GET['action'])) {
        ////////////////////////////////////////////////////////////////// ROOMS v
    if ($_GET['action'] == 'editRoom') {
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
        } else if (!empty($_GET['room-id'])){
            showRoom($_GET['room-id']);
        }
    } else if ($_GET['action'] == 'deleteRoom' && !empty($_GET['room-id'])) {
        getDeleteRoom();
    } else if ($_GET['action'] == 'listRooms') {
        listRooms();
        ////////////////////////////////////////////////////////////////// ROOMS ^
        ////////////////////////////////////////////////////////////////// USERS v
    } else if ($_GET['action'] == 'editUser') {
        if (
            isset($_POST['id_membre']) &&
            isset($_POST['pseudo']) &&
            isset($_POST['mdp']) &&
            isset($_POST['nom']) &&
            isset($_POST['prenom']) &&
            isset($_POST['email']) &&
            isset($_POST['civilite']) &&
            isset($_POST['statut'])
        ) {
            createUser();
        } else if (!empty($_GET['user-id'])){
            showUser($_GET['user-id']);
        }
    } else if ($_GET['action'] == 'deleteUser' && !empty($_GET['user-id'])) {
        getDeleteUser();
    } else if ($_GET['action'] == 'listUsers') {
        listUsers();
        ////////////////////////////////////////////////////////////////// USERS ^
        ////////////////////////////////////////////////////////////////// PRODUCTS v
    } else if ($_GET['action'] == 'searchProducts') {
        if (isset($_POST['category']) &&
            isset($_POST['city']) &&
            isset($_POST['capacity']) &&
            isset($_POST['price']) &&
            isset($_POST['arrival']) &&
            isset($_POST['departure'])) {
            searchProducts();
        }
    } else if ($_GET['action'] == 'editProduct') {
        if (
            isset($_POST['arrival']) &&
            isset($_POST['departure']) &&
            isset($_POST['room']) &&
            isset($_POST['price'])
        ) {
            saveProduct();
        } else if (!empty($_GET['product-id'])) {
            showProduct($_GET['product-id'], $_GET['room-id']);
        }
    } else if ($_GET['action'] == 'deleteProduct' && !empty($_GET['product-id'])) {
        getDeleteProduct();
    } else if ($_GET['action'] == 'listProducts') {
        listProducts();
    } else if ($_GET['action'] == 'listProductsIndex') {
        listProductsIndex();
        ////////////////////////////////////////////////////////////////// PRODUCTS ^
    } else if ($_GET['action'] == 'listStats') {
        getAllStats();
        ////////////////////////////////////////////////////////////////// ORDERS v
    } else if ($_GET['action'] == 'listOrders') {
        showOrders();
    } else if ($_GET['action'] == 'deleteOrder') {
        getDeleteOrder();
        ////////////////////////////////////////////////////////////////// ORDERS ^
        ////////////////////////////////////////////////////////////////// RATINGS v
    } else if ($_GET['action'] == 'noticeList') {
        showRates();
        ////////////////////////////////////////////////////////////////// RATINGS ^
        ////////////////////////////////////////////////////////////////// LOG&SIGN v
    } else if ($_GET['action'] == 'login') {
        header("Location: " . $_SERVER['PHP_SELF']);
        getLogin();
    } else if ($_GET['action'] == 'doLogin') {
        header("Location: " . $_SERVER['PHP_SELF']);
        if (
            isset($_POST['pseudo']) &&
            isset($_POST['mdp'])
        ) {
            doLogin();
        }
    } else if ($_GET['action'] == 'signup') {
        if (isset($_POST['pseudo']) &&
            isset($_POST['mdp']) &&
            isset($_POST['prenom']) &&
            isset($_POST['nom']) &&
            isset($_POST['email']) &&
            isset($_POST['civilite'])) {
            doSignUp();
        } else {
            getSignUp();
        }
    } else if ($_GET['action'] == 'deconnexion') {
        if (!isset($_SESSION)) {
            session_start();
        }
        session_destroy();
        header("Location: " . $_SERVER['PHP_SELF']);
        getLogin();
    }
    ////////////////////////////////////////////////////////////////// LOG&SIGN ^
} else if (user_is_connected()) {
    listProductsIndex();
} else {
    getLogin();
}
