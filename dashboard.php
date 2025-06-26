<?php
// dashboard.php
session_start();
require_once __DIR__ . '/includes/db_connect.php';

// Vérifier si l'utilisateur est connecté, sinon rediriger vers la page de connexion
if (!isset($_SESSION['user_id'])) {
    header('Location: auth/login.php');
    exit();
}

// Récupérer les informations de l'utilisateur depuis la session
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$role = $_SESSION['role'];

// Récupérer les articles postés par cet utilisateur
$user_articles = [];
try {
    $stmt = $pdo->prepare("SELECT id, title, status, created_at, category FROM articles WHERE user_id = ? ORDER BY created_at DESC");
    $stmt->execute([$user_id]);
    $user_articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Erreur lors de la récupération des articles de l'utilisateur : " . $e->getMessage());
    // Laisser $user_articles vide en cas d'erreur
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord - MathElegant</title>
    
    <link rel="stylesheet" href="style.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&family=Lora:wght@600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <link rel="icon" href="path/to/your/new/favicon.ico" type="image/x-icon">
</head>
<body>

    <header class="main-header">
        <div class="container">
            <div class="logo"><a href="index.php">MathElegant</a></div>
            <nav class="main-nav">
                <ul>
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="index.php#articles">Articles</a></li> 
                    <li><a href="about.html">À Propos</a></li>
                    <li><a href="contact.html">Contact</a></li>
                    <li><a href="auth/logout.php">Déconnexion</a></li>
                    <li><a href="post-article.php" class="btn"><i class="fas fa-plus"></i> Nouvel Article</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="main-content">
        <div class="dashboard-container container">

            <div class="dashboard-header">
                <div>
                    <h1>Tableau de bord</h1>
                    <p class="subtitle">Bienvenue, <?php echo htmlspecialchars($username); ?> ! Gérez vos publications ici.</p>
                </div>
            </div>

            <div class="article-management">
                <h2 class="section-title">Vos Articles</h2>

                <div class="article-list-cards">
                    <?php if (!empty($user_articles)): ?>
                        <?php foreach ($user_articles as $article): ?>
                            <div class="dashboard-article-card">
                                <div class="card-content">
                                    <h3 class="card-title"><?php echo htmlspecialchars($article['title']); ?></h3>
                                    <p class="card-meta">
                                        <span>Créé le: <?php echo date('d M Y', strtotime($article['created_at'])); ?></span>
                                        <span> | Catégorie: <?php echo htmlspecialchars($article['category'] ?: 'Non définie'); ?></span>
                                    </p>
                                </div>
                                <div class="card-status">
                                    <span class="status-badge status-<?php echo htmlspecialchars($article['status']); ?>">
                                        <?php echo htmlspecialchars($article['status']); ?>
                                    </span>
                                </div>
                                <div class="card-actions">
                                    <a href="post-article.php?edit=<?php echo $article['id']; ?>" class="btn-action edit"><i class="fas fa-pencil-alt"></i> Modifier</a>
                                    <a href="article.php?id=<?php echo $article['id']; ?>" class="btn-action view" target="_blank"><i class="fas fa-eye"></i> Voir</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="empty-state-card">
                            <i class="fas fa-file-alt empty-icon"></i>
                            <h3>Vous n'avez pas encore écrit d'article.</h3>
                            <p>C'est le moment idéal pour partager vos connaissances !</p>
                            <a href="post-article.php" class="btn">Commencer à écrire</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>

    <footer class="main-footer">
        <div class="container">
            <p>&copy; <?php echo date("Y"); ?> MathElegant. Tous droits réservés.</p>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>