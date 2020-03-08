<?php
// if(!user_is_admin()) {
// 	header('location:' . URL . 'loginView.php');
// 	exit(); // bloque l'exécution du code 
// }
?>
<?php $title = 'Gestion de commande'; ?>
<?php ob_start(); ?>
<!--****************************-->
<!-- DEBUT AFFICHAGE COMMANDES-->
<!--****************************-->

<?php if (!empty($orders_list)) {
    echo '<p>Nombre d\'articles : <b>' . $orders_list->rowCount() . '</b></p>';
} ?>
<div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <th>Id commande</th>
            <th>Id membre</th>
            <th>Id produit</th>
            <th>Prix</th>
            <th>date enregistrement</th>
            <th>Action</th>
        </tr>
        <?php
        while ($commande = $orders_list->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr>';
            echo '<td>' . $commande['id_commande'] . '</td>';
            echo '<td>' . $commande['id_membre'] . ' - ' . $commande['email'] . '</td>';
            echo '<td>' . $commande['id_produit'] . ' - ' . $commande['titre'] . '<br/>' . $commande['date_arrivee'] . ' au ' . $commande['date_depart'] .'</td>';
            echo '<td>' . $commande['prix'] .'€</td>';
            echo '<td>' . $commande['date_enregistrement'] . '</td>';
            echo '<td><a href="?action=deleteOrder&order-id=' . $commande['id_commande'] . '" class="btn btn-danger" onclick="return(confirm(\'Etes-vous sûr ?\'))"><i class="fas fa-trash-alt"></i></a></td>';
            echo '</tr>';
        }
        ?>
    </table>
</div>
<?php $content = ob_get_clean(); ?>
<?php require('view/template/template.php'); ?>


<!-- // if (isset($_GET['action']) && $_GET['action'] == 'affichage') {
//     // on récupère les produits en bdd
//     $liste_commandes = $pdo->query("SELECT * FROM commande");

//     echo '<p>Nombre de commandes : <b>' . $liste_commandes->rowCount() . '</b></p>';

//     echo '<div class="table-responsive">';
//     echo '<table class="table table-bordered">';
//     echo '<tr>';
//     echo '<th>id commande</th>';
//     echo '<th>id membre</th>';
//     echo '<th>id produit</th>';
//     echo '<th>prix</th>';
//     echo '<th>date enregistrement</th>';
//     echo '<th>Suppr</th>';
//     echo '</tr>';

//  if (!empty($orders_list)) {
//     echo '<p>Nombre de commandes : <b>' . $orders_list->rowCount() . '</b></p>';
// }  -->



</div>
<!--**************************-->
<!-- FIN AFFICHAGE DES COMMANDES -->
<!--**************************-->
<!-- SUPPRESSION D'UNE COMMANDE -->
<?php
// if (isset($_GET['action']) && $_GET['action'] == 'supprimer' && !empty($_GET['id_commande'])) {
//     $del = $pdo->prepare("DELETE FROM commande WHERE id_commande = :id_commande");
//     $del->bindParam(":id_commande", $_GET['id_commande'], PDO::PARAM_INT);
//     $del->execute();

//     $msg = '<div class="validation bg-success">Suppression du produit : ' . $_GET['id_commande'] . '</div>';
//     $_GET['action'] = 'affichage';
// }
//FIN SUPPRESSION D'UNE COMMANDE

// $id_commande = "";
// $id_membre = "";
// $id_produit ="";
// $prix ="";
// $date_enregistrement="";

//*********************************************************************
// MODIFICATION : RECUPERATION DES INFOS DE L'ARTICLE EN BDD
//*********************************************************************

// if (isset($_GET['action']) && $_GET['action'] == 'edit' && !empty($_GET['id_commande'])) {

//     $infos_commande = $pdo->prepare("SELECT * FROM commande WHERE id_commande = :id_commande");
//     $infos_commande->bindParam(":id_produit", $_GET['id_produit'], PDO::PARAM_INT);
//     $infos_commande->execute();

//     if ($infos_commande->rowCount() > 0) {
//         $pdt_actuel = $infos_commande->fetch(PDO::FETCH_ASSOC);

//         $id_commande = $pdt_actuel['id_commande'];
//         $id_membre = $pdt_actuel['id_membre'];
//         $id_produit = $pdt_actuel['id_produit'];
//         $prix = $pdt_actuel['prix'];
//         $date_enregistrement = $pdt_actuel['date_enregistrement'];
//     }
// }
