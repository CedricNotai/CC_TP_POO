<?php
    $owner = $params['owner'];
    $title = "Informations propriétaire - {$owner->getIdentity()}";
?>


<main>
    <h1><?= $owner->getIdentity() ?></h1>

    <h2>Qui suis-je</h2>
    <p><?= $owner->getAllInfo() ?></p>
    
    <a href="<?= URL_PREFIX . "/owners/" ?>">Retour à la liste des propriétaires</a>
</main>