<?php


// restriction d'accès, si l'utilisateur n'est pas connecté, on le renvoie sur login.php
// if(!user_is_connect()) {
// 	header('location:login.php');
// }


?>

    <div class="starter-template">
        <h1>Profil</h1>
        <p class="lead"><?php echo $msg; ?></p>
    </div>

    <ul class="list-group">
        <li class="list-group-item active">Bonjour <b><?php echo ucfirst($_SESSION['membre']['pseudo']); ?></b></li>
        <li class="list-group-item">Pseudo : <b><?php echo ucfirst($_SESSION['membre']['pseudo']); ?></b></li>
        <li class="list-group-item">Nom : <b><?php echo ucfirst($_SESSION['membre']['nom']); ?></b></li>
        <li class="list-group-item">Prénom : <b><?php echo ucfirst($_SESSION['membre']['prenom']); ?></b></li>
        <li class="list-group-item">Email : <b><?php echo $_SESSION['membre']['email']; ?></b></li>
        <li class="list-group-item">Sexe : <b>
                <?php
                if ($_SESSION['membre']['civilite'] == 'm') {
                    echo 'Homme';
                } else {
                    echo 'Femme';
                }
                ?></b>
        </li>
        <li class="list-group-item">Ville : <b><?php echo ucfirst($_SESSION['membre']['ville']); ?></b></li>
        <li class="list-group-item">Code postal : <b><?php echo $_SESSION['membre']['cp']; ?></b></li>
        <li class="list-group-item">Adresse : <b><?php echo ucfirst($_SESSION['membre']['adresse']); ?></b></li>
        <li class="list-group-item">Statut : <b>
                <?php
                if ($_SESSION['membre']['statut'] == 1) {
                    echo 'membre';
                } elseif ($_SESSION['membre']['statut'] == 2) {
                    echo 'administrateur';
                }
                ?>
            </b></li>
    </ul>


<?php
