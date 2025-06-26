<?php
// article.php
session_start();
require_once __DIR__ . '/includes/db_connect.php';

$article = null;
$message = '';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $article_id = (int)$_GET['id'];

    try {
        // Récupérer l'article et le nom de l'auteur
        $stmt = $pdo->prepare("SELECT a.id, a.title, a.content, (SELECT username FROM users WHERE id = a.user_id) AS author, a.created_at AS date, a.category FROM articles a WHERE a.id = ? AND a.status = 'published'");
        $stmt->execute([$article_id]);
        $article = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$article) {
            $message = 'L\'article que vous recherchez n\'existe pas ou n\'est pas encore publié.';
        }
    } catch (PDOException $e) {
        error_log("Erreur lors de la récupération de l'article : " . $e->getMessage());
        $message = "Une erreur est survenue lors du chargement de l'article.";
    }
} else {
    $message = 'Aucun article spécifié.';
}

// Pour les articles récents dans la sidebar
$recentArticles = [];
try {
    $stmt_recent = $pdo->prepare("SELECT id, title, created_at AS date FROM articles WHERE status = 'published' AND id != ? ORDER BY created_at DESC LIMIT 5");
    $stmt_recent->execute([$article_id ?? 0]); // Passer 0 si aucun ID n'est défini pour quand même récupérer des articles
    $recentArticles = $stmt_recent->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Erreur lors de la récupération des articles récents : " . $e->getMessage());
}

// Logique pour la navigation Précédent/Suivant
$prevArticle = null;
$nextArticle = null;

if ($article) {
    try {
        // Article précédent (par ID, peut être ajusté par date si l'ID n'est pas séquentiel)
        $stmt_prev = $pdo->prepare("SELECT id, title FROM articles WHERE id < ? AND status = 'published' ORDER BY id DESC LIMIT 1");
        $stmt_prev->execute([$article['id']]);
        $prevArticle = $stmt_prev->fetch(PDO::FETCH_ASSOC);

        // Article suivant
        $stmt_next = $pdo->prepare("SELECT id, title FROM articles WHERE id > ? AND status = 'published' ORDER BY id ASC LIMIT 1");
        $stmt_next->execute([$article['id']]);
        $nextArticle = $stmt_next->fetch(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        error_log("Erreur de navigation article : " . $e->getMessage());
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="article-title"><?php echo $article ? htmlspecialchars($article['title']) . ' - MathInsight' : 'Article Introuvable - MathInsight'; ?></title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&family=Playfair+Display:wght=700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="http://googleusercontent.com/image_generation_content/0" type="image/x-icon">
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
</head>
<body class="article-page">
    <header class="main-header">
        <div class="container">
            <h1 class="logo"><a href="index.php">MathInsight</a></h1>
            <nav class="main-nav">
                <ul>
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="index.php#articles">Articles</a></li>
                    <li><a href="about.html">À Propos</a></li>
                    <li><a href="contact.html">Contact</a></li>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li><a href="dashboard.php">Tableau de Bord</a></li>
                        <li><a href="auth/logout.php">Déconnexion</a></li>
                    <?php else: ?>
                        <li><a href="auth/login.php">Connexion</a></li>
                        <li><a href="auth/register.php">Inscription</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
            <div class="search-bar">
                <input type="text" placeholder="Rechercher des articles...">
                <button><i class="fas fa-search"></i></button>
            </div>
        </div>
    </header>

    <main class="main-content article-page-content">
        <article class="article-detail container">
            <?php if ($article): ?>
                <h2 id="article-main-title"><?php echo htmlspecialchars($article['title']); ?></h2>
                <p class="article-meta" id="article-meta-info">Par <?php echo htmlspecialchars($article['author']); ?> le <?php echo date('d M Y', strtotime($article['date'])); ?> | Catégorie: <?php echo htmlspecialchars($article['category']); ?></p>
                <div class="article-body" id="article-body-content">
                    <?php echo $article['content']; // Le contenu peut contenir du HTML, attention au XSS si l'entrée n'est pas filtrée ?>
                </div>
                <div class="article-navigation">
                    <?php if ($prevArticle): ?>
                        <a href="article.php?id=<?php echo htmlspecialchars($prevArticle['id']); ?>" id="prev-article" class="btn-secondary article-nav-btn"><i class="fas fa-arrow-left"></i> Article Précédent</a>
                    <?php else: ?>
                        <a href="#" id="prev-article" class="btn-secondary article-nav-btn disabled" style="visibility: hidden;"><i class="fas fa-arrow-left"></i> Article Précédent</a>
                    <?php endif; ?>

                    <?php if ($nextArticle): ?>
                        <a href="article.php?id=<?php echo htmlspecialchars($nextArticle['id']); ?>" id="next-article" class="btn-secondary article-nav-btn">Article Suivant <i class="fas fa-arrow-right"></i></a>
                    <?php else: ?>
                        <a href="#" id="next-article" class="btn-secondary article-nav-btn disabled" style="visibility: hidden;">Article Suivant <i class="fas fa-arrow-right"></i></a>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <h2 id="article-main-title">Article Introuvable</h2>
                <p class="article-meta" id="article-meta-info"></p>
                <div class="article-body" id="article-body-content">
                    <p><?php echo htmlspecialchars($message); ?></p>
                    <p><a href="index.php">Retour à la page d'accueil</a></p>
                </div>
            <?php endif; ?>
        </article>

        <aside class="sidebar container">
            <div class="widget recent-posts">
                <h3>Articles Récents</h3>
                <ul id="recent-posts-list">
                    <?php if (!empty($recentArticles)): ?>
                        <?php foreach ($recentArticles as $recentArt): ?>
                            <li>
                                <a href="article.php?id=<?php echo htmlspecialchars($recentArt['id']); ?>"><?php echo htmlspecialchars($recentArt['title']); ?></a>
                                <span><?php echo date('d M Y', strtotime($recentArt['date'])); ?></span>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li>Aucun article récent disponible.</li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="widget commercial-ad">
                <h3>Publicité</h3>
                <a href="#" target="_blank">
                    </a>
                <p>Besoin d'aide en maths ? Découvrez nos tutoriels !</p>
            </div>
        </aside>
    </main>

    <footer class="main-footer">
        <div class="container">
            <div class="footer-links">
                <ul>
                    <li><a href="about.html">À Propos</a></li>
                    <li><a href="contact.html">Contact</a></li>
                    <li><a href="privacy.html">Politique de Confidentialité</a></li>
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

    <script src="script.js"></script>
    <script>
        // La logique JavaScript d'article.html a été principalement déplacée vers PHP.
        // MathJax.typesetPromise() est déclenché par le script PHP lorsque le contenu est injecté.
    </script>
</body>
</html>