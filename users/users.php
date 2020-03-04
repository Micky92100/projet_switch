<?php
include '../inc/init.inc.php';
include '../inc/function.inc.php';

include '../inc/nav.inc.php';
?>
<br>
<br>
<?php
// if(!user_is_admin()) {
// 	header('location:' . URL . 'login.php');
// 	exit(); // bloque l'exécution du code 
// }
var_dump($_POST);
//Affichage des membres et modif/suppr*****************************
$liste_membre = $pdo->query("SELECT *  FROM membre");

//*********************************************************************
//*********************************************************************
// SUPPRESSION D'UN ARTICLE
//*********************************************************************
//*********************************************************************





if (isset($_GET['action']) && $_GET['action'] == 'supprimer' && !empty($_GET['id_membre'])) {
    $suppression = $pdo->prepare("DELETE FROM membre WHERE id_membre = :id_membre");
    $suppression->bindParam(":id_membre", $_GET['id_membre'], PDO::PARAM_STR);
    $suppression->execute();

    $msg .= '<div class="validation bg-success">Suppression de membre : ' . $_GET['id_membre'] . '</div>';


    $_GET['action'] = 'affichage'; // pour provoquer l'affichage du tableau
}
//*********************************************************************
//*********************************************************************
// \FIN SUPPRESSION D'UN MEMBRE
//*********************************************************************
//*********************************************************************

$id_membre = '';    // pour la modification
$pseudo = "";
$mdp = "";
$nom = "";
$prenom = "";
$email = "";
$civilite = "";
$statut = "";



//*********************************************************************
//*********************************************************************
// ENREGISTREMENT & MODIFICATION DES ARTICLES
//*********************************************************************
//***

