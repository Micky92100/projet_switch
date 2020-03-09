<?php
session_start();
define('SERVER_ROOT', $_SERVER['DOCUMENT_ROOT']);
define('SITE_ROOT', SERVER_ROOT . '/PHP ifocop/PHP/switch/');

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
    $msg = '';
    if (!empty($_SESSION['membre'])) {
        return true;
    }
    return false;
}

function user_is_admin()
{
    $msg = '';
    if (user_is_connected() && $_SESSION['membre']['statut'] == 2) {
        return true;
    } else {
        return false;
    }
}

/////////////////////////////////////////////////////////////////////// ROOMS
function getAllRooms()
{
    $msg = '';
    $pdo = dbConnect();

    return $pdo->query("SELECT * FROM salle");
}

function getRoomForUpdate($room_id)
{
    $msg = '';
    $pdo = dbConnect();

    $current_room = $pdo->prepare("SELECT * FROM salle WHERE id_salle = :roomId");
    $current_room->bindparam(":roomId", $room_id, PDO::PARAM_INT);
    $current_room->execute();

    if ($current_room->rowCount() > 0) {
        return $current_room->fetch(PDO::FETCH_ASSOC);
    }
}

function deleteRoom()
{
    $msg = '';
    $pdo = dbConnect();

    $del = $pdo->prepare("DELETE FROM salle WHERE id_salle = :roomId");
    $del->bindParam(":roomId", $_GET['room-id'], PDO::PARAM_INT);
    $del->execute();
}

