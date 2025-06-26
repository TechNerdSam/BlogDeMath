<?php
// index.php
session_start();
require_once __DIR__ . '/includes/db_connect.php';

// Récupérer les articles publiés depuis la base de données
$articles = [];
try {
    // La requête sélectionne les articles avec le statut 'published' et récupère le nom de l'auteur
    $stmt = $pdo->query("SELECT articles.id, articles.title, users.username AS author, articles.created_at AS date, articles.category, articles.excerpt FROM articles JOIN users ON articles.user_id = users.id WHERE articles.status = 'published' ORDER BY articles.created_at DESC");
    $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Erreur lors de la récupération des articles : " . $e->getMessage());
    // En production, il serait bon d'afficher un message d'erreur convivial
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MathElegant - L'Élégance au cœur des Nombres</title>
    
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
            <div class="logo">
                <a href="index.php">MathElegant</a>
            </div>
            <nav class="main-nav">
                <ul>
                    <li><a href="index.php" class="active">Accueil</a></li>
                    <li><a href="#articles">Articles</a></li>
                    <li><a href="about.html">À Propos</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li><a href="dashboard.php">Tableau de Bord</a></li>
                    <?php else: ?>
                        <li><a href="auth/login.php">Espace Membre</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <main class="main-content">
        <section class="hero-section">
            <div class="container">
                <h1 class="subtitle">Bienvenue sur MathElegant</h1>
                <h2>L'Élégance au cœur des Nombres</h2>
                <p>Explorez des concepts mathématiques complexes à travers des articles clairs, des analyses profondes et des démonstrations inspirantes.</p>
                <a href="#articles" class="btn">Découvrir les articles</a>
            </div>
        </section>

        <section id="articles" class="articles-list container">
            <h2 class="section-title">Dernières Publications</h2>
            <div class="article-grid">
                <?php if (!empty($articles)): ?>
                    <?php foreach ($articles as $article): ?>
                        <article class="article-card">
                            <header>
                                <p class="article-meta">
                                    <span><?php echo htmlspecialchars($article['category']); ?></span>
                                    <span class="dot"> • </span>
                                    <span>Par <?php echo htmlspecialchars($article['author']); ?> le <?php echo date('d M Y', strtotime($article['date'])); ?></span>
                                </p>
                                <h3><a href="article.php?id=<?php echo htmlspecialchars($article['id']); ?>"><?php echo htmlspecialchars($article['title']); ?></a></h3>
                            </header>
                            <p><?php echo htmlspecialchars($article['excerpt']); ?></p>
                            <footer>
                                <a href="article.php?id=<?php echo htmlspecialchars($article['id']); ?>" class="read-more">Lire la suite <i class="fas fa-arrow-right"></i></a>
                            </footer>
                        </article>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p style="text-align: center; grid-column: 1 / -1; color: var(--slate);">Aucun article publié pour le moment. Revenez bientôt !</p>
                <?php endif; ?>
            </div>
             </section>
    </main>

    <footer class="main-footer">
        <div class="container">
            <div class="social-media">
                <a href="#" target="_blank" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="#" target="_blank" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                <a href="#" target="_blank" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                <a href="#" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
            </div>
            <p>&copy; <?php echo date("Y"); ?> MathElegant. Tous droits réservés.</p>
            <p><a href="privacy.html">Politique de Confidentialité</a></p>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>