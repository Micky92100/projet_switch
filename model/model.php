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

function getAllRooms()
{
    $pdo = dbConnect();

    return $pdo->query("SELECT * FROM salle");
}

function getRoomForUpdate($room_id)
{
    $pdo = dbConnect();

    $current_room = $pdo->prepare("SELECT * FROM salle WHERE id_salle = :roomId");
    $current_room->bindparam(":roomId", $room_id, PDO::PARAM_INT);
    $current_room->execute();

//    var_dump($current_room);

    if ($current_room->rowCount() > 0) {
        return $current_room->fetch(PDO::FETCH_ASSOC);
    }
}

function deleteRoom()
{
    $pdo = dbConnect();

    $del = $pdo->prepare("DELETE FROM salle WHERE id_salle = :roomId");
    $del->bindParam(":roomId", $_GET['room-id'], PDO::PARAM_INT);
    $del->execute();
}

function saveOrUpdateRoom()
{
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
    // récupération de la photo actuelle pour les modifs
    if (!empty($_POST['current-img'])) {
        $db_img = $_POST['current-img'];
    }
    if (empty($zip) || !is_numeric($zip)) {
        $msg = '<div class="alert alert-danger mt-3">Attention, le code postal est obligatoire et doit être numérique.</div>';
    }

    // controle sur la id salle car elle est unique en BDD
    $ref_check = $pdo->prepare("SELECT * FROM salle WHERE id_salle = :roomId");
    $ref_check->bindParam(':roomId', $room_id, PDO::PARAM_INT);
    $ref_check->execute();

    // si on a une ligne, alors la reference existe en bdd
    // on ne vérifie la référence que lors d'un ajout. Si $id_salle est vide alors c'est un ajout sinon c'est une modif.
    if ($ref_check->rowCount() > 0 && empty($room_id)) {
        $msg = '<div class="alert alert-danger mt-3">Attention, référence indisponible car déjà attribuée.</div>';
    } else {
        // vérification du format de l'image, formats accèptés : jpg, jpeg, png, gif
        // est-ce qu'une image a été posté :
        if (!empty($_FILES['img']['name'])) {

            // on vérifie le format de l'image en récupérant son extension
            $extension = strrchr($_FILES['img']['name'], '.');
            // strrchr() découpe une chaine fournie en premier argument en partant de la fin. On remonte jusqu'au caractère fourni en deuxième argument et on récupère tout depuis ce caractère.
            // exemple strrchr('image.png', '.'); => on récupère .png
//            var_dump($extension);

            // on enlève le point et on passe l'extension en minuscule pour pouvoir la comparer.
            $extension = strtolower(substr($extension, 1));
            // exemple : .PNG => png    .Jpeg => jpeg

            // on déclare un tableau array contenant les extensions autorisées :
            $valid_extensions = array('png', 'gif', 'jpg', 'jpeg');

            // in_array(ce_quon_cherche, tableau_ou_on_cherche);
            // in_array() renvoie true si le premier argument correspond à une des valeurs présentes dans le tableau array fourni en deuxième argument. Sinon false
            $check_extension = in_array($extension, $valid_extensions);

            if ($check_extension) {

                // pour ne pas écraser une image du même nom, on renomme l'image en rajoutant la référence qui est une information unique
                $img_name = $_FILES['img']['name'];

                $db_img = $img_name; // représente l'insertion en BDD

                // on prépare le chemin où on va enregistrer l'image
                // $photo_dossier = SERVER_ROOT . SITE_ROOT . 'img/' . $nom_photo;
                $img_file = 'img/' . $img_name;
//                var_dump($img_file);

                // copy(); permet de copier un fichier depuis un emplacement fourni en premier argument vers un emplacement fourni en deuxième
                copy($_FILES['img']['tmp_name'], $img_file);
            } else {
                $msg = '<div class="alert alert-danger mt-3">Attention, le format description de la photo est invalide, extensions autorisées : jpg, jpeg, png, gif.</div>';
            }
        }
    }

    // on peut déclencher l'enregistrement s'il n'y a pas eu d'erreur dans les traitements précédents
    if (empty($msg)) {
        if (!empty($room_id)) {
            // si $id_salle n'est pas vide c'est un UPDATE
            $save = $pdo->prepare("UPDATE salle SET titre = :title, photo = :img, description = :description, pays = :country, ville = :city, adresse = :address, cp = :zip, capacite = :capacity, categorie = :category WHERE id_salle = :roomId");
            // on rajoute le bindParam pour l'room_id car => modification
            $save->bindParam(":roomId", $room_id, PDO::PARAM_INT);

        } else {
            // sinon un INSERT
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