if (
    isset($_POST['id_membre']) &&
    isset($_POST['pseudo']) &&
    isset($_POST['mdp']) &&
    isset($_POST['nom']) &&
    isset($_POST['prenom']) &&
    isset($_POST['email']) &&
    isset($_POST['civilite'])&&
    isset($_POST['statut'])

) {

    $id_membre = trim($_POST['id_membre']);
    $pseudo = trim($_POST['pseudo']);
    $mdp = trim($_POST['mdp']);
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $email = trim($_POST['email']);
    $civilite = trim($_POST['civilite']);
    $statut = intval($_POST['statut']);

    // on bloque certains caractères pour le champ pseudo via une expression régulière (regex). On autorise uniquement a-z A-Z 0-9 -._ 
    $verif_caractere = preg_match('#^[a-zA-Z0-9._-]+$#', $pseudo);
    /*
		preg_match() est une fonction prédéfinie permettant de vérifier une chaine fournie en deuxième argument selon une expression régulière fournie en premier argument. Renvoie 1 si c'est ok sinon 0
		
		- les # indiquent le début et la fin de l'expression régluière
		- Entre les [] se trouvent tous les caractères autorisés.
		- ^ indique que le début de la chaine ne peut pas commencer par un autre caractère que ceux présent dans les []
		- $ indique que la fin de la chaine ne peut pas finir par un autre caractère que ceux présent dans les []
		- Le + permet d'indiquer que les caractères peuvent être présent plusieurs fois.		
		
		*/

    // controle sur la id membre car elle est unique en BDD
    $verif_reference = $pdo->prepare("SELECT * FROM membre WHERE id_membre = :id_membre");
    $verif_reference->bindParam(':id_membre', $id_membre, PDO::PARAM_STR);
    $verif_reference->execute();


    if (!$verif_caractere && !empty($pseudo)) {
        // cas d'erreur
        $msg .= '<div class="alert alert-danger mt-3">Pseudo invalide, caractères autorisés : a-z et de 0-9</div>';
    }

    // vérifier la taille du pseudo => message d'erreur si le pseudo n'est pas entre 4 et 14 caractères inclus.
    if (iconv_strlen($pseudo) < 4 || iconv_strlen($pseudo) > 14) {
        // cas d'erreur
        $msg .= '<div class="alert alert-danger mt-3">Pseudo invalide, le pseudo doit avoir entre 4 et 14 caractères inclus</div>';
    }

    // mettre en place un controle sur la validité du format de l'email


    // s'il n'y pas eu d'erreur au préalable, on doit vérifier si le pseudo existe déjà dans la BDD
    if (empty($msg)) {
        // si la variable $msg est vide, alors il n'y a pas eu d'erreur dans nos controles.

        // on vérifie si le pseudo est disponible.
        $verif_pseudo = $pdo->prepare("SELECT * FROM membre WHERE pseudo = :pseudo");
        $verif_pseudo->bindParam(":pseudo", $pseudo, PDO::PARAM_STR);
        $verif_pseudo->execute();

        if ($verif_pseudo->rowCount() > 0) {
            // si le nombre de ligne est supérieur à zéro, alors le pseudo est déjà utilisé.
            $msg .= '<div class="alert alert-danger mt-3">Pseudo indisponible !</div>';
        } else {
            // insert into
            // cryptage du mot de passe pour l'insertion en BDD
            $mdp = password_hash($mdp, PASSWORD_DEFAULT);
        }
        // mettre en place un controle sur la validité du format de l'email


        // si on a une ligne, alors la reference existe en bdd
        // on ne vérifie la référence que lors d'un ajout. Si $id_membre est vide alors c'est un ajout sinon c'est une modif.
        if ($verif_reference->rowCount() > 0 && empty($id_membre)) {
            $msg .= '<div class="alert alert-danger mt-3">Attention, référence indisponible car déjà attribuée.</div>';
        } //else {
        if (empty($msg)) {
            echo 'IF EMPTY MESSAGE <br>';
            if (!empty($id_membre)) {
                echo 'IF EMPTY ID membre <br>';
                // si $id_membre n'est pas vide c'est un UPDATE
                $enregistrement = $pdo->prepare("UPDATE membre SET pseudo = :pseudo, mdp = :mdp, nom = :nom, prenom = :prenom, email = :email, civilite = :civilite, statut = :statut WHERE id_membre = :id_membre");
                // on rajoute le bindParam pour l'id_membre car => modification
                $enregistrement->bindParam(":id_membre", $id_membre, PDO::PARAM_STR);
            } else {
                echo 'IF EMPTY ID membre INSERT <br>';
                // sinon un INSERT
                $enregistrement = $pdo->prepare("INSERT INTO membre
             (pseudo, mdp, nom, prenom, email, civilite, statut, date_enregistrement) 
            VALUES (:pseudo, :mdp, :nom, :prenom, :email, :civilite, :statut, :date_enregistrement)");
            }
            $date = date('Y-m-d H:i:s');

            $enregistrement->bindParam(":pseudo", $pseudo, PDO::PARAM_STR);
            $enregistrement->bindParam(":mdp", $mdp, PDO::PARAM_STR);
            $enregistrement->bindParam(":nom", $nom, PDO::PARAM_STR);
            $enregistrement->bindParam(":prenom", $prenom, PDO::PARAM_STR);
            $enregistrement->bindParam(":email", $email, PDO::PARAM_STR);
            $enregistrement->bindParam(":civilite", $civilite, PDO::PARAM_STR);
            $enregistrement->bindParam(":statut", $statut, PDO::PARAM_STR);
            $enregistrement->bindParam(":date_enregistrement", $date, PDO::PARAM_STR);
            $enregistrement->execute();
        }
    }
}
//*********************************************************************
//*********************************************************************
// \FIN ENREGISTREMENT DES ARTICLES
//*********************************************************************
//*********************************************************************


//*********************************************************************
//*********************************************************************
// MODIFICATION : RECUPERATION DES INFOS DE L'ARTICLE EN BDD
//*********************************************************************
//*********************************************************************
if (isset($_GET['action']) && $_GET['action'] == 'modifier' && !empty($_GET['id_membre'])) {

    $infos_membre = $pdo->prepare("SELECT * FROM membre WHERE id_membre = :id_membre");
    $infos_membre->bindparam(":id_membre", $_GET['id_membre'], PDO::PARAM_STR);
    $infos_membre->execute();

    if ($infos_membre->rowCount() > 0) {
        $membre_actuel = $infos_membre->fetch(PDO::FETCH_ASSOC);

        $id_membre = $membre_actuel['id_membre'];
        $pseudo = $membre_actuel['pseudo'];
        $mdp = $membre_actuel['mdp'];
        $nom = $membre_actuel['nom'];
        $prenom = $membre_actuel['prenom'];
        $email = $membre_actuel['email'];
        $civilite = $membre_actuel['civilite'];
        $statut = $membre_actuel['statut'];
    }
}





?>

<div class="starter-template">
    <div class="row">
        <div class="col-12">
            <form method="post" action="" enctype="multipart/form-data">
                <!-- récupération de l'id_article pour la modification -->
                <input type="hidden" name="id_membre" value="">

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
                            <label for="civilite">Civilité</label>
                            <select name="civilite" id="civilite" class="form-control">
                                <option value="m">Homme</option>
                                <option value="f" <?php if ($civilite == 'f') {
                                                        echo 'selected';
                                                    } ?>>Femme</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="statut">statut</label>
                            <input type="number" name="statut" id="statut" class="form-control">
                        </div>
                       
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
include '../inc/footer.inc.php'
?>