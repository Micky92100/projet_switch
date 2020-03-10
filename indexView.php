<?php $title = 'Home'; ?>

<?php ob_start(); ?>
<div class="m-3" id="main">
    <div class="row">
        <div class="col-sm-3">

            <!--------------------->
            <!-- ADVANCED SEARCH -->
            <!--------------------->
            <form method="post" id="form" action="?action=searchProducts">
                <label for="category">Catégories</label>
                <select name="category" id="category" class="form-control">
                    <option value=""></option>
                    <option value="1">Réunion</option>
                    <option value="2">Bureau</option>
                    <option value="3">Formation</option>
                </select required>

                <label for="city">Ville</label>
                <select name="city" id="city" class="form-control">
                    <option value=""></option>
                    <option value="Paris">Paris</option>
                    <option value="Lyon">Lyon</option>
                    <option value="Marseille">Marseille</option>
                </select required>

                <label for="capacity">Capacité min</label>
                <input type="number" min="0" name="capacity" id="capacity" class="form-control" step="5" required>

                <label for="price">Prix max</label>
                <input type="number" min="0" name="price" id="price" class="form-control" step="10" required>

                <label for="arrival">Date d'arrivée</label>
                <input type="datetime-local" name="arrival" id="arrival" class="form-control">

                <label for="departure">Date de départ</label>
                <input type="datetime-local" name="departure" id="departure" class="form-control"><br>

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
                 if (!empty($products_list)) {
                    while ($product = $products_list->fetch(PDO::FETCH_ASSOC)) {
                        echo '<div class="col-sm-3 text-center p-2">';
                        echo '<img src="img/' . htmlspecialchars($product['photo']) . '" alt="' . htmlspecialchars($product['titre']) . '" class="img-thumbnail w-100">';
                        echo '<h5>' . htmlspecialchars($product['titre']) . ' : ' . htmlspecialchars($product['prix']) . '€</h5>';

                        echo '<p style="overflow: hidden">'. htmlspecialchars(substr($product['description'], 0, 20)).'...' . '</p>';
                        echo '<p><i class="fa fa-calendar-alt"></i>&nbsp;du ' . $product['date_arrivee'] . '<br/>au ' . $product['date_depart'] . '</p>';
                        echo '<a href="?action=viewProduct&product-id=' . $product['id_produit'] . '" class="btn btn-primary w-100">Fiche produit</a><hr>';
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