<?php
session_start();
// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user']['id'])) {
  // Si l'utilisateur n'est pas connecté, redirige vers la page de connexion
  header('Location: connexion.php');
  exit();
}
?>

<!DOCTYPE html>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<link rel="icon" type="image/x-icon" href="mylogo.png">
<link rel="stylesheet" type="text/css" href="mystyle.css">
<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.2.1/css/all.css">
<meta property="og:title" content="My Citation génération" />
<meta property="og:description" content="Déchaine ta sagesse, My Citation." />
<meta property="og:image" content="#" />
</head>

<body>
   
    <nav class="navigation">
        <ul>
            <li><a href="citation.php">Accueil</a></li>
			<li><a href="historique.php">Historique</a></li>
			<li><a href="apdn.html">A propos de nous</a></li>
			<li><a href="contact.php">Contact</a></li>


        </ul>
    </nav>
    
    <div class="centreur">
       <div class="titre"> <h1 class="title">Bienvenue !!</h1></div>
		<p class="description">Générez des citations aléatoires en fonction de vos préférences :</p>
		<form action="in/index.php" method="post" style="text-align: center;">
			<label for="longueur">Longueur :</label><br>
			<select name="longueur" id="longueur">
				<option value="court">Court</option>
				<option value="moyen">Moyen</option>
				<option value="long">Long</option>
			</select><br>
			<label for="sujet">Sujet :</label><br>
			<input type="text" name="sujet" id="sujet" placeholder="Sujet"><br>
			<button class="boutton" type="submit" value="Générer">Générer</button>
		</form>
		<div class="citation" id="citation"></div>
	</div>
	<footer class="basdepage">
        <p class="bdptext">My Citation est OpenSource : <a href="https://github.com/" class="bdptext2"><i class="fa-brands fa-github"></i></a></p>
    </footer>
	<script src="script.js"></script>
</body>
</html>
