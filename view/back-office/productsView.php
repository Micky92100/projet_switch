<?php


//**********************************************²***********************
// SUPPRESSION D'UN ARTICLE
//*********************************************************************
if (isset($_GET['action']) && $_GET['action'] == 'supprimer' && !empty($_GET['id_produit'])) {
    $del = $pdo->prepare("DELETE FROM produit WHERE id_produit = :id_produit");
    $del->bindParam(":id_produit", $_GET['id_produit'], PDO::PARAM_INT);
    $del->execute();

    $msg = '<div class="validation bg-success">Suppression du produit : ' . $_GET['id_produit'] . '</div>';
    $_GET['action'] = 'affichage';
}
//*********************************************************************
// \FIN SUPPRESSION D'UN ARTICLE
//*********************************************************************

$id_produit = "";
$date_arrivee = "";
$date_depart = "";
$id_salle = "";
$prix = "";
$etat = "";

//*********************************************************************
// ENREGISTREMENT & MODIFICATION DES ARTICLES
//*********************************************************************

if (
        isset($_POST['id_produit']) &&
    isset($_POST['date_arrivee']) &&
    isset($_POST['date_depart']) &&
    isset($_POST['id_salle']) &&
    isset($_POST['prix']) &&
    isset($_POST['etat'])
) {
    $id_produit = trim($_POST['id_produit']);
    $date_arrivee = trim($_POST['date_arrivee']);
    $date_depart = trim($_POST['date_depart']);
    $id_salle = trim($_POST['id_salle']);
    $prix = trim($_POST['prix']);
    $etat = trim($_POST['etat']);

    if (empty($prix) || !is_numeric($prix)) {
        $msg = '<div class="alert alert-danger mt-3">Attention, le tarif est obligatoire et doit être numérique.</div>';
    }

    $verif_reference = $pdo->prepare("SELECT * FROM produit WHERE id_produit = :id_produit");
    $verif_reference->bindParam(':id_produit', $id_produit, PDO::PARAM_INT);
    $verif_reference->execute();

    if ($verif_reference->rowCount() > 0 && empty($id_produit)) {
        $msg = '<div class="alert alert-danger mt-3">Attention, référence indisponible car déjà attribuée.</div>';
    }

    if (empty($msg)) {
        if (!empty($id_produit)) {
            $save = $pdo->prepare("UPDATE produit SET id_produit = :id_produit, id_salle = :id_salle, date_arrivee = :date_arrivee, date_depart = :date_depart, prix = :prix, etat = :etat WHERE id_produit = :id_produit");
            $save->bindParam(":id_produit", $id_produit, PDO::PARAM_INT);
        } else {
            $id_produit = '';
            $save = $pdo->prepare("INSERT INTO produit (id_produit, id_salle, date_arrivee, date_depart, prix, etat)
VALUES (:id_produit, :id_salle, :date_arrivee, :date_depart, :prix, :etat)");
            $save->bindParam(":id_produit", $id_produit, PDO::PARAM_INT);
        }
        $save->bindParam(":id_salle", $id_salle, PDO::PARAM_INT);
        $save->bindParam(":date_arrivee", $date_arrivee, PDO::PARAM_STR);
        $save->bindParam(":date_depart", $date_depart, PDO::PARAM_STR);
        $save->bindParam(":prix", $prix, PDO::PARAM_INT);
        $save->bindParam(":etat", $etat, PDO::PARAM_STR);
        $save->execute();
    }
    $_GET['action'] = 'affichage';
}
//*********************************************************************
// \FIN ENREGISTREMENT DES ARTICLES
//*********************************************************************

//*********************************************************************
// MODIFICATION : RECUPERATION DES INFOS DE L'ARTICLE EN BDD
//*********************************************************************

if (isset($_GET['action']) && $_GET['action'] == 'edit' && !empty($_GET['id_produit'])) {

    $infos_produit = $pdo->prepare("SELECT * FROM produit WHERE id_produit = :id_produit");
    $infos_produit->bindParam(":id_produit", $_GET['id_produit'], PDO::PARAM_INT);
    $infos_produit->execute();

    if ($infos_produit->rowCount() > 0) {
        $pdt_actuel = $infos_produit->fetch(PDO::FETCH_ASSOC);

        $id_produit = $pdt_actuel['id_produit'];
        $date_arrivee = $pdt_actuel['date_arrivee'];
        $date_depart = $pdt_actuel['date_depart'];
        $id_salle = $pdt_actuel['id_salle'];
        $prix = $pdt_actuel['prix'];
        $etat = $pdt_actuel['etat'];
    }
}


//***************************
// AFFICHAGE DES ARTICLES
//***************************
?>

<?php $title = 'Gestion produits';?>
    <div class="starter-template">
        <h1><i class="fas fa-ghost" style="color: #4c6ef5;"></i> Gestion produit <i class="fas fa-ghost"
                                                                                    style="color: #4c6ef5;"></i></h1>
        <p class="lead"><?php echo $msg; ?></p>

        <p class="text-center">
            <a href="?action=add" class="btn btn-outline-danger">Ajout produit</a>
            <a href="?action=affichage" class="btn btn-outline-primary">Affichage produit</a>
        </p>

    </div>

<?php

if (isset($_GET['action']) && $_GET['action'] == 'affichage') {
// on récupère les produits en bdd


    $liste_produit = $pdo->query("SELECT * FROM produit");

    echo '<p>Nombre d\'articles : <b>' . $liste_produit->rowCount() . '</b></p>';

    echo '<div class="table-responsive">';
    echo '<table class="table table-bordered">';
    echo '<tr>';
    echo '<th>id produit</th>';
    echo '<th>date d\'arrivee</th>';
    echo '<th>date de départ</th>';
    echo '<th>id salle</th>';
    echo '<th>prix</th>';
    echo '<th>etat</th>';
    echo '<th>Modif</th>';
    echo '<th>Suppr</th>';
    echo '</tr>';

    while ($produit = $liste_produit->fetch(PDO::FETCH_ASSOC)) {
        echo '<tr>';
        echo '<td>' . $produit['id_produit'] . '</td>';
        echo '<td>' . $produit['date_arrivee'] . '</td>';
        echo '<td>' . $produit['date_depart'] . '</td>';

        $infos_salle = $pdo->prepare("SELECT * FROM salle WHERE id_salle = :id_salle");
        $infos_salle->bindParam(":id_salle", $produit['id_salle'], PDO::PARAM_INT);
        $infos_salle->execute();
        if ($infos_salle->rowCount() > 0) {
            $salle_actuelle = $infos_salle->fetch(PDO::FETCH_ASSOC);
            echo '<td>' . $salle_actuelle['id_salle'] . ' - ' . $salle_actuelle['titre'] . ' <br> 
<img src="../img/' . $salle_actuelle['photo'] . '" class="img-thumbnail" width="140"></td>';
        }

        echo '<td>' . $produit['prix'] . '</td>';
        echo '<td>' . $produit['etat'] . '</td>';

        echo '<td><a href="?action=edit&id_produit=' . $produit['id_produit'] . '" class="btn btn-warning"><i class="fas fa-edit"></i></a></td>';

        echo '<td><a href="?action=supprimer&id_produit=' . $produit['id_produit'] . '" class="btn btn-danger" onclick="return(confirm(\'Etes-vous sûr ?\'))"><i class="fas fa-trash-alt"></i></a></td>';

        echo '</tr>';
    }

    echo '</table>';
    echo '</div>';
}
//***************************
// FIN AFFICHAGE DES PRODUITS
//***************************

?>

    <form method="post" action="" enctype="multipart/form-data">
        <input type="hidden" name="id_produit" value="<?php echo $id_produit; ?>">
        <label for="date_arrivee">Date d'arrivée</label><br>
        <input type="datetime-local" name="date_arrivee" id="date_arrivee"
               value="<?php echo str_replace(' ', 'T', $date_arrivee); ?>">
        <hr>

        <label for="date_depart">Date de départ</label><br>
        <input type="datetime-local" name="date_depart" id="date_depart"
               value="<?php echo str_replace(' ', 'T', $date_depart); ?>"><br>
        <hr>

        <label for="select-salle">Salle</label>
        <select name="id_salle" id="select-salle">

            <?php


            if (!empty($id_produit)) {
                $infos_salle = $pdo->prepare("SELECT * FROM salle WHERE id_salle = :id_salle");
                $infos_salle->bindParam(":id_salle", $id_salle, PDO::PARAM_INT);
                $infos_salle->execute();

                if ($infos_salle->rowCount() > 0) {
                    $salle_actuelle = $infos_salle->fetch(PDO::FETCH_ASSOC);
                    echo '<option value = ' . $salle_actuelle['id_salle'] . ' selected>
                ' . $salle_actuelle['id_salle'] . ' 
                - ' . $salle_actuelle['titre'] . ' 
                - ' . $salle_actuelle['adresse'] . ', ' . $salle_actuelle['cp'] . ', ' . $salle_actuelle['ville'] . '
                - ' . $salle_actuelle['capacite'] . '
                                </option>';
                }
            }
            // get all the salle rows from database
            $liste_salle = $pdo->query("SELECT * FROM salle");
            // use the data to populate the <select>
            while ($salle = $liste_salle->fetch(PDO::FETCH_ASSOC)) {

                echo '<option value = ' . $salle['id_salle'] . '>
                ' . $salle['id_salle'] . ' 
                - ' . $salle['titre'] . ' 
                - ' . $salle['adresse'] . ', ' . $salle['cp'] . ', ' . $salle['ville'] . '
                - ' . $salle['capacite'] . '
                </option>';
            }

            ?>
        </select>
        <hr>

        <label for="prix">Tarif</label>
        <input type="number" id="prix" name="prix" value="<?php echo $prix ?>">
        <hr>

        <?php
        $display = (!empty($id_produit)) ? 'block' : 'none';
        $libre = "";
        if ((!empty($id_produit) && $etat == 'libre') || (empty($id_produit))) {
            $libre = 'selected';
        }
        $reservation = (!empty($id_produit) && $etat == 'reservation') ? 'selected' : '';
        echo
            '<label for="etat" style="display: ' . $display . '">Etat</label>
        <select name="etat" id="etat" style="display: ' . $display . '">
            <option value="1" ' . $libre . '>libre</option>
            <option value="2" ' . $reservation . '>reservation</option>
        </select>'
        ?>
        <button type="submit" class="form-control btn btn-outline-dark"> Enregistrer</button>
    </form>