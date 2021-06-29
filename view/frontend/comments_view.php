<?php
	session_start();
    $page_title = 'Bienvenue sur mon blog !';
    ob_start();

    if (empty($post))
    {
        throw new Exception('<p>Oups ! On dirait que cette page n\'existe pas...</p><a href="index.php">Retour à la page principale</a>');
    }

    else
    {
?>
		<p>
			<h3>Commentaires du billet : <?= htmlspecialchars($post['title']) ?> </h3>
			Posté le <?= $post['post_date'] ?> à <?= $post['hour_post_time'] ?>h<?= $post['minute_poste_time'] ?>
			<?php
			if (isset($post['update_date'])) {
				echo '(dernière modification le ' . $post['update_date'] . '),';
			}
			?>
			par : <?= htmlspecialchars($post['author']) ?>
		</p>
		<p>
			<?= nl2br(htmlspecialchars($post['message'])) ?>
		</p>
		
		<h4>Commentaires :</h4>
<?php
    }

    while ($blog_comment = $blog_comments->fetch())
    {
?>
        <p>Commentaire du <?= $blog_comment['comment_date'] ?>, à <?= $blog_comment['hour_comment_time'] ?>h<?=
            $blog_comment['minute_comment_time'] ?> - par <?= htmlspecialchars($blog_comment['author']) ?> :<br/> <?=
            nl2br(htmlspecialchars($blog_comment['text_comment'])) ?> </p>
	
		<?php
		if (isset($_SESSION['role'])) {
			if ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'publisher') {
				echo '<p><a href="index.php?delete_comment=' . $blog_comment["id"] . '">Supprimer ce commentaire</a></p>';
				}
			}
		?>
<?php
    }

if (isset($_SESSION['user_id'])) {
	?>
	<h4>Ajouter un commentaire</h4>
	
	<form method="post" action="index.php?send_comment=<?= $_GET['comment'] ?>">
		<p>
			<label for="pseudo">Votre pseudo : </label> <input type="text" name="pseudo"/> <br/>
			<label for="user_comment">Votre commentaire : <br/></label> <textarea name="user_comment" rows="3" cols="80"></textarea> <br/>
			<input type="submit" name="validate_comment"/>
		</p>
	</form>
	<?php
}
	?>

<p><a href="index.php">Retour à la page principale</a></p>

<?php
    $page_content = ob_get_clean();
    require(__DIR__ . '/../template.php');
?>