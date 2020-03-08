<?php $title = 'S\'enregistrer' ?>

<?php ob_start(); 
$pseudo = '';
header('Refresh')
?>
<div class="starter-template">
    <div class="row">
        <div class="col-6 mx-auto" style="width: 400px;">
            <form method="post" action="?action=doLogin">

                <div class="row">
                    <div class="col-6 mx-auto" style="width: 400px;">
                        <h2>Se connecter</h2>

                        <div class="form-group">
                            <label for="pseudo">Pseudo</label>
                            <input type="text" name="pseudo" id="pseudo" value="<?php echo $pseudo; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="mdp">Mot de passe</label>
                            <input type="password" autocomplete="off" name="mdp" id="mdp" class="form-control">
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