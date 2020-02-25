<?php
// if(!user_is_admin()) {
// 	header('location:' . URL . 'loginView.php');
// 	exit(); // bloque l'exécution du code 
// }
?>
<?php $title = 'Gestion produits';?>

<?php ob_start(); ?>

<div class="starter-template">
    <p class="text-center">
        <a href="?action=add" class="btn btn-outline-danger">Ajout</a>
        <a href="?action=display" class="btn btn-outline-primary">Affichage</a>
    </p>
</div>

<?php echo '<p>Nombre d\'article : <b>' . $rooms_list->rowCount() . '</b></p>'; ?>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th>Id salle</th>
                <th>Titre</th>
                <th>Description</th>
                <th>Photo</th>
                <th>Pays</th>
                <th>Ville</th>
                <th>Adresse</th>
                <th>Code postal</th>
                <th>Capacité</th>
                <th>Catégorie</th>
                <th>Modif</th>
                <th>Suppr</th>
            </tr>
            <?php
            while ($room = $rooms_list->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr>';
                echo '<td>' . $room['id_salle'] . '</td>';
                echo '<td>' . $room['titre'] . '</td>';
                echo '<td>' . $room['categorie'] . '</td>';
                echo '<td>' . substr($room['description'], 0, 14) . '...</td>';
                echo '<td><img src="../../img/' . $room['photo'] . '" class="img-thumbnail" width="140" alt="'.$room['description'].'"></td>';
                echo '<td>' . $room['pays'] . '</td>';
                echo '<td>' . $room['ville'] . '</td>';
                echo '<td>' . $room['adresse'] . '</td>';
                echo '<td>' . $room['cp'] . '</td>';
                echo '<td>' . $room['capacite'] . '</td>';

                echo '<td><a href="?action=edit&id_salle=' . $room['id_salle'] . '" class="btn btn-warning"><i class="fas fa-edit"></i></a></td>';
                echo '<td><a href="?action=delete&id_salle=' . $room['id_salle'] . '" class="btn btn-danger" onclick="return(confirm(\'Etes-vous sûr ?\'))"><i class="fas fa-trash-alt"></i></a></td>';
                echo '</tr>';
            }
            ?>
        </table>
    </div>
<!--***************************-->
<!-- FIN AFFICHAGE DES PRODUITS-->
<!--***************************-->

<div class="starter-template">
    <div class="row">
        <div class="col-12">
            <form method="post" action="../../index.php" enctype="multipart/form-data">
                <input type="hidden" name="room-id" value="<?php echo $room['id_salle']; ?>">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="title">Titre</label>
                            <input type="text" name="title" id="title" value="<?php echo $room['titre']; ?>"
                                   class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" rows="2"
                                      class="form-control"><?php echo $room['description']; ?></textarea>
                        </div>

                        <?php if (!empty($current_img)) : ?>

                            <div class="form-group text-center">
                                <label>Photo actuelle</label>
                                <hr>
                                <img src="../../img/<?php echo $current_img; ?>" class="w-25 img-thumbnail"
                                     alt="image de la salle">
                                <input type="hidden" name="current-img" value="<?php echo $current_img; ?>">
                            </div>

                        <?php endif; ?>

                        <div class="form-group">
                            <label for="img">Photo</label>
                            <input type="file" name="img" id="img" class="form-control">
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="city">Ville</label>
                            <select name="city" id="city" class="form-control">
                                <option <?php if ($room['ville'] == 'Paris') {
                                    echo 'selected';
                                } ?>>Paris
                                </option>
                                <option <?php if ($room['ville'] == 'Lyon') {
                                    echo 'selected';
                                } ?>>Lyon
                                </option>
                                <option <?php if ($room['ville'] == 'Marseille') {
                                    echo 'selected';
                                } ?>>Marseille
                                </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="address">adresse</label>
                            <input type="text" name="address" id="address" value="<?php echo $room['adresse']; ?>"
                                   class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="zip">Code Postal</label>
                            <input type="text" name="zip" id="zip" value="<?php echo $room['cp']; ?>" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="capacity">Capacité</label>
                            <input type="number" min="0" name="capacity" id="capacity" class="form-control" step="5"
                                   value="<?php echo $room['capacite']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="category">Catégorie</label>
                            <select name="category" id="category" class="form-control">
                                <option <?php if ($room['categorie'] == 'reunion') {
                                    echo 'selected';
                                } ?>>Réunion
                                </option>
                                <option <?php if ($room['categorie'] == 'bureau') {
                                    echo 'selected';
                                } ?>>Bureau
                                </option>
                                <option <?php if ($room['categorie'] == 'formation') {
                                    echo 'selected';
                                } ?>>Formation
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="country">Pays</label>
                            <select name="country" id="country" class="form-control">
                                <option <?php if ($room['pays'] == 'france') {
                                    echo 'selected';
                                } ?>>France
                                </option>
                            </select>
                        </div>
                        <div class="form-group col-2">
                            <button type="submit" name="save" id="save"
                                    class="form-control btn btn-outline-dark">Enregistrer
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('../../view/template/template.php'); ?>