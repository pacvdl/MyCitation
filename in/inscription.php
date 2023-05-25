<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Vérifier si l'email est déjà utilisé
    $pdo = new PDO('mysql:host=localhost;dbname=id20676420_redream;charset=utf8', 'id20676420_redreamadmin_', 'ReDream_1');
    $stmt = $pdo->prepare('SELECT id FROM users WHERE email = :email');
    $stmt->execute(['email' => $email]);
    $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existingUser) {
        $error = 'Cet email est déjà utilisé.';
    } else {
        // Hasher le mot de passe avec Bcrypt avant de le stocker dans la base de données
        $hash = password_hash($password, PASSWORD_BCRYPT);

        // Insérer l'utilisateur dans la base de données
        $stmt = $pdo->prepare('INSERT INTO users (email, password) VALUES (:email, :password)');
        $stmt->execute([
            'email' => $email,
            'password' => $hash
        ]);

        // Enregistrer l'utilisateur dans la session
        $_SESSION['user'] = [
            'id' => $pdo->lastInsertId(),
            'email' => $email
        ];

        // Redirection vers la page d'accueil
        header('Location: ../citation.php');
        exit();
    }
}
?>