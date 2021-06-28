<?php

$page_title = 'Créer un compte';
ob_start();
?>
	
	<form action="../../index.php" method="post">
		<div>
			<label for="pseudo">Pseudo </label><input type="text" id="pseudo" name="pseudo" minlength="2" required>
		</div>
		<div>
			<label for="mail">E-mail </label><input type="email" id="mail" name="mail" required>
		</div>
		<div>
			<label for="password">Mot de passe (8 charactères min.) </label><input type="password" id="password" name="password" minlength="8" required>
		</div>
		<div class="button">
			<button type="submit">Envoyer</button>
		</div>
	</form>

<?php

if (isset ($_GET['field']) && $_GET['field'] === 'empty')
{
	echo '<p>Il faut renseigner tous les champs.</p>';
}

if (isset($_GET['exists'])) {
	switch ($_GET['exists']) {
		case 'pseudo':
			echo '<p>Ce pseudo existe déjà.</p>';
			break;
		case 'mail':
			echo '<p>Cet email existe déjà.</p>';
			break;
		case 'pseudomail':
			echo '<p>Ce pseudo et cet email existent déjà.</p>';
			break;
	}
}

$page_content = ob_get_clean();
require(__DIR__ . '/../template.php');
?>