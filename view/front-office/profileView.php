<?php $title = 'Profil'; ?>

<?php ob_start(); ?>
<?php
$pseudo = $_SESSION['membre']['pseudo'];
?>

<p>Bonjour <?php echo $pseudo; ?></p>
<p>Récapitulatif des commandes : </p>

<table class="table table-bordered">
    <tr>
        <th>Id commande</th>
        <th>Id produit</th>
        <th>Prix</th>
        <th>Date enregistrement</th>
    </tr>
    <?php
    if (!empty($profile_details)) {
        while ($commande = $profile_details->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr>';
            echo '<td>' . $commande['id_commande'] . '</td>';
            echo '<td>' . $commande['id_produit'] . ' - ' . $commande['titre'] . '<br/>' . $commande['date_arrivee'] . ' au ' . $commande['date_depart'] . '</td>';
            echo '<td>' . $commande['prix'] . '€</td>';
            echo '<td>' . $commande['date_enregistrement'] . '</td>';
            echo '</tr>';
        }
    }
    ?>
</table>

<?php $content = ob_get_clean(); ?>
<?php require('view/template/template.php'); ?>
