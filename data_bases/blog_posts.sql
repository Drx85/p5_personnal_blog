-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : Dim 04 avr. 2021 à 12:20
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `test`
--

-- --------------------------------------------------------

--
-- Structure de la table `blog_posts`
--

DROP TABLE IF EXISTS `blog_posts`;
CREATE TABLE IF NOT EXISTS `blog_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `post_date` date NOT NULL,
  `post_time` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=103 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `blog_posts`
--

INSERT INTO `blog_posts` (`id`, `title`, `message`, `post_date`, `post_time`) VALUES
(1, 'Présentation du blog (1)', 'Bienvenue sur mon premier blog, un site test pour mettre en pratique mon apprentissage du langage PHP et SQL :)', '2021-03-20', '15:54:55'),
(2, 'Qu\'est-ce que PHP ? (2)', 'PHP: Hypertext Preprocessor, plus connu sous son sigle PHP, est un langage de programmation libre, principalement utilisé pour produire des pages Web dynamiques via un serveur HTTP, mais pouvant également fonctionner comme n\'importe quel langage interprété de façon locale. (Wikipedia)', '2021-03-20', '15:57:57'),
(3, 'Qu\'est-ce que SQL ? (3)', 'SQL est un langage informatique normalisé servant à exploiter des bases de données relationnelles. La partie langage de manipulation des données de SQL permet de rechercher, d\'ajouter, de modifier ou de supprimer des données dans les bases de données relationnelles.', '2021-03-20', '15:58:55'),
(4, 'Qu\'est-ce que Symfony ? (4)', 'Symfony est un ensemble de composants PHP ainsi qu\'un framework MVC libre écrit en PHP. Il fournit des fonctionnalités modulables et adaptables qui permettent de faciliter et d’accélérer le développement d\'un site web. (Wikipedia)', '2021-03-20', '15:58:55'),
(5, 'Qu\'est-ce que API REST ? (5)', 'REST est un style d\'architecture logicielle définissant un ensemble de contraintes à utiliser pour créer des services web. Les services web conformes au style d\'architecture REST, aussi appelés services web RESTful, établissent une interopérabilité entre les ordinateurs sur Internet. (Wikipédia)', '2021-03-20', '15:58:55'),
(6, 'Qu\'est-ce que Docker ? (6)', 'Docker est un logiciel libre permettant de lancer des applications dans des conteneurs logiciels. Selon la firme de recherche sur l\'industrie 451 Research, « Docker est un outil qui peut empaqueter une application et ses dépendances dans un conteneur isolé, qui pourra être exécuté sur n\'importe quel serveur ». ', '2021-03-20', '15:58:55'),
(7, 'Qu\'est-ce que HTML ? (7)', 'Le HyperText Markup Language, généralement abrégé HTML ou dans sa dernière version HTML5, est le langage de balisage conçu pour représenter les pages web.\r\n\r\nCe langage permet :\r\n\r\n    d’écrire de l’hypertexte, d’où son nom,\r\n    de structurer sémantiquement la page,\r\n    de mettre en forme le contenu,\r\n    de créer des formulaires de saisie,\r\n    d’inclure des ressources multimédias dont des images, des vidéos, et des programmes informatiques,\r\n    de créer des documents interopérables avec des équipements très variés de manière conforme aux exigences de l’accessibilité du web.\r\n\r\nIl est souvent utilisé conjointement avec le langage de programmation JavaScript et des feuilles de style en cascade (CSS). HTML est inspiré du Standard Generalized Markup Language (SGML). Il s\'agit d\'un format ouvert. (Wikipédia)', '2021-03-20', '15:58:55'),
(8, 'Qu\'est-ce que CSS ? (8)', 'Les feuilles de style en cascade, généralement appelées CSS de l\'anglais Cascading Style Sheets, forment un langage informatique qui décrit la présentation des documents HTML et XML. Les standards définissant CSS sont publiés par le World Wide Web Consortium. (Wikipédia)', '2021-03-20', '15:58:55'),
(9, 'Qu\'est-ce que GIT ? (9)', 'Git est un logiciel de gestion de versions décentralisé. C\'est un logiciel libre créé par Linus Torvalds, auteur du noyau Linux, et distribué selon les termes de la licence publique générale GNU version 2. (Wikipédia)', '2021-03-20', '15:58:55'),
(10, 'Qu\'est-ce que FileZilla ? (10)', 'FileZilla Client est un client FTP, FTPS et SFTP, développé sous la licence publique générale GNU. Il est intégré à la liste des logiciels libres préconisés par l’État français dans le cadre de la modernisation globale de ses systèmes d’informations. (Wikipédia)', '2021-03-20', '15:58:55'),
(11, 'Qu\'est-ce que le backend ? (11)', 'En informatique, un back-end est un terme désignant un étage de sortie d\'un logiciel devant produire un résultat. On l\'oppose au front-end qui lui est la partie visible de l\'iceberg. (Wikipédia)', '2021-03-20', '15:58:55'),
(12, 'Qu\'est-ce que HTTP ? (12)', 'L’Hypertext Transfer Protocol est un protocole de communication client-serveur développé pour le World Wide Web. HTTPS est la variante sécurisée par l\'usage des protocoles Transport Layer Security. HTTP est un protocole de la couche application. (Wikipédia)', '2021-03-20', '15:58:55'),
(13, 'Qu\'est-ce qu\'une faille XSS ? (13)', ' Le cross-site scripting (abrégé XSS) est un type de faille de sécurité des sites web permettant d\'injecter du contenu dans une page, provoquant ainsi des actions sur les navigateurs web visitant la page. Les possibilités des XSS sont très larges puisque l\'attaquant peut utiliser tous les langages pris en charge par le navigateur (JavaScript, Java...) et de nouvelles possibilités sont régulièrement découvertes notamment avec l\'arrivée de nouvelles technologies comme HTML5. Il est par exemple possible de rediriger vers un autre site pour de l\'hameçonnage ou encore de voler la session en récupérant les cookies.\r\n\r\nLe cross-site scripting est abrégé XSS pour ne pas être confondu avec le CSS (feuilles de style)1, X se lisant « cross » (croix) en anglais. (Wikipédia)', '2021-03-20', '15:58:55'),
(14, 'Qu\'est-ce qu\'une vulnérabilité informatique ? (14)', 'Dans le domaine de la sécurité informatique, une vulnérabilité ou faille est une faiblesse dans un système informatique permettant à un attaquant de porter atteinte à l\'intégrité de ce système, c\'est-à-dire à son fonctionnement normal, à la confidentialité ou à l\'intégrité des données qu\'il contient.\r\n\r\nCes vulnérabilités sont la conséquence de faiblesses dans la conception, la mise en œuvre ou l\'utilisation d\'un composant matériel ou logiciel du système, mais il s\'agit souvent d\'anomalies logicielles liées à des erreurs de programmation ou à de mauvaises pratiques. Ces dysfonctionnements logiciels sont en général corrigés à mesure de leurs découvertes, mais l\'utilisateur reste exposé à une éventuelle exploitation tant que le correctif (temporaire ou définitif) n\'est pas publié et installé. C\'est pourquoi il est important de maintenir les logiciels à jour avec les correctifs fournis par les éditeurs de logiciels. La procédure d\'exploitation d\'une vulnérabilité logicielle est appelée exploit. (Wikipédia)', '2021-03-20', '15:58:55'),
(15, 'Qu\'est-ce que le chiffrement ? (15)', 'Le chiffrement (ou cryptage) est un procédé de cryptographie grâce auquel on souhaite rendre la compréhension d\'un document impossible à toute personne qui n\'a pas la clé de (dé)chiffrement. Ce principe est généralement lié au principe d\'accès conditionnel.\r\n\r\nBien que le chiffrement puisse rendre secret le sens d\'un document, d\'autres techniques cryptographiques sont nécessaires pour communiquer de façon sûre. Pour vérifier l\'intégrité ou l\'authenticité d\'un document, on utilise respectivement un Message Authentication Code (MAC) ou une signature numérique. On peut aussi prendre en considération l\'analyse de trafic dont la communication peut faire l\'objet, puisque les motifs provenant de la présence de communications peuvent faire l\'objet d\'une reconnaissance de motifs. Pour rendre secrète la présence de communications, on utilise la stéganographie. La sécurité d\'un système de chiffrement doit reposer sur le secret de la clé de chiffrement et non sur celui de l\'algorithme. Le principe de Kerckhoffs suppose en effet que l\'ennemi (ou la personne qui veut déchiffrer le message codé) connaisse l\'algorithme utilisé. (Wikipédia)', '2021-03-20', '15:58:55'),
(16, 'Qu\'est-ce que WampServeur ? (16)', 'WampServer est une plateforme de développement Web de type WAMP, permettant de faire fonctionner localement des scripts PHP. WampServer n\'est pas en soi un logiciel, mais un environnement comprenant trois serveurs, un interpréteur de script, ainsi que phpMyAdmin pour l\'administration Web des bases MySQL. (Wikipédia)', '2021-03-20', '15:58:55'),
(17, 'Qu\'est-ce que Apache ? (17)', 'Le logiciel libre Apache HTTP Server est un serveur HTTP créé et maintenu au sein de la fondation Apache. Jusqu\'en avril 2019, ce fut le serveur HTTP le plus populaire du World Wide Web. Il est distribué selon les termes de la licence Apache. (Wikipédia)', '2021-03-20', '15:58:55'),
(18, 'Qu\'est-ce que le World Wide Web ? (18)  ', 'Le World Wide Web (littéralement la « toile (d’araignée) mondiale », abrégé www ou le Web), la toile mondiale ou la toile, est un système hypertexte public fonctionnant sur Internet. Le Web permet de consulter, avec un navigateur, des pages accessibles sur des sites. L’image de la toile d’araignée vient des hyperliens qui lient les pages web entre elles.\r\n\r\nLe Web n’est qu’une des applications d’Internet, distincte d’autres applications comme le courrier électronique, la messagerie instantanée et le partage de fichiers en pair à pair. Inventé en 1989-1990 par Tim Berners-Lee suivi de Robert Cailliau, c\'est le Web qui a rendu les médias grand public attentifs à Internet. Depuis, le Web est fréquemment confondu avec Internet ; en particulier, le mot Toile est souvent utilisé dans les textes non techniques sans qu\'il soit clair si l\'auteur désigne le Web ou Internet. (Wikipédia)', '2021-03-20', '15:58:55');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
