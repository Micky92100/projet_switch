<?php $title = 'S\'enregistrer' ?>


    <!-- // si l'utilisateur est connecté, on le renvoie sur la page profil
    // if(user_is_connect()) {
    // header('location:profileView.php');
    // }
    //var_dump($_POST); -->
<?php ob_start();
$pseudo = '';
$mdp = '';
$prenom = '';
$nom = '';
$email = '';
$civilite = '';
?>

    <div class="starter-template">
        <div class="row">
            <div class="col-6 mx-auto" style="width: 400px;">
                <form method="post" id="form" action="?action=signup">
                    <!--TODO fill out action-->
                    <div class="row">
                        <div class="col-6 mx-auto" style="width: 400px;">
                            <h2>S'inscrire</h2>

                            <div class="form-group">
                                <label for="pseudo">Pseudo</label>
                                <input type="text" name="pseudo" id="pseudo" value="<?php echo $pseudo; ?>"
                                       class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="mdp">Mot de passe</label>
                                <input type="password" name="mdp" id="mdp" value="" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="nom">Nom</label>
                                <input type="text" name="nom" id="nom" value="<?php echo $nom; ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="prenom">Prénom</label>
                                <input type="text" name="prenom" id="prenom" value="<?php echo $prenom; ?>"
                                       class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" value="<?php echo $email; ?>"
                                       class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="civilite">Sexe</label>
                                <select name="civilite" id="civilite" class="form-control">
                                    <option value="m"<?php if ($civilite == 'm') {
                                        echo 'selected';
                                    } ?>>Homme
                                    </option>
                                    <option value="f" <?php if ($civilite == 'f') {
                                        echo 'selected';
                                    } ?>>Femme
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-outline-primary"> S'inscrire
                                </button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $content = ob_get_clean(); ?>
<?php require('view/template/template.php'); ?>