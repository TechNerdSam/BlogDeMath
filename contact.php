<?php
session_start();
// La connexion à la base de données est maintenant nécessaire
require_once __DIR__ . '/includes/db_connect.php';

$message = '';
$message_type = ''; // 'success' ou 'error'

// Gérer la soumission du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $body = trim($_POST['body'] ?? '');

    if (empty($name) || empty($email) || empty($subject) || empty($body)) {
        $message = 'Veuillez remplir tous les champs du formulaire.';
        $message_type = 'error';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Veuillez fournir une adresse email valide.';
        $message_type = 'error';
    } else {
        // **Nouveau code : Insertion dans la base de données**
        try {
            $stmt = $pdo->prepare("INSERT INTO contact_messages (name, email, subject, body) VALUES (?, ?, ?, ?)");
            if ($stmt->execute([$name, $email, $subject, $body])) {
                $message = 'Merci ! Votre message a été enregistré avec succès.';
                $message_type = 'success';
                $_POST = []; // Vider le formulaire après succès
            } else {
                $message = 'Une erreur est survenue lors de l\'enregistrement de votre message.';
                $message_type = 'error';
            }
        } catch (PDOException $e) {
            error_log("Erreur d'insertion BDD pour contact: " . $e->getMessage());
            $message = 'Une erreur technique est survenue. Veuillez réessayer plus tard.';
            $message_type = 'error';
        }
    }
}

// Inclusion de l'en-tête
$page_title = "Contact";
require_once __DIR__ . '/includes/header.php';
?>

<main class="main-content">
    <div class="page-container container">
        <section class="contact-intro">
            <h1 class="section-title">Contactez-Nous</h1>
            <p class="subtitle">Une question, une suggestion ou une proposition de collaboration ? N'hésitez pas à nous écrire.</p>
        </section>

        <?php if ($message): ?>
        <div class="message <?php echo $message_type; ?>">
            <?php echo htmlspecialchars($message); ?>
        </div>
        <?php endif; ?>

        <form action="contact.php" method="POST" class="contact-form">
            <div class="form-group">
                <label for="name">Votre Nom</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Votre Email</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label for="subject">Sujet</label>
                <input type="text" id="subject" name="subject" value="<?php echo htmlspecialchars($_POST['subject'] ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label for="body">Votre Message</label>
                <textarea id="body" name="body" required><?php echo htmlspecialchars($_POST['body'] ?? ''); ?></textarea>
            </div>
            <button type="submit" class="btn">Envoyer le Message</button>
        </form>
    </div>
</main>

<?php
// Inclusion du pied de page
require_once __DIR__ . '/includes/footer.php';
?>