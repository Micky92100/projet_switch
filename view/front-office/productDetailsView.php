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
                         echo '<h5>' . $rate['avis'];
                        echo '<img src="img/' . htmlspecialchars($product['photo']) . '" alt="' . htmlspecialchars($product['titre']) . '" class="img-thumbnail w-100">';
                        echo '<p style="overflow: hidden">'. htmlspecialchars(substr($product['description'], 0, 20)).'...' . '</p>';
                        echo '<p><i class="fa fa-calendar-alt"></i>&nbsp;' . $product['date_arrivee'] . ' au ' . $product['date_depart'] . '</p>';
                        echo '<button type="submit" class="btn btn-primary w-100">Reserver</button>';
                        echo '</div>';
                    }
                // }
                ?>
            </div>
        </div>


				<?php if($product['etat'] = 0) { ?>
				
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
			<form method="post" id="form" action="panier.php">
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
						<button type="submit" class="btn btn-primary w-100">Ajouter au panier</button>
					</div>
				</div>
			</form>
			<hr>
			<?php } ?>
			

		</div>
	</div>
