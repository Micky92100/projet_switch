<?php $title = 'Home'; ?>

<?php ob_start(); ?>
    <div class="starter-template">
        <h1>Accueil</h1>
    </div>
    <div class="row">
        <div class="col-3">

            <!--------------------->
            <!-- ADVANCED SEARCH -->
            <!--------------------->
            <form method="post" action="model.php">
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

                <label for="capacity">Capacité</label>
                <select name="capacity" id="capacity" class="form-control">
                    <option>1</option>
                    <option>5</option>
                    <option>20</option>
                    <option>50</option>
                    <option>100</option>
                </select>

                <label for="price">Prix</label>
                <input id="price" name="price" type="range" value="15" max="2000" min="0" step="10"><br>

                <label for="arrival">Date d'arrivée</label>
                <input type="date" name="arrival" id="arrival">

                <label for="departure">Date de départ</label>
                <input type="date" name="departure" id="departure">

                <button type="submit">Rechercher</button>
            </form>
            <!--------------------->
            <!-- ADVANCED SEARCH -->
            <!--------------------->

        </div>
        <div class="col-9">
            <div class="row justify-content-around">
                <?php
                while ($room = $rooms_list->fetch(PDO::FETCH_ASSOC)) {
                    echo '<div class="col-sm-3 text-center p-2">';
                    echo '<h5>' . htmlspecialchars($room['titre']) . '</h5>';
                    echo '<img src="img/' . htmlspecialchars($room['photo']) . '" alt="' . htmlspecialchars($room['titre']) . '" class="img-thumbnail w-100">';
                    echo '<p>Catégorie : <b>' . htmlspecialchars($room['categorie']) . '</b><br>';
                    echo '<a href="product-details.php?id_salle=' . htmlspecialchars($room['id_salle']) . '" class="btn btn-primary w-100">Fiche produit</a><hr>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>