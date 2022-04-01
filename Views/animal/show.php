<?php
use App\Models\Owner;
use App\Models\Keeper;

    $animal = $params['animal'];
    $favoriteKeeper = $params['favoriteKeeper'] ? $params['favoriteKeeper'] : null;
    $enclosure = $params['currentEnclosure'];
    $treatmentList = $params['treatments'] ? $params['treatments'] : null;
    $title = "Informations animal - {$animal->animal_name}";
    $adoptions = $params['adoptions'];
?>


<main>
    <h1><?= $animal->animal_name ?></h1>

    <img src="<?= $animal->animal_image_url ?>" alt="Photo de <?= $animal->animal_name ?>">
    <h2>Qui suis-je ?</h2>
    <p><?= $animal->getAllInfo() ?></p>

    <p>
        <?php if (isset($favoriteKeeper)) {
            echo "Mon soigneur préféré est " . $favoriteKeeper->getIdentity() . ".";
        } else {
            echo "Je n'ai pas de soigneur préféré. J'aime tout le monde !";
        } ?>
    </p>

    <p>Je suis actuellement dans l'enclos <?= $enclosure->getName(); ?>.</p>

    <?php if (isset($treatmentList)) { ?>
        <h2>Mes traitements</h2>
        <ul>
            <?php foreach($treatmentList as $treatment) { 
                    $treatmentKeeper = (new Keeper($this->getDatabase()))->findById($treatment->treatment_keeper_id);
                ?>
                    <li>Soin <?= $treatment->treatment_name ? $treatment->treatment_name : 'non défini' ?> prodigué par <?= $treatmentKeeper->getIdentity(); ?>.</li>
            <?php } ?>
        </ul>
    <?php } ?>

    <?php foreach($adoptions as $adoption) { 
        if ($adoption->adoption_animal_id == $animal->animal_id) { 
            $owner = (new Owner($this->getDatabase()))->findById($adoption->adoption_owner_id);
            ?>
        <p>Adopté par <?= $owner->getIdentity() ?></p>
        <p>Le <?= (new DateTime($adoption->adoption_date))->format('d/m/Y'); ?></p>
        <?= $adoption->adoption_info ? "Infos :" . $adoption->adoption_info . "<br>" : ""?>
        <?= $adoption->adoption_price ? "Prix : " . $adoption->adoption_price . " euros <br>" : ""?>
        <?= $adoption->adoption_return_date ? "Adoption échouée. Retour au refuge le : " . (new DateTime($adoption->adoption_return_date))->format('d/m/Y') . "<br>" : ""; ?>

        <?php } 
    } ?>
</main>
