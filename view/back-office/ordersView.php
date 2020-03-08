<?php
// if(!user_is_admin()) {
// 	header('location:' . URL . 'loginView.php');
// 	exit(); // bloque l'exécution du code 
// }
?>
<?php $title = 'Liste des membre';?>

<?php ob_start(); ?>


    <!--****************************-->
    <!-- DEBUT AFFICHAGE DES MEMBRES -->
    <!--****************************-->



<?php if (!empty($members_list)) {
    echo '<p>Nombre de membre : <b>' . $members_list->rowCount() . '</b></p>';
} ?>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
<table class="table table-bordered" style="color:grey">
    <thead>
        <tr>
            <th>id_commande</th>
            <th>id_membre</th>
            <th>id_produit</th>
            <th>prix</th>
            <th>date_enregistrement</th>
            <th>actions</th>
        </tr>
        <?php
            while ($member = $members_list->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr>';
                echo '<td>' . $member['id_commande'] . '</td>';
                echo '<td>' . $member['id_membre'] . '</td>';
                echo '<td>' . $member['prix'] . '</td>';
                echo '<td>' . $member['date_enregistrement'] . '</td>';
                echo '<td><a href="?action=editRoom&room-id=' . $member['id_commande'] . '" class="btn btn-warning"><i class="fas fa-edit"></i></a></td>';
                echo '<td><a href="?action=deleteRoom&room-id=' . $membre['id_commande'] . '" class="btn btn-danger" onclick="return(confirm(\'Etes-vous sûr ?\'))"><i class="fas fa-trash-alt"></i></a></td>';
                echo '</tr>';
            }
            ?>
</table>
        </div>
           <!--**************************-->
            <!-- FIN AFFICHAGE DES MEMBRES -->
             <!--**************************-->
             <?php $content = ob_get_clean(); ?>

<?php require('view/template/template.php'); ?>