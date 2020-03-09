<?php $title = 'Gestion salles'; ?>

<?php ob_start(); ?>

    <!--****************************-->
    <!-- DEBUT AFFICHAGE DES SALLES -->
    <!--****************************-->
<?php if (!empty($rooms_list)) {
    echo '<p>Nombre d\'articles : <b>' . $rooms_list->rowCount() . '</b></p>';
} ?>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th>Id salle</th>
                <th>Titre</th>
                <th>Catégorie</th>
                <th>Description</th>
                <th>Photo</th>
                <th>Pays</th>
                <th>Ville</th>
                <th>Adresse</th>
                <th>Code Postal</th>
                <th>Capacité</th>
                <th>Modif</th>
                <th>Suppr</th>
            </tr>
            <?php
            while ($room = $rooms_list->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr>';
                echo '<td>' . $room['id_salle'] . '</td>';
                echo '<td>' . $room['titre'] . '</td>';
                echo '<td>' . $room['categorie'] . '</td>';
                echo '<td>' . substr($room['description'], 0, 30) . '...</td>';
                echo '<td><img src="../../img/' . $room['photo'] . '" class="img-thumbnail" width="140" alt="' . $room['description'] . '"></td>';
                echo '<td>' . $room['pays'] . '</td>';
                echo '<td>' . $room['ville'] . '</td>';
                echo '<td>' . $room['adresse'] . '</td>';
                echo '<td>' . $room['cp'] . '</td>';
                echo '<td>' . $room['capacite'] . '</td>';

                echo '<td><a href="?action=editRoom&room-id=' . $room['id_salle'] . '&#form" class="btn btn-warning"><i class="fas fa-edit"></i></a></td>';
                echo '<td><a href="?action=deleteRoom&room-id=' . $room['id_salle'] . '" class="btn btn-danger" onclick="return(confirm(\'Etes-vous sûr ?\'))"><i class="fas fa-trash-alt"></i></a></td>';
                echo '</tr>';
            }
            ?>
        </table>
    </div>
    <!--**************************-->
    <!-- FIN AFFICHAGE DES SALLES -->
    <!--**************************-->
<?php
$room_id = '';
$title = '';
$description = '';
$country = '';
$city = '';
$address = '';
$current_img = '';
$zip = '';
$capacity = '';
$category = '';

if (!empty($current_room)) {
    $room_id = $current_room['id_salle'];
    $title = $current_room['titre'];
    $description = $current_room['description'];
    $country = $current_room['pays'];
    $city = $current_room['ville'];
    $address = $current_room['adresse'];
    $current_img = $current_room['photo'];
    $zip = $current_room['cp'];
    $capacity = $current_room['capacite'];
    $category = $current_room['categorie'];
}
?>
    <!--******************-->
    <!-- DEBUT FORMULAIRE -->
    <!--******************-->
    <div class="starter-template">
        <div class="row">
            <div class="col-12">
                <form method="post" id="form" action="?action=editRoom&amp;room-id=<?= $room_id ?>" enctype="multipart/form-data">
                    <input type="hidden" name="room-id" value="<?php echo $room_id; ?>">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="title">Titre</label>
                                <input type="text" name="title" id="title" value="<?php echo $title; ?>"
                                       class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" rows="2"
                                          class="form-control"><?php echo $description; ?></textarea>
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
                                    <option value="Paris"<?php if ($city == 'Paris') {
                                        echo 'selected';
                                    } ?>>Paris
                                    </option>
                                    <option value="Lyon"<?php if ($city == 'Lyon') {
                                        echo 'selected';
                                    } ?>>Lyon
                                    </option>
                                    <option value="Marseille"<?php if ($city == 'Marseille') {
                                        echo 'selected';
                                    } ?>>Marseille
                                    </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="address">adresse</label>
                                <input type="text" name="address" id="address" value="<?php echo $address; ?>"
                                       class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="zip">Code Postal</label>
                                <input type="number" name="zip" id="zip" value="<?php echo $zip; ?>"
                                       class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="capacity">Capacité</label>
                                <input type="number" min="0" name="capacity" id="capacity" class="form-control" step="5"
                                       value="<?php echo $capacity; ?>">
                            </div>

                            <div class="form-group">
                                <label for="category">Catégorie</label>
                                <select name="category" id="category" class="form-control">
                                    <option value="reunion"<?php if ($category == 'reunion') {
                                        echo 'selected';
                                    } ?>>Réunion
                                    </option>
                                    <option value="bureau"<?php if ($category == 'bureau') {
                                        echo 'selected';
                                    } ?>>Bureau
                                    </option>
                                    <option value="formation"<?php if ($category == 'formation') {
                                        echo 'selected';
                                    } ?>>Formation
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="country">Pays</label>
                                <select name="country" id="country" class="form-control">
                                    <option value="France"<?php if ($country == 'france') {
                                        echo 'selected';
                                    } ?>>France
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-2">
                                <button type="submit" class="form-control btn btn-outline-dark">OK</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--****************-->
    <!-- FIN FORMULAIRE -->
    <!--****************-->
<?php $content = ob_get_clean(); ?>

<?php
if (!user_is_admin()) {
    $title = 'Accès interdit';
    $content = '<h1>Vers l\'<a href="?action=listProductsIndex">accueil</a></h1>';
}
?>


<?php require('view/template/template.php'); ?>