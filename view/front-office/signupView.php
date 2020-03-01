<?php


// si l'utilisateur est connecté, on le renvoie sur la page profil
// if(user_is_connect()) {
// 	header('location:profileView.php');
// }
//var_dump($_POST);

$pseudo = '';
$mdp = '';
$prenom = '';
$nom = '';
$email = '';
$civilite = '';


?>

<div class="row">
    <div class="col-12">
        <form method="post" action="?action=signup"><!--TODO fill out action-->
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="pseudo">Pseudo</label>
                        <input type="text" name="pseudo" id="pseudo" value="<?php echo $pseudo; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="mdp">Mot de passe</label>
                        <input type="text" name="mdp" id="mdp" value="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" name="nom" id="nom" value="<?php echo $nom; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prénom</label>
                        <input type="text" name="prenom" id="prenom" value="<?php echo $prenom; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" value="<?php echo $email; ?>" class="form-control">
                    </div>

                </div>
                <div class="col-6">

                    <div class="form-group">
                        <label for="civilite">Sexe</label>
                        <select name="civilite" id="civilite" class="form-control">
                            <option value="m">Homme</option>
                            <option value="f" <?php if ($civilite == 'f') {
                                                    echo 'selected';
                                                } ?>>Femme</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="inscription" id="inscription" class="form-control btn btn-outline-primary"> S'inscrire</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>