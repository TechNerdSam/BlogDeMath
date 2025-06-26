<?php
// includes/header.php
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? htmlspecialchars($page_title) . ' - MathInsight' : 'MathInsight'; ?></title>
    
    <link rel="stylesheet" href="style.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <link rel="icon" href="favicon.ico" type="image/x-icon">
</head>
<body class="<?php echo $body_class ?? ''; ?>">

<header class="main-header">
    <div class="container">
        <h1 class="logo"><a href="index.php">MathInsight</a></h1>
        
        <nav class="main-nav">
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="index.php#articles">Articles</a></li>
                <li><a href="about.html">À Propos</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
        
        <div class="header-actions">
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="dashboard.php" class="btn btn-secondary">Tableau de Bord</a>
                <a href="auth/logout.php" class="btn btn-primary">Déconnexion</a>
            <?php else: ?>
                <a href="auth/login.php" class="btn btn-secondary">Connexion</a>
            <?php endif; ?>
        </div>

        <div class="search-bar">
            <input type="text" placeholder="Rechercher des articles...">
            <button><i class="fas fa-search"></i></button>
        </div>
    </div>
</header>