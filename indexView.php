<?php $title = 'Home'; ?>

<?php ob_start(); ?>
    <div class="m-3" id="main">
        <div class="row">
            <div class="col-sm-3">

                <!--------------------->
                <!-- ADVANCED SEARCH -->
                <!--------------------->
                <form method="post" action="model/model.php">
                    <label for="category">Catégories</label>
                    <select name="category" id="category" class="form-control">
                        <option value="1">Réunion</option>
                        <option value="2">Bureau</option>
                        <option value="3">Formation</option>
                    </select>

                    <label for="city">Ville</label>
                    <select name="city" id="city" class="form-control">
                        <option value="paris">Paris</option>
                        <option value="lyon">Lyon</option>
                        <option value="marseille">Marseille</option>
                    </select>

                    <label for="capacity">Capacité min</label>
                    <input type="number" min="0" name="capacity" id="capacity" class="form-control" step="5">

                    <label for="price">Prix max</label>
                    <input type="number" min="0" name="price" id="price" class="form-control" step="10">

                    <label for="arrival">Date d'arrivée</label>
                    <input type="date" name="arrival" id="arrival" class="form-control">

                    <label for="departure">Date de départ</label>
                    <input type="date" name="departure" id="departure" class="form-control"><br>

                    <button type="submit" class="btn-primary form-control">Rechercher</button>
                    <button type="reset" class="btn-danger form-control">Réinitialiser</button>
                </form>
                <!--------------------->
                <!-- ADVANCED SEARCH -->
                <!--------------------->

            </div>
            <div class="col-sm-9">
                <div class="row justify-content-around">
                    <?php
                    if (!empty($rooms_list)) {
                        while ($room = $rooms_list->fetch(PDO::FETCH_ASSOC)) {
                            echo '<div class="col-sm-3 text-center p-2">';
                            echo '<h5>' . htmlspecialchars($room['titre']) . '</h5>';
                            echo '<img src="img/' . htmlspecialchars($room['photo']) . '" alt="' . htmlspecialchars($room['titre']) . '" class="img-thumbnail w-100">';
                            echo '<p>Catégorie : <b>' . htmlspecialchars($room['categorie']) . '</b><br>';
                            echo '<a href="?action=editRoom&room-id=' . htmlspecialchars($room['id_salle']) . '" class="btn btn-primary w-100">Fiche produit</a><hr>';
                            echo '</div>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php $content = ob_get_clean(); ?>

<?php require('view/template/template.php'); ?>