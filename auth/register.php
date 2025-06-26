<?php
// auth/register.php
session_start();
require_once __DIR__ . '/../includes/db_connect.php'; // Remonter d'un dossier pour includes

$message = '';
$message_type = ''; // 'success' ou 'error'

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $message = 'Veuillez remplir tous les champs.';
        $message_type = 'error';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Format d\'email invalide.';
        $message_type = 'error';
    } elseif ($password !== $confirm_password) {
        $message = 'Les mots de passe ne correspondent pas.';
        $message_type = 'error';
    } elseif (strlen($password) < 6) {
        $message = 'Le mot de passe doit contenir au moins 6 caractères.';
        $message_type = 'error';
    } else {
        // Vérifier si l'utilisateur ou l'email existe déjà
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);
        if ($stmt->fetch()) {
            $message = 'Le nom d\'utilisateur ou l\'email est déjà pris.';
            $message_type = 'error';
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            if ($stmt->execute([$username, $email, $hashed_password])) {
                $message = 'Inscription réussie ! Vous pouvez maintenant vous connecter.';
                $message_type = 'success';
                // Optionnel: Rediriger directement après l'inscription
                // header('Location: login.php?registered=true');
                // exit();
            } else {
                $message = 'Erreur lors de l\'inscription. Veuillez réessayer.';
                $message_type = 'error';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - MathInsight</title>
    <link rel="stylesheet" href="../style.css"> <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&family=Playfair+Display:wght=700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="http://googleusercontent.com/image_generation_content/0" type="image/x-icon">
    <style>
        .auth-form-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        }
        .auth-form-container h2 {
            text-align: center;
            margin-bottom: 30px;
            color: var(--primary-color);
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: var(--dark-text);
        }
        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--border-color);
            border-radius: 5px;
            font-size: 1em;
        }
        .btn-primary {
            width: 100%;
            padding: 12px;
            font-size: 1.1em;
            cursor: pointer;
        }
        .message {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
        }
        .message.success {
            background-color: #d4edda;
            color: #155724;
            border-color: #c3e6cb;
        }
        .message.error {
            background-color: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
        }
        .auth-form-container p {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body class="page-content">
    <header class="main-header">
        <div class="container">
            <h1 class="logo"><a href="../index.php">MathInsight</a></h1>
            <nav class="main-nav">
                <ul>
                    <li><a href="../index.php">Accueil</a></li>
                    <li><a href="../index.php#articles">Articles</a></li>
                    <li><a href="../about.html">À Propos</a></li>
                    <li><a href="../contact.html">Contact</a></li>
                </ul>
            </nav>
            <div class="search-bar">
                <input type="text" placeholder="Rechercher des articles...">
                <button><i class="fas fa-search"></i></button>
            </div>
        </div>
    </header>

    <main class="main-content container">
        <div class="auth-form-container">
            <h2 class="section-title">Créer un Compte</h2>
            <?php if ($message): ?>
                <div class="message <?php echo $message_type; ?>"><?php echo $message; ?></div>
            <?php endif; ?>
            <form action="register.php" method="POST">
                <div class="form-group">
                    <label for="username">Nom d'utilisateur:</label>
                    <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirmer le mot de passe:</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                </div>
                <button type="submit" class="btn-primary">S'inscrire</button>
            </form>
            <p>Vous avez déjà un compte ? <a href="login.php">Connectez-vous ici</a></p>
        </div>
    </main>

    <footer class="main-footer">
        <div class="container">
            <div class="footer-links">
                <ul>
                    <li><a href="../about.html">À Propos</a></li>
                    <li><a href="../contact.html">Contact</a></li>
                    <li><a href="../privacy.html">Politique de Confidentialité</a></li>
                </ul>
            </div>
            <div class="social-media">
                <a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
                <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                <a href="#" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
            </div>
            <p>&copy; 2025 MathInsight. Tous droits réservés.</p>
        </div>
    </footer>
    <script src="../script.js"></script> </body>
</html>