function saveOrUpdateRoom()
{
    $msg = '';
    $pdo = dbConnect();

    $room_id = trim($_GET['room-id']);
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $country = trim($_POST['country']);
    $city = trim($_POST['city']);
    $address = trim($_POST['address']);
    $zip = trim($_POST['zip']);
    $capacity = trim($_POST['capacity']);
    $category = trim($_POST['category']);
    if (!empty($_POST['current-img'])) {
        $db_img = $_POST['current-img'];
    }
    if (empty($zip) || !is_numeric($zip)) {
        $msg = '<div class="alert alert-danger mt-3">Attention, le code postal est obligatoire et doit être numérique.</div>';
    }

    $ref_check = $pdo->prepare("SELECT * FROM salle WHERE id_salle = :roomId");
    $ref_check->bindParam(':roomId', $room_id, PDO::PARAM_INT);
    $ref_check->execute();

    if ($ref_check->rowCount() > 0 && empty($room_id)) {
        $msg = '<div class="alert alert-danger mt-3">Attention, référence indisponible car déjà attribuée.</div>';
    } else {

        if (!empty($_FILES['img']['name'])) {

            $extension = strrchr($_FILES['img']['name'], '.');
            $extension = strtolower(substr($extension, 1));
            $valid_extensions = array('png', 'gif', 'jpg', 'jpeg');
            $check_extension = in_array($extension, $valid_extensions);

            if ($check_extension) {
                $img_name = $_FILES['img']['name'];
                $db_img = $img_name;
                $img_file = 'img/' . $img_name;
                copy($_FILES['img']['tmp_name'], $img_file);
            } else {
                $msg = '<div class="alert alert-danger mt-3">Attention, le format description de la photo est invalide, extensions autorisées : jpg, jpeg, png, gif.</div>';
            }
        }
    }

    if (empty($msg)) {
        if (!empty($room_id)) {
            $save = $pdo->prepare("UPDATE salle SET titre = :title, photo = :img, description = :description, pays = :country, ville = :city, adresse = :address, cp = :zip, capacite = :capacity, categorie = :category WHERE id_salle = :roomId");
            $save->bindParam(":roomId", $room_id, PDO::PARAM_INT);
        } else {
            $save = $pdo->prepare("INSERT INTO salle
    (titre, categorie, description, photo, pays, ville, adresse, cp, capacite)
    VALUES (:title, :category, :description, :img, :country, :city, :address, :zip, :capacity)");
        }

        $save->bindParam(":title", $title, PDO::PARAM_STR);
        $save->bindParam(":category", $category, PDO::PARAM_STR);
        $save->bindParam(":description", $description, PDO::PARAM_STR);
        $save->bindParam(":img", $db_img, PDO::PARAM_STR);
        $save->bindParam(":country", $country, PDO::PARAM_STR);
        $save->bindParam(":city", $city, PDO::PARAM_STR);
        $save->bindParam(":address", $address, PDO::PARAM_STR);
        $save->bindParam(":zip", $zip, PDO::PARAM_INT);
        $save->bindParam(":capacity", $capacity, PDO::PARAM_INT);
        $save->execute();
    } else {
        return $msg;
    }
}
function getAllUsers()
{
    $msg = '';
    $pdo = dbConnect();

    return $pdo->query('SELECT * FROM membre');
}

function deleteUser()
{
    $msg = '';
    $pdo = dbConnect();

    $del = $pdo->prepare("DELETE FROM membre WHERE id_membre = :userId");
    $del->bindParam(":userId", $_GET['user-id'], PDO::PARAM_INT);
    $del->execute();
}
function getUserForUpdate($user_id)
{
    $msg = '';
    $pdo = dbConnect();

    $current_user = $pdo->prepare("SELECT * FROM membre WHERE id_membre = :userId");
    $current_user->bindparam(":userId", $user_id, PDO::PARAM_INT);
    $current_user->execute();

    if ($current_user->rowCount() > 0) {
        return $current_user->fetch(PDO::FETCH_ASSOC);
    }
}
function saveUser()
{
    $msg = '';
    $pdo = dbConnect();

    $msg = false;
    $pseudo = trim($_POST['pseudo']);
    $mdp = trim($_POST['mdp']);
    $prenom = trim($_POST['prenom']);
    $nom = trim($_POST['nom']);
    $email = trim($_POST['email']);
    $civilite = trim($_POST['civilite']);

    $verif_caractere = preg_match('#^[a-zA-Z0-9._-]+$#', $pseudo);

    if (!$verif_caractere && !empty($pseudo)) {
        $msg = '<div class="alert alert-danger mt-3">Pseudo invalide, caractères autorisés : a-z et de 0-9</div>';
    }

    if (iconv_strlen($pseudo) < 4 || iconv_strlen($pseudo) > 14) {
        $msg = '<div class="alert alert-danger mt-3">Pseudo invalide, le pseudo doit avoir entre 4 et 14 caractères inclus</div>';
    }

    $verif_pseudo = $pdo->prepare("SELECT * FROM membre WHERE pseudo = :pseudo");
    $verif_pseudo->bindParam(":pseudo", $pseudo, PDO::PARAM_STR);
    $verif_pseudo->execute();

    if ($verif_pseudo->rowCount() > 0) {
        $msg = '<div class="alert alert-danger mt-3">Pseudo indisponible !</div>';
    } else if (!$msg) {
        $mdp = password_hash($mdp, PASSWORD_DEFAULT);

        $save = $pdo->prepare("INSERT INTO membre 
            (pseudo, mdp, nom, prenom, email, civilite, statut,date_enregistrement)
             VALUES (:pseudo, :mdp, :nom, :prenom, :email, :civilite, 1,NOW())");

        $save->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
        $save->bindParam(':mdp', $mdp, PDO::PARAM_STR);
        $save->bindParam(':nom', $nom, PDO::PARAM_STR);
        $save->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $save->bindParam(':email', $email, PDO::PARAM_STR);
        $save->bindParam(':civilite', $civilite, PDO::PARAM_STR);
        $save->execute();

        $_SESSION['membre'] = array();
        $_SESSION['membre']['pseudo'] = $pseudo;
        $_SESSION['membre']['nom'] = $nom;
        $_SESSION['membre']['prenom'] = $prenom;
        $_SESSION['membre']['email'] = $email;
        $_SESSION['membre']['statut'] = 1;
    }
    return $msg;
}

function getAllProductsIndex()
{
    $msg = '';
    $pdo = dbConnect();
    return $pdo->query('SELECT id_produit, prix, date_arrivee, date_depart, titre, description, photo FROM produit, salle WHERE produit.id_salle = salle.id_salle AND etat = \'libre\' AND date_arrivee >= NOW()');
}

function getAllProducts()
{
    $msg = '';
    $pdo = dbConnect();
    return $pdo->query(
        'SELECT id_produit, date_arrivee, date_depart, produit.id_salle, salle.titre, salle.capacite, salle.adresse, salle.cp, salle.ville, salle.photo, salle.description, prix, etat 
FROM produit, salle 
WHERE produit.id_salle = salle.id_salle'
    );
}

function getProductForUpdate($product_id)
{
    $msg = '';
    $pdo = dbConnect();

    $current_product = $pdo->prepare('SELECT * FROM produit WHERE id_produit = :productId');
    $current_product->bindParam(":productId", $product_id, PDO::PARAM_INT);
    $current_product->execute();

    if ($current_product->rowCount() > 0) {
        return $current_product->fetch(PDO::FETCH_ASSOC);
    }
}
function getProduct($product_id){
    $msg = '';
    $pdo = dbConnect();
    $get = $pdo->prepare('
        SELECT titre, note, photo, description, date_arrivee, date_depart, capacite, categorie, prix
        FROM salle, produit, avis
        WHERE produit.id_salle = salle.id_salle
        AND produit.id_salle = avis.id_salle
        AND produit.id_produit = :productId
        '
    );
    $get->bindParam(":productId", $product_id, PDO::PARAM_INT);
    $get->execute();
    if ($get->rowCount() > 0){
        return $get->fetch(PDO::FETCH_ASSOC);
    }

}
function getSearchedProducts()
{
    $msg = '';
    $pdo = dbConnect();
    $categorie = $_POST['category'];
    $ville = $_POST['city'];
    $capacite = $_POST['capacity'];
    $prix = $_POST['price'];
    $date_arrivee = $_POST['arrival'];
    $date_depart = $_POST['departure'];
    $date_date_arrivee = date_create($date_arrivee);
    $date_date_depart = date_create($date_depart);
    $timestamp_arr = $date_date_arrivee->getTimestamp();
    $timestamp_dep = $date_date_depart->getTimestamp();


    $result_products = $pdo->prepare('SELECT produit.id_produit, produit.prix, produit.date_arrivee, produit.date_depart, salle.titre, salle.description, salle.photo FROM produit, salle WHERE produit.id_salle = salle.id_salle AND salle.categorie = :categorie AND salle.ville = :ville AND salle.capacite >= :capacite AND produit.prix <= :prix AND produit.date_arrivee >= :date_arrivee AND produit.date_arrivee >= NOW() AND produit.date_depart <= :date_depart AND produit.etat = \'libre\'');

    $result_products->bindParam(":categorie", intval($categorie), PDO::FETCH_ASSOC);
    $result_products->bindParam(":ville", $ville, PDO::FETCH_ASSOC);
    $result_products->bindParam(":capacite", $capacite, PDO::FETCH_ASSOC);
    $result_products->bindParam(":prix", $prix, PDO::FETCH_ASSOC);
    $result_products->bindParam(":date_arrivee", $timestamp_arr, PDO::FETCH_ASSOC);
    $result_products->bindParam(":date_depart", $timestamp_dep, PDO::FETCH_ASSOC);
    $result_products->execute();
    return $result_products;
}

function verifyLogin()
{
    $msg = '';

    $pdo = dbConnect();
    $pseudo = trim($_POST['pseudo']);
    $mdp = trim($_POST['mdp']);

    $verif_connexion = $pdo->prepare("SELECT * FROM membre WHERE pseudo = :pseudo");
    $verif_connexion->bindParam(":pseudo", $pseudo, PDO::PARAM_STR);
    $verif_connexion->execute();

    if ($verif_connexion->rowCount() > 0) {
        $infos = $verif_connexion->fetch(PDO::FETCH_ASSOC);

        if (password_verify($mdp, $infos['mdp'])) {

            $_SESSION['membre'] = array();

            $_SESSION['membre']['id_membre'] = $infos['id_membre'];
            $_SESSION['membre']['pseudo'] = $infos['pseudo'];
            $_SESSION['membre']['nom'] = $infos['nom'];
            $_SESSION['membre']['prenom'] = $infos['prenom'];
            $_SESSION['membre']['email'] = $infos['email'];
            $_SESSION['membre']['statut'] = $infos['statut'];

        } else {
            $msg = '<div class="alert alert-danger mt-3">Erreur sur le pseudo et / ou le mot de passe !</div>';
        }
    } else {
        $msg = '<div class="alert alert-danger mt-3">Erreur sur le pseudo et / ou le mot de passe !</div>';
    }
    return $msg;
}



function getAllOrders()
{
    $msg = '';
    $pdo = dbConnect();
    return $pdo->query(
        'SELECT commande.id_commande, commande.id_membre, membre.email, commande.id_produit, salle.titre, produit.date_arrivee, produit.date_depart, produit.prix, commande.date_enregistrement 
FROM commande, produit, membre, salle 
WHERE commande.id_membre = membre.id_membre 
  AND commande.id_produit = produit.id_produit 
  AND produit.id_salle = salle.id_salle'
    );
}

function deleteOrder()
{
    $msg = '';
    $pdo = dbConnect();

    $del = $pdo->prepare("DELETE FROM commande WHERE id_commande = :commandeId");
    $del->bindParam(":commandeId", $_GET['order-id'], PDO::PARAM_INT);
    $del->execute();
}

function getAllrates(){
    $pdo = dbConnect();
    return $pdo->query('SELECT avis.id_avis, avis.id_membre, membre.email, avis.id_salle, salle.titre, avis.commentaire, avis.note, avis.date_enregistrement  
    FROM avis, membre, salle 
    WHERE avis.id_membre = membre.id_membre 
    AND avis.id_salle = salle.id_salle');
}
function getAllDetails($user_id){
    $pdo = dbConnect();
    $get = $pdo->prepare(
        'SELECT commande.id_commande, commande.id_produit, salle.titre, produit.date_arrivee, produit.date_depart, produit.prix, commande.date_enregistrement 
FROM commande, produit, salle 
WHERE commande.id_membre = :userId 
  AND commande.id_produit = produit.id_produit 
  AND produit.id_salle = salle.id_salle'
    );
    $get->bindParam(":userId", $user_id, PDO::PARAM_INT);
    $get->execute();
    if ($get->rowCount() > 0){
        return $get;
    }

}