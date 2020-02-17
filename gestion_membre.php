<?php
include 'inc/init.inc.php';
include 'inc/fonction.inc.php';

include 'inc/header.inc.php';
include 'inc/nav.inc.php';
?>

<table class="table table-bordered" style="color:grey">
    <thead>
        <tr>
            <th scope="col">id_membre</th>
            <th scope="col">pseudo</th>
            <th scope="col">nom</th>
            <th scope="col">prenom</th>
            <th scope="col">email</th>
            <th scope="col">civilite</th>
            <th scope="col">statut</th>
            <th scope="col">date_enregistrement</th>
            <th scope="col">actions</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
            <td>Mark</td>
            <td>Otto</td>
        </tr>
        <tr>
            <th scope="row">2</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
            <td>Mark</td>
            <td>Otto</td>
        </tr>
        <tr>
            <th scope="row">3</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
            <td>Mark</td>
            <td>Otto</td>

        </tr>
    </tbody>
</table>






<div class="starter-template">
    <div class="row">
        <div class="col-12">
            <form method="post" action="" enctype="multipart/form-data">
                <!-- récupération de l'id_article pour la modification -->
                <input type="hidden" name="id_article" value="">

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="pseudo">Pseudo</label>
                            <input type="text" name="pseudo" id="pseudo" value="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="mdp">Mot de passe</label>
                            <input type="text" autocomplete="off" name="mdp" id="mdp" value="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="nom">Nom</label>
                            <input type="text" name="nom" id="nom" value="" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="prenom">Prenom</label>
                            <input type="text" name="prenom" id="prenom" value="" class="form-control">
                        </div>
                    </div>
                    <div class="col-6">

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email" value="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="civilite">Civilité</label>
                            <select name="civilite" id="civilite" class="form-control">
                                <option>Homme</option>
                                <option>Femme</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status">Statut</label>
                            <select name="status" id="status" class="form-control">
                                <option>admin</option>
                                <option>client</option>
                            </select>
                        </div>
                        <?php
                        // récupération de la photo de l'article en cas de modification. Pour la consever si l'utilisateur n'en charge pas une nouvelle
                        // if(!empty($photo_actuelle)) {
                        // 	echo '<div class="form-group text-center">';
                        // 	echo '<label>Photo actuelle</label><hr>';
                        // 	echo '<img src="' . URL . 'img/' . $photo_actuelle . '" class="w-25 img-thumbnail" alt="image de l\'article">';
                        // 	echo '<input type="hidden" name="photo_actuelle" value="' . $photo_actuelle . '">';
                        // 	echo '</div>';
                        // }
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
<?php
include 'inc/footer.inc.php'
?>