<!DOCTYPE html>

<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Bienvenue sur mon blog !</title>
</head>

<body>

<h1><?= $page_title ?></h1>

<?= $page_content ?>

<?php

if (! isset($_SESSION['user_id'])) {
	echo '<a href = "/p5_personnal_blog/public/index.php?p=register&action=register"> Créer un compte </a ></br >
	<a href = "/p5_personnal_blog/public/index.php?p=connexion"> Se connecter </a>';
}
else {
	echo 'Connecté en tant que ' . $_SESSION['pseudo'] . ' (' . $_SESSION['role'] . ')</br>
	<a href="/p5_personnal_blog/public/frontend/disconnection.php?p=connexion">Se déconnecter</a>';
}

?>

</body>

</html>