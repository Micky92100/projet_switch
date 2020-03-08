<?php $title = 'S\'enregistrer' ?>

<?php ob_start(); 
$pseudo = '';
$mdp = '';
?>
<p>INSERT CONTENT HERE</p>

<div class="starter-template">
    <div class="row">
        <div class="col-6 mx-auto" style="width: 400px;">
            <form method="post" action="" enctype="multipart/form-data">
                <!-- récupération de l'id_article pour la modification -->
                <input type="hidden" name="id_article" value="">

                <div class="row">
                    <div class="col-6 mx-auto" style="width: 400px;">
                        <h2>Se connecter</h2>

                        <div class="form-group">
                            <label for="pseudo">Pseudo</label>
                            <input type="text" name="pseudo" id="pseudo" value="<?php echo $pseudo; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="mdp">Mot de passe</label>
                            <input type="text" autocomplete="off" name="mdp" id="mdp" value="" class="form-control">
                        </div>
                        <?php
                     
                        ?>
                        <div class="form-group">
                            <button type="submit" name="enregistrement" id="enregistrement" class="form-control btn btn-outline-dark"> Enregistrer</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php require('view/template/template.php'); ?>