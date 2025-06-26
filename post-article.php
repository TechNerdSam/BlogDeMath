<?php
// post-article.php

// ===================================================================
// AUCUN CHANGEMENT DANS CE BLOC DE LOGIQUE PHP
// ===================================================================
session_start();
require_once __DIR__ . '/includes/db_connect.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: auth/login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$role = $_SESSION['role'];

$article = [
    'id' => null,
    'title' => '',
    'content' => '',
    'excerpt' => '',
    'category' => '',
    'status' => 'pending'
];
$is_editing = false;
$page_title = "Écrire un nouvel article";
$message = '';
$message_type = '';

if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    $article_id_to_edit = (int)$_GET['edit'];
    try {
        $stmt = $pdo->prepare("SELECT id, user_id, title, content, excerpt, category, status FROM articles WHERE id = ?");
        $stmt->execute([$article_id_to_edit]);
        $existing_article = $stmt->fetch();

        if ($existing_article) {
            if ($existing_article['user_id'] == $user_id || $role == 'admin') {
                $article = $existing_article;
                $is_editing = true;
                $page_title = "Modifier : " . htmlspecialchars($article['title']);
            } else {
                $message = "Vous n'avez pas la permission de modifier cet article.";
                $message_type = 'error';
                $is_editing = false;
            }
        } else {
            $message = "Article non trouvé.";
            $message_type = 'error';
        }
    } catch (PDOException $e) {
        error_log("Erreur de BDD lors de l'édition d'article : " . $e->getMessage());
        $message = "Une erreur est survenue lors du chargement de l'article.";
        $message_type = 'error';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $message_type !== 'error') {
    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $excerpt = trim($_POST['excerpt'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $submitted_status = $_POST['status'] ?? 'pending';

    if (empty($title) || empty($content)) {
        $message = 'Le titre et le contenu de l\'article sont obligatoires.';
        $message_type = 'error';
    } else {
        $final_status = 'pending';
        if ($role == 'admin') {
            if (in_array($submitted_status, ['draft', 'published', 'pending'])) {
                $final_status = $submitted_status;
            }
        } elseif ($role == 'member' && $is_editing && $article['status'] == 'draft' && $submitted_status == 'draft') {
            $final_status = 'draft';
        }

        if ($is_editing && $article['id']) {
            $stmt = $pdo->prepare("UPDATE articles SET title = ?, content = ?, excerpt = ?, category = ?, status = ? WHERE id = ?");
            if ($stmt->execute([$title, $content, $excerpt, $category, $final_status, $article['id']])) {
                header('Location: dashboard.php?status=updated');
                exit();
            } else {
                $message = 'Erreur lors de la mise à jour de l\'article.';
                $message_type = 'error';
            }
        } else {
            $stmt = $pdo->prepare("INSERT INTO articles (user_id, title, content, excerpt, category, status) VALUES (?, ?, ?, ?, ?, ?)");
            if ($stmt->execute([$user_id, $title, $content, $excerpt, $category, $final_status])) {
                header('Location: dashboard.php?status=submitted');
                exit();
            } else {
                $message = 'Erreur lors de la soumission de l\'article.';
                $message_type = 'error';
            }
        }
    }
}
// ===================================================================
// FIN DU BLOC DE LOGIQUE PHP
// ===================================================================

$body_class = 'page-post-editor'; 
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($page_title); ?> - MathElegant</title>
    
    <link rel="stylesheet" href="style.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&family=Lora:wght@600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <link rel="icon" href="path/to/your/new/favicon.ico" type="image/x-icon">
</head>
<body class="<?php echo $body_class; ?>">

<header class="main-header">
    <div class="container">
        <div class="logo">
            <a href="index.php">MathElegant</a>
        </div>
        <nav class="main-nav">
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="index.php#articles">Articles</a></li>
                <li><a href="about.html">À Propos</a></li>
                <li><a href="contact.html">Contact</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="dashboard.php">Tableau de Bord</a></li>
                <?php else: ?>
                    <li><a href="auth/login.php">Espace Membre</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>

<main class="main-content container">
    <h2 class="editor-page-title"><?php echo htmlspecialchars($page_title); ?></h2>

    <?php if ($message): ?>
        <div class="message <?php echo $message_type; ?>">
            <i class="fas <?php echo $message_type === 'success' ? 'fa-check-circle' : 'fa-exclamation-triangle'; ?>"></i>
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <?php if (!($is_editing && $message_type === 'error')): ?>
        <form id="article-form" action="post-article.php<?php echo $is_editing ? '?edit=' . $article['id'] : ''; ?>" method="POST" class="editor-form">

            <div class="form-main-column">
                <div class="form-group">
                    <label for="title">Titre</label>
                    <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($article['title']); ?>" required placeholder="Le titre de votre article génial">
                </div>
                <div class="form-group">
                    <label for="article_content">Contenu Principal</label>
                    <textarea id="article_content" name="content" required placeholder="Écrivez votre contenu ici..."><?php echo htmlspecialchars($article['content']); ?></textarea>
                </div>
            </div>

            <div class="form-sidebar">
                <div class="sidebar-card">
                    <h3 class="sidebar-card-title">Publication</h3>
                    <div class="form-group">
                        <label for="excerpt">Extrait</label>
                        <textarea id="excerpt" name="excerpt" rows="4" placeholder="Un court résumé visible sur la page d'accueil."><?php echo htmlspecialchars($article['excerpt']); ?></textarea>
                        <small>Ce texte apparaîtra sur les pages listant les articles.</small>
                    </div>
                    <div class="form-group">
                        <label for="category">Catégorie</label>
                        <select id="category" name="category">
                            <option value="">Sélectionner une catégorie</option>
                            <option value="Algèbre" <?php if($article['category'] == 'Algèbre') echo 'selected'; ?>>Algèbre</option>
                            <option value="Analyse" <?php if($article['category'] == 'Analyse') echo 'selected'; ?>>Analyse</option>
                            <option value="Géométrie" <?php if($article['category'] == 'Géométrie') echo 'selected'; ?>>Géométrie</option>
                            <option value="Probabilités et Statistiques" <?php if($article['category'] == 'Probabilités et Statistiques') echo 'selected'; ?>>Probabilités et Statistiques</option>
                            <option value="Théorie des Nombres" <?php if($article['category'] == 'Théorie des Nombres') echo 'selected'; ?>>Théorie des Nombres</option>
                            <option value="Logique & Fondements" <?php if($article['category'] == 'Logique & Fondements') echo 'selected'; ?>>Logique & Fondements</option>
                            <option value="Cryptographie" <?php if($article['category'] == 'Cryptographie') echo 'selected'; ?>>Cryptographie</option>
                            <option value="Mathématiques Discrètes" <?php if($article['category'] == 'Mathématiques Discrètes') echo 'selected'; ?>>Mathématiques Discrètes</option>
                        </select>
                    </div>

                    <?php if ($role == 'admin'): ?>
                    <div class="form-group">
                        <label for="status">Statut</label>
                        <select id="status" name="status">
                            <option value="pending" <?php if($article['status'] == 'pending') echo 'selected'; ?>>En attente</option>
                            <option value="published" <?php if($article['status'] == 'published') echo 'selected'; ?>>Publié</option>
                            <option value="draft" <?php if($article['status'] == 'draft') echo 'selected'; ?>>Brouillon</option>
                        </select>
                    </div>
                    <?php endif; ?>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            <?php echo $is_editing ? 'Mettre à jour' : 'Soumettre'; ?>
                        </button>
                    </div>
                </div>
            </div>

        </form>
    <?php endif; ?>
</main>

<?php
require_once __DIR__ . '/includes/footer.php';
?>