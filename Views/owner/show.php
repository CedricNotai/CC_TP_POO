<?php
use App\Models\Animal;
    $owner = $params['owner'];
    $adoptions = $params['adoptions'];
    $title = "Informations propriétaire - {$owner->getIdentity()}";
?>

<main>
    <h1><?= $owner->getIdentity() ?></h1>

    <h2>Qui suis-je</h2>
    <p><?= $owner->getAllInfo() ?></p>

    <?php foreach($adoptions as $adoption) { 
        if ($adoption->adoption_owner_id == $owner->owner_id) { 
            $animal = (new Animal($this->getDatabase()))->findById($adoption->adoption_animal_id);
            ?>
            <p>A adopté <?= $animal->animal_name ?> le <?= (new DateTime($adoption->adoption_date))->format('d/m/Y'); ?>.</p>
            <p>        
                <?= $adoption->adoption_return_date ? "Mais l'adoption a échoué. Retour au refuge le : " . (new DateTime($adoption->adoption_return_date))->format('d/m/Y') . "." : ""; ?>
            </p>
            <p><?= $adoption->adoption_info ? "Infos :" . $adoption->adoption_info : ""?></p>
            <p><?= $adoption->adoption_price ? "Prix de l'adoption : " . $adoption->adoption_price . " euros." : "Adoption gratuite."?></p>
        <?php } 
    } ?>
    
    <a href="<?= URL_PREFIX . "/owners/" ?>">Retour à la liste des propriétaires</a>
</main>