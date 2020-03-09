<?php $title = 'Gestion produits'; ?>

<?php ob_start(); ?>

    <!--******************************-->
    <!-- DEBUT AFFICHAGE DES PRODUITS -->
    <!--******************************-->
<?php if (!empty($products_list)) {
    echo '<p>Nombre d\'articles : <b>' . $products_list->rowCount() . '</b></p>';
} ?>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th>Id produit</th>
                <th>Date d'arrivée</th>
                <th>Date de départ</th>
                <th>Id salle</th>
                <th>Prix</th>
                <th>Etat</th>
                <th>Modif</th>
                <th>Suppr</th>
            </tr>
            <?php
            while ($product = $products_list->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr>';
                echo '<td>' . $product['id_produit'] . '</td>';
                echo '<td>' . $product['date_arrivee'] . '</td>';
                echo '<td>' . $product['date_depart'] . '</td>';
                echo '<td>' . $product['id_salle'] . ' - ' . $product['titre'] . '<br/><img src="../../img/' . $product['photo'] . '" class="img-thumbnail" width="140" alt="' . $product['description'] . '"></td>';
                echo '<td>' . $product['prix'] . '€</td>';
                echo '<td>' . $product['etat'] . '</td>';

                echo '<td><a href="?action=editProduct&product-id=' . $product['id_produit'] . '&room-id=' . $product['id_salle'] . '&#form" class="btn btn-warning"><i class="fas fa-edit"></i></a></td>';
                echo '<td><a href="?action=deleteProduct&product-id=' . $product['id_produit'] . '" class="btn btn-danger" onclick="return(confirm(\'Etes-vous sûr ?\'))"><i class="fas fa-trash-alt"></i></a></td>';
                echo '</tr>';
            }
            ?>
        </table>
    </div>
    <!--****************************-->
    <!-- FIN AFFICHAGE DES PRODUITS -->
    <!--****************************-->
<?php
$product_id = '';
$arrival = '';
$departure = '';
$room_id = '';
$room_title = '';
$room_address = '';
$room_capacity = '';
$price = '';



if (!empty($current_product)) {
    $product_id = $current_product['id_produit'];
    $arrival = $current_product['date_arrivee'];
    $departure = $current_product['date_depart'];
    $price = $current_product['prix'];
}
?>
    <!--******************-->
    <!-- DEBUT FORMULAIRE -->
    <!--******************-->

    <div class="starter-template">
        <div class="row">
            <div class="col-12">
                <form method="post" id="form" action="?action=editProduct&amp;product-id=<?= $product_id ?>"
                      enctype="multipart/form-data">
                    <input type="hidden" name="room-id" value="<?php echo $product_id; ?>">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="arrival">Date d'arrivée</label>
                                <input type="datetime-local" name="arrival" id="arrival" value="<?php if (!empty($arrival)){echo date('Y-m-d\TH:i', strtotime($arrival));} ?>"
                                       class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="departure">Date d'arrivée</label>
                                <input type="datetime-local" name="departure" id="departure" value="<?php if (!empty($departure)){echo date('Y-m-d\TH:i', strtotime($departure));} ?>"
                                       class="form-control">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="room">Salle</label>
                                <select name="room" id="room" class="form-control">
                                    <option value=""></option>
                                    <?php
                                    if (!empty($current_room)) {
                                        echo '<option value = ' . $current_room['id_salle'] . ' selected>
                ' . $current_room['id_salle'] . ' 
                - ' . $current_room['titre'] . ' 
                - ' . $current_room['adresse'] . ', ' . $current_room['cp'] . ', ' . $current_room['ville'] . '
                - ' . $current_room['capacite'] . '
                                </option>';
                                    }

                                    if (!empty($rooms_list)) {
                                        while ($room = $rooms_list->fetch(PDO::FETCH_ASSOC)) {

                                            echo '<option value = ' . $room['id_salle'] . '>
                    ' . $room['id_salle'] . ' 
                    - ' . $room['titre'] . ' 
                    - ' . $room['adresse'] . ', ' . $room['cp'] . ', ' . $room['ville'] . '
                    - ' . $room['capacite'] . '
                    </option>';
                                        }
                                    }

                                    ?>

                                </select>
                            </div>

                            <div class="form-group">
                                <label for="price">Tarif</label>
                                <input type="number" name="price" id="price" value="<?php echo $price; ?>"
                                       class="form-control">
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

<?php require('view/template/template.php'); ?>