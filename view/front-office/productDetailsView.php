<?php


?>
	<div class="starter-template">
		<h1><?php echo $room['titre']; ?></h1>
		<p class="lead"><?php echo $msg; ?></p>
	</div>


    <div class="col-sm-9">
            <div class="row justify-content-around">
                <?php
                // if (!empty($products_list)) {
                    while ($product = $products_list->fetch(PDO::FETCH_ASSOC)) {
                      
                        echo '<div class="col-sm-3 text-center p-2">';

                        echo '<h5>' . htmlspecialchars($product['titre']) . ' : ' . htmlspecialchars($product['prix']) . '€</h5>';
                         echo '<h5>' $rate['avis'];

                        echo '<img src="img/' . htmlspecialchars($product['photo']) . '" alt="' . htmlspecialchars($product['titre']) . '" class="img-thumbnail w-100">';

                        echo '<p style="overflow: hidden">'. htmlspecialchars(substr($product['description'], 0, 20)).'...' . '</p>';
                        echo '<p><i class="fa fa-calendar-alt"></i>&nbsp;' . $product['date_arrivee'] . ' au ' . $product['date_depart'] . '</p>';
                        echo '<a href="?action=viewProduct&product-id=' . htmlspecialchars($product['id_produit']) . '" class="btn btn-primary w-100">Fiche produit</a><hr>';
                        echo '</div>';
                    }
                // }
                ?>
            </div>
        </div>


	<div class="row">
		<div class="col-6">
			<ul class="list-group">
				<li class="list-group-item active"><b><?php echo $room['titre']; ?></b></li>
				<li class="list-group-item">Avis : <b><?php echo $rate['avis']; ?></b></li>
				<li class="list-group-item">Description : <b><?php echo $description['salle']; ?></b></li>
                <li class="list-group-item">Couleur : <b><?php echo $arrival['date_enregistrement']; ?></b></li>
                <li class="list-group-item">Couleur : <b><?php echo $departure['date_depart']; ?></b></li>

				<li class="list-group-item">Taille : <b><?php echo $article['taille']; ?></b></li>
				<li class="list-group-item">Sexe : <b><?php echo $article['sexe']; ?></b></li>
				
				<?php if($article['stock'] > 0) { ?>
				
				<li class="list-group-item">Stock : <b><?php echo $article['stock']; ?></b></li>
				
				<?php } else { ?>
				
				<li class="list-group-item"><span class="text-danger">Rupture de stock pour cet article</span></li>
				
				<?php } ?>
				
				<li class="list-group-item">Prix : <b><?php echo $article['prix']; ?></b>€</li>
				<li class="list-group-item">Description : <?php echo $article['description']; ?></li>
			</ul>
			
		</div>
		<div class="col-6">
			<?php if($article['stock'] > 0) { ?>
			<form method="post" action="panier.php">
				<input type="hidden" name="id_article" value="<?php echo $article['id_article']; ?>">
				<div class="form-row">
					<div class="col">
						<select name="quantite" class="form-control">
						<?php
							for($i = 1; $i <= $article['stock'] && $i <= 5; $i++) {
								echo '<option>' . $i . '</option>';
							}
						?>
						</select>
					</div>
					<div class="col">
						<button type="submit" class="btn btn-primary w-100" name="ajouter_au_panier">Ajouter au panier</button>
					</div>
				</div>
			</form>
			<hr>
			<?php } ?>
			
			<img src="<?php echo URL . 'img/' . $article['photo']; ?>" alt="<?php echo $article['titre']; ?>" class="w-100 img-thumbnail">
		</div>
	</div>
