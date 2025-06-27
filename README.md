-----

# 🚀 MathElegant - Un Blog Élégant pour les Passionnés de Mathématiques 🧠

[](https://opensource.org/licenses/MIT)

Bienvenue dans le dépôt de **MathElegant**, un système de blog complet et sophistiqué conçu pour partager la beauté et la clarté des mathématiques. Ce projet offre une plateforme robuste pour la publication d'articles, la gestion de contenu et l'interaction avec une communauté de passionnés.

## ✨ Description du Projet

**MathElegant** est une application web dynamique développée en **PHP** avec une architecture solide et une interface utilisateur élégante. Elle permet à des auteurs de créer, modifier et publier des articles sur divers sujets mathématiques, allant de l'algèbre à la cryptographie. Les visiteurs peuvent explorer ces articles, rechercher des sujets spécifiques et contacter les administrateurs via un formulaire dédié.

Le projet intègre un système d'authentification sécurisé pour les membres et un tableau de bord intuitif pour la gestion des publications. Le design, inspiré par une palette de couleurs "lifestyle" et professionnelle, vise à offrir une expérience de lecture agréable et immersive.

## 🌟 Fonctionnalités Principales

  * **Accueil Dynamique** 🏡 : Affiche les derniers articles publiés avec un design en grille moderne.
  * **Système d'Articles Complet** 📝 :
      * Visualisation détaillée des articles avec une mise en forme soignée et un support pour les formules MathJax.
      * Navigation facile entre les articles "Précédent" et "Suivant".
      * Affichage des articles récents dans une barre latérale pour un accès rapide.
  * **Espace Membre Sécurisé** 🔐 :
      * **Inscription et Connexion** : Formulaires dédiés avec validation des entrées et hachage des mots de passe.
      * **Tableau de Bord Utilisateur** : Permet aux auteurs de visualiser et gérer leurs propres articles (modifier, voir le statut).
  * **Gestion de Contenu (CRUD)** 🎛️ :
      * **Création et Édition d'Articles** : Un éditeur riche pour écrire, formater et prévisualiser les articles.
      * **Statuts de Publication** : Les administrateurs peuvent gérer les statuts des articles (Publié, En attente, Brouillon).
  * **Formulaire de Contact** 📨 : Permet aux visiteurs d'envoyer des messages qui sont directement enregistrés dans la base de données.
  * **Design Élégant et Responsive** 🎨 :
      * Une charte graphique sophistiquée utilisant des polices comme 'Inter' et 'Lora'.
      * Utilisation de Font Awesome pour les icônes.
      * Une mise en page entièrement responsive adaptée aux ordinateurs de bureau et aux appareils mobiles.

## 🛠️ Technologies et Outils

  * **Backend** : PHP
  * **Base de Données** : MySQL (gérée avec PDO pour des connexions sécurisées)
  * **Frontend** : HTML5, CSS3, JavaScript
  * **Bibliothèques** :
      * Google Fonts (Inter & Lora)
      * Font Awesome (pour les icônes)
      * MathJax (pour le rendu des formules mathématiques)

## ⚙️ Installation et Configuration

Pour lancer ce projet en local, suivez ces étapes :

1.  **Clonez le Dépôt**

    ```bash
    git clone https://github.com/TechNerdSam/BlogdeMath.git
    cd BlogdeMath
    ```

2.  **Base de Données** 💾

      * Importez le fichier `database.sql` (à créer par vos soins) dans votre système de gestion de base de données (par exemple, phpMyAdmin).
      * Configurez les informations de connexion à la base de données dans le fichier `includes/db_connect.php`:
        ```php
        $host = 'localhost';
        $db   = 'mathinsight_db'; // Le nom de votre base de données
        $user = 'root'; // Votre nom d'utilisateur
        $pass = ''; // Votre mot de passe
        ```

3.  **Serveur Local** 🌐

      * Démarrez un serveur local (par exemple, avec XAMPP, WAMP ou le serveur intégré de PHP).
      * Placez les fichiers du projet dans le répertoire racine de votre serveur (ex: `htdocs` pour XAMPP).

4.  **Accédez à l'Application**

      * Ouvrez votre navigateur et allez à l'adresse `http://localhost/BlogdeMath`.

## 👨‍💻 Auteur

Ce projet a été imaginé et développé avec passion par :

**TechNerdSam (Samyn-Antoy ABASSE)**

  * 📧 **Email** : samynantoy@gmail.com
  * 🐙 **GitHub** : [TechNerdSam](https://www.google.com/search?q=https://github.com/TechNerdSam)

N'hésitez pas à me contacter pour toute question, suggestion ou opportunité de collaboration \!

## 📜 Licence

Ce projet est sous licence Creative Commons Zero v1.0 Universal . Consultez le fichier `LICENSE` pour plus de détails.
