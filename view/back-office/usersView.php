<?php $title = 'Gestion des membres' ?>


<?php ob_start();
//$pseudo = '';
//$mdp = '';
//$nom = '';
//$prenom = '';
//$email = '';
//$civilite = '';
//$statut = '';
?>
<!--TODO come back and make listing of users here (example rooms)-->
<?php if (!empty($users_list)) {
    echo '<p>Nombre de membres : <b>' . $users_list->rowCount() . '</b></p>';
} ?>
<div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <th>Id membre</th>
            <th>pseudo</th>
            <th>nom</th>
            <th>prenom</th>
            <th>email</th>
            <th>civilite</th>
            <th>statut</th>
            <th>date_enregistrement</th>
            <th>Modif</th>
            <th>Suppr</th>
        </tr>
        <?php
        while ($user = $users_list->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr>';
            echo '<td>' . $user['id_membre'] . '</td>';
            echo '<td>' . $user['pseudo'] . '</td>';
            echo '<td>' . $user['nom'] . '</td>';
            echo '<td>' . $user['prenom'] . '</td>';

            echo '<td>' . $user['email'] . '</td>';
            echo '<td>' . $user['civilite'] . '</td>';
            echo '<td>' . $user['statut'] . '</td>';
            echo '<td>' . $user['date_enregistrement'] . '</td>';

            echo '<td><a href="?action=editUser&user-id=' . $user['id_membre'] . '" class="btn btn-warning"><i class="fas fa-edit"></i></a></td>';
            echo '<td><a href="?action=deleteRoom&room-id=' . $user['id_membre'] . '" class="btn btn-danger" onclick="return(confirm(\'Etes-vous sûr ?\'))"><i class="fas fa-trash-alt"></i></a></td>';
            echo '</tr>';
        }
        ?>
    </table>
</div>
<!--**************************-->
<!-- FIN AFFICHAGE DES MEMBRES -->
<!--**************************-->
<?php
$user_id = '';
$id_membre = '';
$pseudo = '';
$nom = '';
$prenom = '';
$email = '';
$civilite = '';
$statut = '';
$date_enregistrement = '';

if (!empty($current_user)) {
    $user_id = $current_user['id_salle'];
    $id_membre = $current_user['id_membre'];
    $pseudo = $current_user['pseudo'];
    $nom = $current_user['nom'];
    $prenom = $current_user['prenom'];
    $email = $current_user['email'];
    $civilite = $current_user['civilite'];
    $status = $current_user['status'];
    $date_enregistrement = $current_user['date_enregistrement'];
}
?>

<!--******************-->
<!-- DEBUT FORMULAIRE -->
<!--******************-->


<div class="starter-template">
    <div class="row">
        <div class="col-12">
            <form method="post" action="?action=editUser&amp;user-id=<?= $user_id ?>" enctype="multipart/form-data">
                <!-- récupération de l'id_article pour la modification -->
                <input type="hidden" name="id_article" value="<?php echo $user_id ?>">

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="pseudo">Pseudo</label>
                            <input type="text" name="pseudo" id="pseudo" value="<?php echo $pseudo ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="mdp">Mot de passe</label>
                            <input type="text" autocomplete="off" name="mdp" id="mdp" value="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="nom">Nom</label>
                            <input type="text" name="nom" id="nom" value="<?php echo $nom ?>" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="prenom">Prenom</label>
                            <input type="text" name="prenom" id="prenom" value="<?php echo $nom ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-6">

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email" value="<?php echo $email ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="civilite">Civilité</label>
                            <select name="civilite" id="civilite" class="form-control">
                                <option <?php if ($civilite == 'Homme') {
                                            echo 'selected';
                                        } ?>>Homme</option>
                                <option <?php if ($civilite == 'Femme') {
                                            echo 'selected';
                                        } ?>>Femme</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status">Statut</label>
                            <select name="status" id="status" class="form-control">
                           <option <?php 
							if($_SESSION['membre']['statut'] == 1) {
                                echo 'membre';
                            } ?>>membre</option>

							 <option <?php if($_SESSION['membre']['statut'] == 2) {
								echo 'administrateur';
							} ?>>administrateur</option>
                            </select>
                        </div>
                        <?php
                        ?>
                        <div class="form-group">
                            <button type="submit" name="enregistrement" id="enregistrement" class="form-control btn btn-outline-dark"> Enregistrer </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php require('view/template/template.php'); ?>