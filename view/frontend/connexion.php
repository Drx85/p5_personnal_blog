<?php

$page_title = 'Se connecter';
ob_start();
?>

<form action="../../index.php" method="post">
	
	<label><b>Nom d'utilisateur</b></label>
	<input type="text" placeholder="Entrer votre pseudo" name="username" required>
	
	<label><b>Mot de passe</b></label>
	<input type="password" placeholder="Entrer le mot de passe" name="password" required>
	
	<input type="submit" id='submit' value='Connection' >
	<?php
	if (isset($_GET['connect']) && $_GET['connect'] === 'false') {
		echo '<p>Mauvais nom d\'utilisateur ou mot de passe.</p>';
	}
	?>
</form>

<?php
$page_content = ob_get_clean();
require(__DIR__ . '/../template.php');
?>
