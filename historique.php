<?php
session_start();
// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user']['id'])) {
  // Si l'utilisateur n'est pas connecté, redirige vers la page de connexion
  header('Location: connexion.php');
  exit();
}

// Récupère les citations de l'utilisateur depuis la base de données
$pdo = new PDO('mysql:host=localhost;dbname=id20676420_redream;charset=utf8', 'id20676420_redreamadmin_', 'ReDream_1');
$userID = $_SESSION['user']['id'];

$query = "SELECT * FROM citations WHERE user_id = ? ORDER BY id DESC";
$stmt = $pdo->prepare($query);
$stmt->execute([$userID]);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<link rel="icon" type="image/x-icon" href="mylogo.png">
<link rel="stylesheet" type="text/css" href="mystyle.css">
<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.2.1/css/all.css">
<meta property="og:title" content="My Citation | HISTORIQUE" />
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
       <div class="titre"> <h1 class="title">Historique</h1></div>
		<p class="descriptionn"><a href="citation.php">Générer une nouvelle citation?</a>
		<br><br>
		<table>
			<tr>
				<th><p class="description">Choisissez une de vos Citations:</p></th>
			</tr>
			<?php foreach ($result as $row): ?>
    <tr>
        <td class="descriptionn" style="text-align: center; text-decoration:none;"><p><a href="afficher_citation.php?id=<?php echo $row['id']; ?>"><?php echo 'Citation '.$row['id']; ?></a></p></td>
    </tr>
<?php endforeach; ?>

		</table>
	</div>
	<script>
	    // Sélectionnez l'élément parent que vous souhaitez masquer l'overflow-y
var parentElement = document.getElementById("parentElement");

// Ajoutez une classe pour masquer l'overflow-y
function hideOverflowY() {
  parentElement.classList.add("hide-overflow-y");
}

// Supprimez la classe pour activer le défilement
function showOverflowY() {
  parentElement.classList.remove("hide-overflow-y");
}

	</script>
	<style>
	    .hide-overflow-y {
  overflow-y: hidden;
}

.hide-overflow-y.auto-scroll {
  overflow-y: auto;
}

	</style>
	<footer class="basdepage">
        <p class="bdptext">My Citation est OpenSource : <a href="https://github.com/" class="bdptext2"><i class="fa-brands fa-github"></i></a></p>
    </footer>
</body>
</html>
