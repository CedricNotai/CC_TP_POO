<?php
    $adoption = $params['adoption'];
    $animal = $params['animal'];
    $owner = $params['owner'];
    $title = "Informations adoption";
    $adoptionDate = (new DateTime($adoption->adoption_date))->format('d/m/Y');
    $returnDate = (new DateTime($adoption->adoption_return_date))->format('d/m/Y');
?>


<main>
    <h1><?= "Adoption de " . $animal->animal_name . " par " . $owner->getIdentity() ?></h1>

    <p>Animal : <?= $animal->animal_name ?></p>
    <p>Propriétaire : <?= $owner->getIdentity() ?></p>
    <p>Date de l'adoption : <?= $adoptionDate ?></p>
    <?= $adoption->adoption_return_date ? "L'adoption a échoué. <br> L'animal est revenu le " . $returnDate . ".": ""; ?>
    <p>Prix de l'adoption : <?= $adoption->adoption_price ?> euros</p>
    <?= $adoption->adoption_info ? "Informations supplémentaires : " . $adoption->adoption_info : "" ?></p>

    <a href="<?= URL_PREFIX . "/adoptions/" ?>">Retour à la liste des adoptions</a>
</main>