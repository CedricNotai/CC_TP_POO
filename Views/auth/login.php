<?php 
    $title = "Se connecter";
?>

<h1>Se connecter</h1>

<form action="<?= URL_PREFIX . "/login" ?>" method="POST">

    <div>
        <label for="user_name">Nom d'utilisateur</label>
        <input type="text" name="user_name" id="user_name">
    </div>

    <div>
        <label for="user_password">Mot de passe</label>
        <input type="password" name="user_password" id="user_password">
    </div>

    <button type="submit">Se connecter</button>
</form>

<a href="<?= URL_PREFIX . "/" ?>">Retour à l'accueil</a>
