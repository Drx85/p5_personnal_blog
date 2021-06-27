<?php
    $page_title = 'Bienvenue sur mon blog !';
    ob_start();
?>

<h2>Les derniers billets</h2>

    <?php
        while ($display_blog = $blog->fetch())
        {
    ?>
            <h3><?= htmlspecialchars($display_blog['title']) ?></h3>
            <p>Posté le <?= $display_blog['post_date'] ?>
				à <?= $display_blog['hour_post_time'] ?>h<?= $display_blog['minute_poste_time'] ?>
				<?php
				if (isset($display_blog['update_date']))
				{
					echo '(dernière modification le ' . $display_blog['update_date'] . '),';
				}
				?>
				par : <?= htmlspecialchars($display_blog['author']) ?><br/>
                <?= nl2br(htmlspecialchars($display_blog['message'])) ?></p>

    <?php
            $display_nb = $comments_number[$increment_comments_number++]['number_of_comments'];

            if (! $display_nb == 0)
            {
    ?>
                <p><a href="index.php?comment=<?= $display_blog['id'] ?>">Voir les commentaires (<?= $display_nb ?>)</a></p>
    <?php
            }

            else
            {
    ?>
                <p><a href="index.php?comment=<?= $display_blog['id'] ?>">Il n'y a pas de commentaire sur ce billet. Cliquez ici pour en ajouter un.</a></p>
    <?php
            }

            $error_page = false;
        }

        if ($error_page)
        {
            throw new Exception('<p>Oups ! On dirait que cette page n\'existe pas...</p><a href="index.php">Retour à la page principale</a>');
        }
    ?>

<p>
    Pages : |

    <?php
        foreach($array_pages as $display_pages)
        {
    ?>
            <a href="index.php?page=<?= $display_pages ?>"><?= $display_pages ?></a> |
    <?php
        }
    ?>
</p>

<?php
    $page_content = ob_get_clean();
    require(__DIR__ . '/../template.php');
?>