document.addEventListener('DOMContentLoaded', () => {
    // --- Simulation de la base de données d'articles ---
    const allArticles = [
        {
            id: 1,
            title: "Introduction à l'Algèbre Linéaire",
            author: "John Doe",
            date: "10 Juin 2025",
            category: "Algèbre",
            excerpt: "Explorez les concepts fondamentaux de l'algèbre linéaire, des vecteurs aux transformations...",
            content: `
                <p>L'algèbre linéaire est une branche des mathématiques qui étudie les espaces vectoriels, les sous-espaces, les transformations linéaires et les systèmes d'équations linéaires. C'est un outil fondamental dans de nombreux domaines scientifiques et d'ingénierie, y compris l'informatique, la physique, l'économie et l'apprentissage automatique.</p>
                <h3>Vecteurs et Espaces Vectoriels</h3>
                <p>Un vecteur est un élément d'un espace vectoriel. Un espace vectoriel est un ensemble d'objets (vecteurs) pour lesquels l'addition et la multiplication par un scalaire sont définies et satisfont certaines propriétés (associativité, commutativité, etc.).</p>
                <pre><code>import numpy as np

# Définition de vecteurs en Python
v1 = np.array([1, 2, 3])
v2 = np.array([4, 5, 6])

# Addition de vecteurs
v_sum = v1 + v2
console.log("Somme: " + v_sum); // Output: [5 7 9]

# Multiplication par un scalaire
v_scaled = 2 * v1
console.log("Scalaire: " + v_scaled); // Output: [2 4 6]
</code></pre>
                <h3>Transformations Linéaires</h3>
                <p>Une transformation linéaire est une fonction entre deux espaces vectoriels qui préserve les opérations d'addition de vecteurs et de multiplication par un scalaire. Elles peuvent être représentées par des matrices.</p>
                <p>Par exemple, une rotation dans un plan 2D est une transformation linéaire. La matrice de rotation pour un angle $\\theta$ est donnée par :</p>
                $$\\begin{pmatrix} \\cos \\theta & -\\sin \\theta \\\\ \\sin \\theta & \\cos \\theta \\end{pmatrix}$$
                <p>Ceci est un bref aperçu. Pour aller plus loin, nous vous recommandons d'explorer les ressources sur les bases, les dimensions et les valeurs propres.</p>
            `
        },
        {
            id: 2,
            title: "Maîtriser le Calcul Différentiel",
            author: "Jane Smith",
            date: "05 Juin 2025",
            category: "Analyse",
            excerpt: "Un guide complet sur les dérivées, leurs applications et comment les utiliser...",
            content: `
                <p>Le calcul différentiel est l'étude des taux de variation des fonctions. C'est la pierre angulaire du calcul et il est essentiel pour comprendre les concepts de vitesse, d'accélération et d'optimisation.</p>
                <h3>La Dérivée</h3>
                <p>La dérivée d'une fonction $f(x)$ en un point est le taux de variation instantané de la fonction à ce point. Géométriquement, c'est la pente de la tangente à la courbe de la fonction en ce point.</p>
                <p>Elle est définie par la limite :</p>
                $$\\frac{dy}{dx} = f'(x) = \\lim_{h \\to 0} \\frac{f(x+h) - f(x)}{h}$$
                <h3>Applications</h3>
                <p>Les dérivées ont de nombreuses applications, notamment la recherche des maxima et minima d'une fonction, l'optimisation des processus, et la modélisation de phénomènes physiques.</p>
                <p>Par exemple, pour trouver la vitesse $v(t)$ d'un objet dont la position est donnée par $s(t)$, on calcule la dérivée de $s(t)$ par rapport au temps $t$ : $v(t) = s'(t)$.</p>
                <pre><code>// Exemple simple de calcul numérique de dérivée
function calculateDerivative(f, x, h = 0.0001) {
    return (f(x + h) - f(x)) / h;
}

const f = (x) => x * x; // f(x) = x^2
const derivativeAt2 = calculateDerivative(f, 2);
console.log("Dérivée de x^2 en x=2 : " + derivativeAt2); // Devrait être proche de 4
</code></pre>
                <p>La compréhension du calcul différentiel est cruciale pour quiconque s'intéresse aux sciences ou à l'ingénierie.</p>
            `
        },
        {
            id: 3,
            title: "La Magie de la Théorie des Nombres",
            author: "Alan Turing",
            date: "01 Juin 2025",
            category: "Théorie des Nombres",
            excerpt: "Découvrez les mystères des nombres premiers, des congruences et des équations diophantiennes...",
            content: `
                <p>La théorie des nombres est une branche des mathématiques pures qui s'intéresse aux propriétés des nombres entiers. Elle est l'une des plus anciennes disciplines mathématiques et continue de fasciner les chercheurs aujourd'hui.</p>
                <h3>Nombres Premiers</h3>
                <p>Un nombre premier est un entier naturel supérieur à 1 qui n'a que deux diviseurs distincts positifs : 1 et lui-même. Les nombres premiers sont les "atomes" de l'arithmétique. Les premiers sont : $2, 3, 5, 7, 11, 13, \\ldots$.</p>
                <p>La distribution des nombres premiers est un sujet de recherche intense, notamment avec l'hypothèse de Riemann.</p>
                <h3>Congruences Modulo n</h3>
                <p>La congruence modulo $n$ est une relation d'équivalence entre entiers. On dit que $a$ est congru à $b$ modulo $n$ si $n$ divise $a-b$, noté $a \\equiv b \\pmod{n}$.</p>
                <p>Par exemple, $17 \\equiv 2 \\pmod{5}$ car $17-2 = 15$ est un multiple de $5$. Les congruences sont fondamentales en cryptographie, notamment avec le chiffrement RSA.</p>
                <h3>Équations Diophantiennes</h3>
                <p>Une équation diophantienne est une équation polynomiale à coefficients entiers dont les solutions recherchées sont des entiers. L'exemple le plus célèbre est le dernier théorème de Fermat : il n'existe pas d'entiers positifs $a, b, c$ tels que $a^n + b^n = c^n$ pour tout entier $n > 2$.</p>
                <p>La théorie des nombres est riche en problèmes ouverts et en découvertes surprenantes, la rendant éternellement fascinante.</p>
            `
        },
        {
            id: 4,
            title: "Les Fondamentaux de la Géométrie Euclidienne",
            author: "Euclide",
            date: "28 Mai 2025",
            category: "Géométrie",
            excerpt: "Plongez dans les axiomes, théorèmes et constructions de la géométrie classique...",
            content: `
                <p>La géométrie euclidienne est le système de géométrie basé sur les postulats et définitions d'Euclide dans ses "Éléments". C'est le fondement de notre compréhension de l'espace et des formes.</p>
                <h3>Les Postulats d'Euclide</h3>
                <p>Euclide a formulé cinq postulats, dont le célèbre cinquième postulat sur les parallèles, qui a été un sujet de débat pendant des siècles et a conduit au développement des géométries non euclidiennes.</p>
                <ul>
                    <li>Deux points quelconques déterminent un segment de droite unique.</li>
                    <li>Un segment de droite peut être prolongé indéfiniment en une ligne droite.</li>
                    <li>Un cercle peut être construit avec n'importe quel centre et n'importe quel rayon.</li>
                    <li>Tous les angles droits sont égaux entre eux.</li>
                    <li>Si une droite coupant deux autres droites forme des angles intérieurs du même côté dont la somme est inférieure à deux angles droits, alors ces deux droites se rencontreront éventuellement si elles sont prolongées indéfiniment de ce côté.</li>
                </ul>
                <h3>Théorèmes Célèbres</h3>
                <p>De nombreux théorèmes célèbres découlent de ces postulats, comme le théorème de Pythagore :</p>
                $$a^2 + b^2 = c^2$$
                <p>La géométrie euclidienne, bien que 'classique', reste essentielle pour de nombreuses applications pratiques et théoriques, de l'architecture à l'infographie.</p>
            `
        },
        {
            id: 5,
            title: "Introduction aux Probabilités et Statistiques",
            author: "Marie Curie",
            date: "20 Mai 2025",
            category: "Probabilités et Statistiques",
            excerpt: "Comprendre le hasard et l'analyse des données : un guide pour débutants.",
            content: `
                <p>Les probabilités et les statistiques sont des outils essentiels pour comprendre l'incertitude et prendre des décisions basées sur des données. Elles sont utilisées dans presque tous les domaines, de la science à la finance, en passant par la médecine et l'ingénierie.</p>
                <h3>Probabilités</h3>
                <p>La probabilité est la mesure de la vraisemblance qu'un événement se produise. Elle est exprimée comme un nombre entre 0 et 1 (ou 0% et 100%).</p>
                <p>La probabilité d'un événement $A$ est donnée par :</p>
                $$P(A) = \\frac{\\text{Nombre de résultats favorables à A}}{\\text{Nombre total de résultats possibles}}$$
                <h3>Statistiques</h3>
                <p>Les statistiques consistent à collecter, organiser, analyser, interpréter et présenter des données. Elles nous permettent de tirer des conclusions significatives à partir d'échantillons de données.</p>
                <p>Des concepts clés incluent la moyenne ($\\mu$), la médiane, le mode, la variance ($\\sigma^2$) et l'écart-type ($\\sigma$).</p>
                <pre><code>// Exemple simple en JavaScript pour calculer la moyenne
function calculateMean(arr) {
    if (arr.length === 0) return 0;
    const sum = arr.reduce((a, b) => a + b, 0);
    return sum / arr.length;
}

const data = [10, 20, 30, 40, 50];
console.log("Moyenne des données : " + calculateMean(data)); // Output: 30
</code></pre>
                <p>Que ce soit pour prédire le temps, évaluer les risques ou comprendre les sondages d'opinion, les probabilités et les statistiques sont indispensables.</p>
            `
        },
        {
            id: 6,
            title: "Le Monde Fascinant des Fractales",
            author: "Benoît Mandelbrot",
            date: "15 Mai 2025",
            category: "Géométrie",
            excerpt: "Explorez la beauté et la complexité des formes géométriques infiniment détaillées.",
            content: `
                <p>Les fractales sont des formes géométriques qui présentent une auto-similarité, ce qui signifie qu'elles apparaissent identiques ou similaires à différentes échelles. Elles sont infiniment complexes et détaillées.</p>
                <h3>Qu'est-ce qu'une Fractale ?</h3>
                <p>Le terme "fractale" a été inventé par Benoît Mandelbrot en 1975. Elles sont caractérisées par leur dimension fractale, qui peut être non entière, contrairement aux dimensions euclidiennes traditionnelles.</p>
                <p>L'exemple le plus célèbre est l'ensemble de Mandelbrot, généré par des itérations de la fonction complexe $f(z) = z^2 + c$.</p>
                <h3>Exemples Célèbres</h3>
                <ul>
                    <li>L'ensemble de Mandelbrot</li>
                    <li>L'ensemble de Julia</li>
                    <li>Le flocon de Koch</li>
                    <li>Le triangle de Sierpinski</li>
                </ul>
                <p>Les fractales ne sont pas seulement des curiosités mathématiques ; elles apparaissent naturellement dans de nombreux phénomènes, des côtes aux nuages, en passant par la structure des bronches pulmonaires et les cours de la bourse.</p>
                <p>Leur étude continue de révéler des connexions profondes entre l'ordre et le chaos.</p>
            `
        },
        {
            id: 7,
            title: "La Logique Mathématique et ses Applications",
            author: "Kurt Gödel",
            date: "08 Mai 2025",
            category: "Logique & Fondements",
            excerpt: "Découvrez les principes du raisonnement formel et leur impact sur l'informatique.",
            content: `
                <p>La logique mathématique est l'étude des systèmes formels qui codifient le raisonnement mathématique. Elle est fondamentale pour les fondations des mathématiques et a des applications directes en informatique et en intelligence artificielle.</p>
                <h3>Propositions et Prédicats</h3>
                <p>Une proposition est une déclaration qui est soit vraie, soit fausse. Un prédicat est une fonction qui prend des variables et retourne une proposition. Par exemple, "x est un nombre pair" est un prédicat.</p>
                <p>Les opérateurs logiques comme la conjonction (AND, $\\land$), la disjonction (OR, $\\lor$), la négation (NOT, $\\neg$), l'implication ($\\implies$) et l'équivalence ($\\iff$) sont utilisés pour construire des expressions plus complexes.</p>
                <h3>Théorèmes d'Incomplétude de Gödel</h3>
                <p>L'un des résultats les plus profonds de la logique mathématique est le théorème d'incomplétude de Gödel, qui stipule que dans tout système formel cohérent et suffisamment puissant pour l'arithmétique, il existe des propositions vraies qui ne peuvent pas être prouvées au sein de ce système.</p>
                <p>Ceci a eu un impact majeur sur la philosophie des mathématiques et la théorie de la computabilité.</p>
                <pre><code>// Exemple simple de logique booléenne en JavaScript
let p = true;
let q = false;

console.log("p AND q: " + (p && q)); // false
console.log("p OR q: " + (p || q));  // true
console.log("NOT p: " + (!p));      // false
</code></pre>
                <p>La logique mathématique fournit le cadre rigoureux pour le raisonnement et la vérification des preuves, indispensable dans le développement de l'IA et des algorithmes.</p>
            `
        },
        {
            id: 8,
            title: "L'Élégance des Nombres Complexes",
            author: "Carl Friedrich Gauss",
            date: "01 Mai 2025",
            category: "Algèbre",
            excerpt: "Au-delà des nombres réels : explorez les merveilles de $i^2 = -1$.",
            content: `
                <p>Les nombres complexes étendent le système des nombres réels en introduisant l'unité imaginaire $i$, définie par $i^2 = -1$. Ils sont cruciaux en physique, en ingénierie (en particulier l'électronique et le traitement du signal) et dans de nombreux domaines des mathématiques.</p>
                <h3>Forme d'un Nombre Complexe</h3>
                <p>Un nombre complexe $z$ est généralement écrit sous la forme $z = a + bi$, où $a$ est la partie réelle et $b$ est la partie imaginaire. Ils peuvent être représentés comme des points dans un plan complexe.</p>
                <h3>Formule d'Euler</h3>
                <p>L'une des plus belles formules en mathématiques est la formule d'Euler, qui relie les fonctions trigonométriques aux nombres complexes et à la constante $e$ :</p>
                $$e^{i\\theta} = \\cos \\theta + i \\sin \\theta$$
                <p>Un cas particulier célèbre est l'identité d'Euler :</p>
                $$e^{i\\pi} + 1 = 0$$
                <p>Cette identité relie les cinq constantes fondamentales des mathématiques : $e, i, \\pi, 1, 0$.</p>
                <p>Les nombres complexes simplifient de nombreux problèmes qui seraient très difficiles ou impossibles à résoudre en utilisant uniquement des nombres réels, offrant une perspective plus complète sur les phénomènes mathématiques et physiques.</p>
            `
        },
        {
            id: 9,
            title: "Cryptographie : Les Mathématiques Secrètes",
            author: "Diffie-Hellman",
            date: "25 Avril 2025",
            category: "Cryptographie",
            excerpt: "Comment les mathématiques sécurisent vos communications en ligne.",
            content: `
                <p>La cryptographie est la science de la communication sécurisée en présence d'adversaires. Elle est intrinsèquement liée aux mathématiques, utilisant des concepts de la théorie des nombres, de l'algèbre et de la complexité algorithmique.</p>
                <h3>Chiffrement Asymétrique (Clé Publique/Privée)</h3>
                <p>Avant les années 1970, la plupart des systèmes cryptographiques étaient symétriques (même clé pour chiffrer et déchiffrer). L'invention de la cryptographie asymétrique a révolutionné la sécurité en permettant à deux parties de communiquer de manière sécurisée sans avoir partagé une clé secrète au préalable.</p>
                <p>Le système RSA (Rivest-Shamir-Adleman) est un exemple classique de chiffrement asymétrique, basé sur la difficulté de factoriser de grands nombres premiers. Le protocole d'échange de clés Diffie-Hellman permet l'établissement d'une clé secrète partagée sur un canal non sécurisé.</p>
                <h3>Fonctions de Hachage Cryptographiques</h3>
                <p>Une fonction de hachage cryptographique est un algorithme qui prend une entrée (ou "message") et renvoie une chaîne de caractères de taille fixe (le "hachage" ou "digest") qui est unique pour cette entrée. Des changements minimes dans l'entrée produisent des hachages très différents.</p>
                <p>Elles sont utilisées pour vérifier l'intégrité des données et dans les signatures numériques. Des exemples incluent SHA-256 et Blake2.</p>
                <p>La cryptographie est la fondation de la sécurité numérique moderne, protégeant tout, des transactions bancaires aux communications personnelles.</p>
            `
        },
        {
            id: 10,
            title: "Les Mystères de Pi ($\\pi$)",
            author: "Archimède",
            date: "18 Avril 2025",
            category: "Analyse",
            excerpt: "Plongez dans le nombre le plus célèbre des mathématiques, de l'antiquité à nos jours.",
            content: `
                <p>Le nombre $\\pi$ (pi) est l'une des constantes mathématiques les plus reconnaissables et les plus étudiées. Il est défini comme le rapport de la circonférence d'un cercle à son diamètre. Sa valeur est approximativement $3.14159$.</p>
                <h3>Historique de $\\pi$</h3>
                <p>Les civilisations anciennes, des Babyloniens aux Égyptiens, avaient déjà des approximations de $\\pi$. Archimède de Syracuse (287–212 av. J.-C.) a été le premier à calculer $\\pi$ avec une précision considérable en utilisant une méthode géométrique basée sur des polygones inscrits et circonscrits.</p>
                <h3>Propriétés de $\\pi$</h3>
                <p>$\\pi$ est un nombre irrationnel, ce qui signifie qu'il ne peut pas être exprimé comme une fraction simple $a/b$. Il est également un nombre transcendant, ce qui implique qu'il n'est la racine d'aucun polynôme non nul à coefficients entiers.</p>
                <p>La série de Leibniz est un exemple de série infinie pour calculer $\\pi$ :</p>
                $$\\frac{\\pi}{4} = 1 - \\frac{1}{3} + \\frac{1}{5} - \\frac{1}{7} + \\frac{1}{9} - \\ldots$$
                <p>$\\pi$ apparaît dans d'innombrables formules en mathématiques, en physique, en ingénierie et au-delà, témoignant de son omniprésence dans le monde naturel et conceptuel.</p>
            `
        },
        {
            id: 11,
            title: "L'Hypothèse de Riemann : Le Saint Graal",
            author: "Bernhard Riemann",
            date: "10 Avril 2025",
            category: "Théorie des Nombres",
            excerpt: "Un des problèmes non résolus les plus importants en mathématiques avec une récompense d'un million de dollars.",
            content: `
                <p>L'Hypothèse de Riemann est l'un des sept problèmes du Prix du Millénaire de l'Institut de Mathématiques Clay, avec une récompense d'un million de dollars pour sa résolution. C'est le problème non résolu le plus célèbre en théorie des nombres et probablement dans toutes les mathématiques.</p>
                <h3>La Fonction Zêta de Riemann</h3>
                <p>L'hypothèse concerne les zéros de la fonction zêta de Riemann, $\\zeta(s)$, une fonction complexe de variable complexe $s$. Elle est définie pour les nombres complexes $s$ dont la partie réelle est supérieure à 1 par la série infinie :</p>
                $$\\zeta(s) = \\sum_{n=1}^{\\infty} \\frac{1}{n^s} = 1 + \\frac{1}{2^s} + \\frac{1}{3^s} + \\ldots$$
                <p>Cette fonction a été étendue à tout le plan complexe par prolongement analytique, et c'est dans ce prolongement que les "zéros" (valeurs de $s$ pour lesquelles $\\zeta(s)=0$) sont étudiés.</p>
                <h3>L'Hypothèse</h3>
                <p>L'Hypothèse de Riemann stipule que tous les "zéros non triviaux" de la fonction zêta de Riemann ont une partie réelle égale à $1/2$.</p>
                <p>Si cette hypothèse est vraie, elle aurait des implications profondes sur la distribution des nombres premiers, car il existe une relation étroite entre la fonction zêta et les nombres premiers.</p>
                <p>Malgré des siècles de recherche par les plus grands esprits mathématiques, l'hypothèse reste non prouvée, défiant quiconque cherche à percer les secrets de l'univers des nombres.</p>
            `
        },
        {
            id: 12,
            title: "La Théorie des Graphes : Connexions et Réseaux",
            author: "Leonhard Euler",
            date: "01 Avril 2025",
            category: "Mathématiques Discrètes",
            excerpt: "De Königsberg à Internet : comprendre la puissance des réseaux.",
            content: `
                <p>La théorie des graphes est l'étude des structures discrètes appelées "graphes", qui sont des modèles pour les relations entre des objets. Un graphe est constitué de "sommets" (ou nœuds) et d' "arêtes" (ou liens) qui relient les paires de sommets.</p>
                <h3>Problème des Sept Ponts de Königsberg</h3>
                <p>Considéré comme le point de départ de la théorie des graphes, le problème de Königsberg demandait s'il était possible de traverser les sept ponts de la ville une seule fois chacun et de revenir au point de départ. Leonhard Euler a prouvé que c'était impossible, jetant les bases des concepts d'un chemin eulérien et d'un cycle eulérien.</p>
                <h3>Applications</h3>
                <p>La théorie des graphes est omniprésente dans le monde moderne :</p>
                <ul>
                    <li>**Réseaux Sociaux:** Les utilisateurs sont des sommets, les amitiés/connexions sont des arêtes.</li>
                    <li>**Internet et Réseaux Informatiques:** Les ordinateurs sont des sommets, les câbles/connexions sont des arêtes.</li>
                    <li>**Logistique et Routage:** Optimisation des itinéraires de livraison (Problème du voyageur de commerce).</li>
                    <li>**Biologie:** Réseaux de protéines, génomes.</li>
                </ul>
                <pre><code>// Représentation simple d'un graphe en JavaScript (liste d'adjacence)
const graph = {
    'A': ['B', 'C'],
    'B': ['A', 'D'],
    'C': ['A', 'E'],
    'D': ['B'],
    'E': ['C']
};

console.log("Voisins de A: " + graph['A']); // Output: ["B", "C"]
</code></pre>
                <p>La théorie des graphes fournit un cadre puissant pour modéliser et résoudre des problèmes complexes impliquant des relations et des interconnexions.</p>
            `
        }
    ];

    const articlesPerPage = 6; // Nombre d'articles à afficher initialement
    let currentArticleIndex = 0; // Pour la pagination sur index.html

    // --- Fonctionnalités communes aux deux pages (index et article) ---

    // Barre de recherche
    const searchInput = document.querySelector('.search-bar input');
    const searchButton = document.querySelector('.search-bar button');

    if (searchButton && searchInput) {
        searchButton.addEventListener('click', () => {
            const query = searchInput.value.trim();
            if (query) {
                // Redirection vers une page de résultats de recherche simulée ou filtrage
                alert(`Recherche pour : "${query}" (Fonctionnalité complète à implémenter)`);
                // Pour une implémentation réelle: window.location.href = `search.html?q=${encodeURIComponent(query)}`;
            }
        });

        searchInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                searchButton.click();
            }
        });
    }

    // --- Logique pour la page d'accueil (index.html) ---
    if (document.body.classList.contains('home-page')) {
        const articlesContainer = document.getElementById('articles-container');
        const loadMoreBtn = document.getElementById('load-more-articles');

        // Fonction pour créer une carte d'article
        const createArticleCard = (article) => {
            const articleCard = document.createElement('article');
            articleCard.classList.add('article-card');
            if (article.id === 3) { // Exemple: Marquer l'article 3 comme "featured"
                articleCard.classList.add('featured');
                articleCard.id = 'featured-article'; // Pour le lien du bouton "Article à la Une"
            }

            articleCard.innerHTML = `
                <div class="article-content">
                    <h3><a href="article.html?id=${article.id}">${article.title}</a></h3>
                    <p class="article-meta">Par ${article.author} le ${article.date} | Catégorie: ${article.category}</p>
                    <p>${article.excerpt}</p>
                    <a href="article.html?id=${article.id}" class="read-more">Lire la suite <i class="fas fa-arrow-right"></i></a>
                </div>
            `;
            return articleCard;
        };

        // Fonction pour charger les articles
        const loadArticles = (numToLoad) => {
            const startIndex = currentArticleIndex;
            const endIndex = Math.min(startIndex + numToLoad, allArticles.length);

            for (let i = startIndex; i < endIndex; i++) {
                articlesContainer.appendChild(createArticleCard(allArticles[i]));
            }
            currentArticleIndex = endIndex;

            if (currentArticleIndex >= allArticles.length) {
                loadMoreBtn.style.display = 'none'; // Cacher le bouton si tous les articles sont chargés
            }
        };

        // Charger les premiers articles au chargement de la page
        loadArticles(articlesPerPage);

        // Écouteur d'événement pour le bouton "Charger plus"
        if (loadMoreBtn) {
            loadMoreBtn.addEventListener('click', () => {
                loadArticles(articlesPerPage);
            });
        }
    }

    // --- Logique pour la page d'article individuel (article.html) ---
    if (document.body.classList.contains('article-page')) {
        const urlParams = new URLSearchParams(window.location.search);
        const articleId = parseInt(urlParams.get('id')); // Convertir en nombre

        const articleTitleElem = document.getElementById('article-title');
        const articleMainTitleElem = document.getElementById('article-main-title');
        const articleMetaInfoElem = document.getElementById('article-meta-info');
        // const articleImageElem = document.getElementById('article-image'); // Plus utilisé
        const articleBodyContentElem = document.getElementById('article-body-content');
        const prevArticleBtn = document.getElementById('prev-article');
        const nextArticleBtn = document.getElementById('next-article');
        const recentPostsList = document.getElementById('recent-posts-list');

        const loadArticle = (id) => {
            const article = allArticles.find(a => a.id === id);

            if (article) {
                articleTitleElem.textContent = `${article.title} - MathInsight`;
                articleMainTitleElem.textContent = article.title;
                articleMetaInfoElem.textContent = `Par ${article.author} le ${article.date} | Catégorie: ${article.category}`;
                // articleImageElem.src = article.image; // Plus utilisé
                // articleImageElem.alt = article.title; // Plus utilisé
                // articleImageElem.style.display = 'none'; // Cacher si l'élément HTML existe toujours
                articleBodyContentElem.innerHTML = article.content;

                // Indiquer à MathJax de redessiner les équations après l'injection du contenu
                if (typeof MathJax !== 'undefined') {
                    MathJax.typesetPromise([articleBodyContentElem]);
                }

                // Gérer la navigation Précédent/Suivant
                const currentArticleIndex = allArticles.findIndex(a => a.id === id);

                if (currentArticleIndex > 0) {
                    prevArticleBtn.href = `article.html?id=${allArticles[currentArticleIndex - 1].id}`;
                    prevArticleBtn.style.display = 'inline-flex';
                } else {
                    prevArticleBtn.style.display = 'none';
                }

                if (currentArticleIndex < allArticles.length - 1) {
                    nextArticleBtn.href = `article.html?id=${allArticles[currentArticleIndex + 1].id}`;
                    nextArticleBtn.style.display = 'inline-flex';
                } else {
                    nextArticleBtn.style.display = 'none';
                }
            } else {
                // Gérer le cas où l'article n'est pas trouvé
                articleTitleElem.textContent = 'Article Introuvable - MathInsight';
                articleMainTitleElem.textContent = 'Article Introuvable';
                articleMetaInfoElem.textContent = '';
                // if (articleImageElem) articleImageElem.style.display = 'none'; // S'assurer que l'image est cachée
                articleBodyContentElem.innerHTML = '<p>Désolé, l\'article que vous recherchez n\'existe pas ou a été supprimé.</p><p><a href="index.html">Retour à la page d\'accueil</a></p>';
                prevArticleBtn.style.display = 'none';
                nextArticleBtn.style.display = 'none';
            }
        };

        // Charger l'article au chargement de la page
        if (articleId) {
            loadArticle(articleId);
        } else {
            // Afficher un message d'erreur si pas d'ID d'article dans l'URL
            articleTitleElem.textContent = 'Erreur - MathInsight';
            articleMainTitleElem.textContent = 'Article non spécifié';
            articleBodyContentElem.innerHTML = '<p>Aucun article n\'a été spécifié. Veuillez retourner à la page d\'accueil pour choisir un article.</p><p><a href="index.html">Retour à la page d\'accueil</a></p>';
            prevArticleBtn.style.display = 'none';
            nextArticleBtn.style.display = 'none';
        }

        // Charger les articles récents (les 5 derniers articles, à l'exclusion de l'actuel si possible)
        const recentArticles = allArticles
            .filter(art => art.id !== articleId) // Exclure l'article actuellement affiché
            .slice(0, 5); // Prendre les 5 premiers (les plus récents dans notre base simulée)

        recentArticles.forEach(art => {
            const li = document.createElement('li');
            li.innerHTML = `
                <a href="article.html?id=${art.id}">${art.title}</a>
                <span>${art.date}</span>
            `;
            recentPostsList.appendChild(li);
        });
    }

});