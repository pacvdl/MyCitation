<?php
session_start();
// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user']['id'])) {
  // Si l'utilisateur n'est pas connecté, redirige vers la page de connexion
  header('Location: connexion.php');
  exit();
}


$pdo = new PDO('mysql:host=localhost;dbname=id20676420_redream;charset=utf8', 'id20676420_redreamadmin_', 'ReDream_1');

$author = $_POST['author'];
$content = $_POST['content'];
$sujet = $_POST['sujet'];
$userID = $_SESSION['user']['id'];

$query = "INSERT INTO citations (user_id, author, content, sujet) VALUES (?, ?, ?, ?)";
$stmt = $pdo->prepare($query);
$stmt->execute([$userID, $author, $content, $sujet]);

if ($stmt->errorInfo()[0] === '00000') {
  $citationID = $pdo->lastInsertId(); // Récupère l'ID de la citation insérée

  // Génère le nom de la citation
  $citationName = 'citation ' . $citationID;

  // Met à jour le nom de la citation dans la base de données
  $updateQuery = "UPDATE citations SET name = ? WHERE id = ?";
  $updateStmt = $pdo->prepare($updateQuery);
  $updateStmt->execute([$citationName, $citationID]);

  if ($updateStmt->errorInfo()[0] === '00000') {
    http_response_code(200); // Succès
  } else {
    http_response_code(500); // Erreur de serveur
  }
} else {
  http_response_code(500); // Erreur de serveur
}
?>
