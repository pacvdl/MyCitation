<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Vérifier si l'email est déjà utilisé
    $pdo = new PDO('mysql:host=localhost;dbname=id20676420_redream;charset=utf8', 'id20676420_redreamadmin_', 'ReDream_1');
    $stmt = $pdo->prepare('SELECT id, email, password FROM users WHERE email = :email');
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérifier si le mot de passe est correct
    if ($user && password_verify($password, $user['password'])) {
        // Enregistrer l'utilisateur dans la session
        $_SESSION['user'] = [
            'id' => $user['id'],
            'email' => $user['email']
        ];

        // Redirection vers la page d'accueil
        header('Location: ../citation.php');
        exit();
    } else {
        $error = 'Email ou mot de passe incorrect.';
    }
}
?>