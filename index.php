<?php
include 'inc/init.inc.php';
include 'inc/fonction.inc.php';
?>

<?php
// récupération des catégories en BDD


$liste_categorie = $pdo->query("SELECT DISTINCT categorie FROM salle");

 $liste_ville = $pdo->query("SELECT DISTINCT ville FROM salle");




// Récupération des catégorie en BDD
if(isset($_GET['categorie'])) {
    $choix_categorie = $_GET['categorie'];
	$liste_article = $pdo->prepare("SELECT * FROM salle WHERE categorie = :categorie ORDER BY titre");
	$liste_article->bindParam(':categorie', $choix_categorie, PDO::PARAM_STR);
    $liste_article->execute();
    
 } else if(isset($_GET['ville'])) {
     $choix_ville = $_GET['ville'];
    $liste_article = $pdo->prepare("SELECT * FROM salle WHERE ville =
     :ville ORDER BY titre");
    $liste_article->bindParam(':ville', $choix_ville, PDO::PARAM_STR);
     $liste_article->execute();
   } else {
    $liste_article = $pdo->query("SELECT * FROM salle ORDER BY titre");
    }   

var_dump($_GET);
include 'inc/header.inc.php';
include 'inc/nav.inc.php';
?>
    
    <div class="starter-template">
		<h1><i style="color: #4c6ef5;"></i> Accueil <i class="fas fa-ghost" style="color: #4c6ef5;"></i></h1>
		<p class="lead"><?php echo $msg; ?></p>
	</div>

	<div class="row">
		<div class="col-3">
			<!-- Récupérer la liste des catégories article en BDD pour les afficher dans des liens a href="" dans une liste ul li -->
			<?php 
								
				echo '<ul class="list-group">
					<li class="list-group-item active">Catégories</li>';
						
				echo '<li class="list-group-item"><a href="' . URL . 'index.php">Tous les produits</a></li>';		
						
				while($categorie = $liste_categorie->fetch(PDO::FETCH_ASSOC)) {
					// echo '<pre>'; var_dump($categorie); echo '</pre><hr>';
                    echo '<li class="list-group-item"><a href="?categorie=' . $categorie['categorie'] . '">' . $categorie['categorie'] . 
                    '</a></li>';
				}		
                
		// 		echo '</ul>';
				
        //         echo '<hr>';
                
                echo '<ul class="list-group">
               <li class="list-group-item active">ville</li>';	
                
              while($ville = $liste_ville->fetch(PDO::FETCH_ASSOC)) {
        //  echo '<pre>'; var_dump($ville); echo '</pre><hr>';
                 echo '<li class="list-group-item"><a href="?ville=' .
                 $ville['ville'] .'">' . $ville['ville'] . 
                '</a></li>';
             }
        echo '</ul>';
			?>
    </div>
		<div class="col-9">
			<div class="row justify-content-around">
            <?php 
            
/////////////////////////// affichage des articles/////////////////////////
                
                    while($salle = $liste_article->fetch(PDO::FETCH_ASSOC)) {
					// echo '<pre>'; var_dump($article); echo '</pre><hr>';
					echo '<div class="col-sm-3 text-center p-2">';	
					
					echo '<h5>' . $salle['titre'] . '</h5>';
					
					echo '<img src="' . URL . 'img/' . $salle['photo'] . '" alt="' . $salle['titre'] . '" class="img-thumbnail w-100">';
					
					// Afficher la catégorie, le prix.
					echo '<p>Catégorie : <b>' . $salle['categorie'] . '</b><br>';
					echo 'Prix : <b>' . $salle['prix'] . '€</b></p>';
					
					// bouton voir la fiche article
					echo '<a href="fiche_produit.php?id_salle=' . $salle['id_salle'] . '" class="btn btn-primary w-100">Fiche produit</a><hr>';
					
					echo '</div>';					
				}
            
            ///////////////////////FIN AFFICHAGE ARTICLES////////////////////////   


			?>
			</div>
		</div>
    <!------------------DEBUT SIDEBAR------------------------------------------------------>

    <div class="d-flex" id="wrapper">
        <div class="bg-light border-right" id="sidebar-wrapper">
            <div class="sidebar-heading">catégorie </div><br>
            <div class="list-group list-group-flush">

                <a href="#" class="list-group-item list-group-item-action bg-light">Réunion</a>
                <a href="#" class="list-group-item list-group-item-action bg-light">Bureau</a>
                <a href="#" class="list-group-item list-group-item-action bg-light">Formation</a><br>
               
                <div class="sidebar-heading">Ville </div>
                <a href="#" class="list-group-item list-group-item-action bg-light">Paris</a>
                <a href="#" class="list-group-item list-group-item-action bg-light">Lyon</a>
                <a href="#" class="list-group-item list-group-item-action bg-light">Marseille</a><hr>
                <div class="sidebar-heading">Capacité</div><hr>
                <select name="capacite" id="capacite" class="form-control"><hr>
                    <option>1</option>
                    <option>5</option>
                    <option>20</option>
                    <option>50</option>
                    <option>100</option>
                </select><hr>
                <div class="sidebar-heading">Prix</div>
                <input type="range" value="15" max="1000" min="0" step="10"><hr>
                <div class="sidebar-heading">Période</div>
                <li>Date d'arrivée</li>
                <input type="date" name="reservation"><hr>
                <li>Date de départ</li>
                <input type="date" name="reservation">

            </div>
        </div>
        <!----------------------------Fin SIDEBAR----------------------------------------------->

       
        <!-- Page Content -->

        <!-- <div class="row">

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <a href="#"><img class="card-img-top" src="img/salle1.jpg" alt=""></a>
                    <div class="card-body">
                        <h4 class="card-title">
                            <a href="#">Bureau Monet</a>
                        </h4>
                        <h5>1200 €</h5>
                        <p class="card-text">Parfait pour une réunion</p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- /.container -->

<?php
include 'inc/footer.inc.php';

