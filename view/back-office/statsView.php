<?php $title = 'Statistiques'; ?>

<?php ob_start(); ?>

    <h2>Top 5 des salles les mieux notées</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th>Id salle</th>
                <th>Titre</th>
                <th>Note moyenne</th>
            </tr>
            <?php
            if (!empty($room_rating)) {
                while ($avis = $room_rating->fetch(PDO::FETCH_ASSOC)) {
                    echo '<tr>';
                    echo '<td>' . $avis['id_salle'] . '</td>';
                    echo '<td>' . $avis['titre'] . '</td>';
                    echo '<td>' . $avis['rating'] . '/5</td>';
                    echo '</tr>';
                }
            }
            ?>
        </table>
    </div>

    <h2>Top 5 des salles les plus réservées</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th>Id salle</th>
                <th>Titre</th>
                <th>Nombre de réservations</th>
            </tr>
            <?php
            if (!empty($room_times_ordered)) {
                while ($avis = $room_times_ordered->fetch(PDO::FETCH_ASSOC)) {
                    echo '<tr>';
                    echo '<td>' . $avis['id_salle'] . '</td>';
                    echo '<td>' . $avis['titre'] . '</td>';
                    echo '<td>' . $avis['times_ordered'] . '</td>';
                    echo '</tr>';
                }
            }
            ?>
        </table>
    </div>

    <h2>Top 5 des membres ayant réservé le plus de salles</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th>Id membre</th>
                <th>Pseudo</th>
                <th>Nombre de réservations</th>
            </tr>
            <?php
            if (!empty($user_purchases)) {
                while ($avis = $user_purchases->fetch(PDO::FETCH_ASSOC)) {
                    echo '<tr>';
                    echo '<td>' . $avis['id_membre'] . '</td>';
                    echo '<td>' . $avis['pseudo'] . '</td>';
                    echo '<td>' . $avis['times_purchased'] . '</td>';
                    echo '</tr>';
                }
            }
            ?>
        </table>
    </div>

    <h2>Top 5 des membres ayant dépensé le plus d'argent</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th>Id membre</th>
                <th>Pseudo</th>
                <th>Somme dépensée</th>
            </tr>
            <?php
            if (!empty($user_value)) {
                while ($avis = $user_value->fetch(PDO::FETCH_ASSOC)) {
                    echo '<tr>';
                    echo '<td>' . $avis['id_membre'] . '</td>';
                    echo '<td>' . $avis['pseudo'] . '</td>';
                    echo '<td>' . number_format($avis['amount_spent'], 2, ',', ' '). '€</td>';
                    echo '</tr>';
                }
            }
            ?>
        </table>
    </div>
<?php $content = ob_get_clean(); ?>


<?php
if (!user_is_admin()) {
    $title = 'Accès interdit';
    $content = '<h1>Vers l\'<a href="?action=listProductsIndex">accueil</a></h1>';
}
?>

<?php require('view/template/template.php'); ?>