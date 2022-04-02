<?php
    $keeper = $params['keeper'];
    $title = "Informations soigneur - {$keeper->getIdentity()}";
?>

<main>
    <h1><?= $keeper->getIdentity() ?></h1>

    <img src="<?= $keeper->keeper_image_url ?>" alt="Photo de <?= $keeper->getIdentity() ?>">
    <h2>Qui suis-je</h2>
    <p><?= $keeper->getDetails() ?></p>

    <?php 
        $treatedAnimals = $keeper->getTreatedAnimals($keeper->keeper_id);
        if ($treatedAnimals) { ?>
            <h2>Les animaux que je traite</h2>

            <?php foreach ($treatedAnimals as $animal) { ?>
                <p><?= $animal->animal_name; ?></p>
             <?php } 
        } else { ?>

        <p>Aucun animal traité.</p>

        <?php } ?>
    
    <a href="<?= URL_PREFIX . "/keepers/" ?>">Retour à la liste des soigneurs</a>

</main>