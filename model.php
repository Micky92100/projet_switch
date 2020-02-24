<?php
session_start();
define('SERVER_ROOT', $_SERVER['DOCUMENT_ROOT']);
define('SITE_ROOT', SERVER_ROOT . '/PHP ifocop/PHP/switch/');
$msg = "";

function dbConnect()
{
    $host_db = 'mysql:host=localhost;dbname=projet_switch';
    $login = 'root';
    $password = '';
    $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
    );
    return new PDO($host_db, $login, $password, $options);
}

function user_is_connected()
{
    if (!empty($_SESSION['membre'])) {
        return true;
    }
    return false;
}

function user_is_admin()
{
    if (user_is_connected() && $_SESSION['membre']['statut'] == 2) {
        return true;
    } else {
        return false;
    }
}

function tabulateAllRooms()
{
    $pdo = dbConnect();

    $rooms_list = $pdo->query("SELECT * FROM salle");
    return $rooms_list;
}



