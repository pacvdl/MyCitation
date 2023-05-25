<?php
session_start();
// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user']['id'])) {
  // Si l'utilisateur n'est pas connecté, redirige vers la page de connexion
  header('Location: connexion.php');
  exit();
}

$pdo = new PDO('mysql:host=localhost;dbname=id20676420_redream;charset=utf8', 'id20676420_redreamadmin_', 'ReDream_1');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $citationID = $_GET['id'];
    $userID = $_SESSION['user']['id'];

    $query = "SELECT * FROM citations WHERE id = ? AND user_id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$citationID, $userID]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        // La citation demandée n'appartient pas à l'utilisateur
        header('Location: historique.php');
        exit();
    }
}
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
			<li><a href="contact.php">Contact</a></li>


        </ul>
    </nav>
    
    <div class="centreur">
       <div class="titre"> <h1 class="title"><?php echo $row['name']; ?></h1></div>

        <div style="text-align: center;">
        <p class="description"> <?php echo $row['content']; ?></p>
        <p class="descriptionn"><strong> <?php echo $row['author']; ?></strong></p>
        <button class="boutton" id="copyButton">Copier la Citation</button>
</div>
    </div>
    <footer class="basdepage">
        <p class="bdptext">My Citation est OpenSource : <a href="https://github.com/" class="bdptext2"><i class="fa-brands fa-github"></i></a></p>
    </footer>
     <script>
        const copyButton = document.getElementById('copyButton');
        const citationContent = '<?php echo $row['content']; ?>';

        copyButton.addEventListener('click', () => {
            // Créer un élément textarea temporaire
            const textarea = document.createElement('textarea');
            textarea.value = citationContent;
            document.body.appendChild(textarea);

            // Sélectionner le contenu du textarea
            textarea.select();
            textarea.setSelectionRange(0, textarea.value.length);

            // Copier le contenu sélectionné dans le presse-papiers
            document.execCommand('copy');

            // Supprimer le textarea temporaire
            document.body.removeChild(textarea);

            // Afficher un message de confirmation
            alert('La citation a été copiée avec succès !');
        });
    </script>
</body>
</html>
