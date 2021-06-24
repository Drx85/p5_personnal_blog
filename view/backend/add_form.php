<?php
    $page_title = 'Ajouter un billet';
    ob_start();
?>

<form method="post" action="../../backend/back_index.php">
    <p>
        <label for="title">Titre : </label> <input type="text" name="title" /> <br/>
        <label for="post_content">Contenu du billet : <br/></label> <textarea name="post_content" rows="20" cols="150"></textarea> <br/>
        <input type="submit" name="validate_post"/>
    </p>
</form>

<?php
    if(isset($_GET['empty_field']) AND $_GET['empty_field'])
    {
        echo '<p>Veuillez rentrer un titre et le contenu du billet</p>';
    }
?>

<p><a href="../../backend/back_index.php">Retour à la page principale</a></p>

<?php
    $page_content = ob_get_clean();
    require(__DIR__ . '/../template.php');
?>