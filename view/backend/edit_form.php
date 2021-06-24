<?php
    $page_title = 'Modifier un billet';
    ob_start();
?>
    <form method="post" action="back_index.php?sent_edit_post=<?= $_GET['edit_post'] ?>">
        <p>
            <label for="edit_title">Titre : </label> <input type="text" name="edit_title" value="<?= $edit_values['title'] ?>"/> <br/>
            <label for="edit_post_content">Contenu du billet : <br/></label> <textarea name="edit_post_content" rows="20" cols="150"><?= $edit_values['message'] ?></textarea> <br/>
            <input type="submit" name="validate_edit"/>
        </p>
    </form>

<p><a href="back_index.php">Retour à la page principale</a></p>

<?php
    $page_content = ob_get_clean();
    require(__DIR__ . '/../template.php');
?>