<?php
session_start();

$_SESSION = array();
session_destroy();

header ("Refresh: 3;URL=../../index.php");

$page_title = 'Déconnection effectuée avec succès !';
ob_start();

?>
	<p>Vous vous êtes bien déconnecté.</p>
	<p>Vous allez redirigé vers la page d'accueil dans 3 secondes...</p>
	<p><a href="../index.php">Cliquez ici si vous ne souhaitez pas attendre :)</a></p>
<?php
$page_content = ob_get_clean();
require(__DIR__ . '/../template.php');
?>
