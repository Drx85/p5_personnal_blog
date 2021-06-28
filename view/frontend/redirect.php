<?php
session_start();
header ("Refresh: 3;URL=../../index.php");

$page_title = 'Operation effectuée avec succès !';
ob_start();

switch ($_GET['redirect']) {
	case 'register':
		echo '<p>Votre compte a été créé avec succès !</p>';
		break;
}
?>

<p>Vous allez redirigé vers la page d'accueil dans 3 secondes...</p>
<p><a href="../../index.php">Cliquez ici si vous ne souhaitez pas attendre :)</a></p>

<?php
$page_content = ob_get_clean();
require(__DIR__ . '/../template.php');
?>
