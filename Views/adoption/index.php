<?php
    use App\Models\Owner;
    use App\Models\Animal;

    $title = "Les adoptions";
    $adoptions = $params['adoptions'];
?>

<main>
    <h1>Les adoptions</h1>

    <div class="row">
        <?php foreach($adoptions as $adoption) { 
            $adoptedAnimal = (new Animal($this->getDataBase()))->findById($adoption->getAnimalId()->animal_id);
            $owner = (new Owner($this->getDatabase()))->findById($adoption->getOwnerId()->owner_id);
        ?>
            <div class="card">
                <img src="<?= $adoptedAnimal->animal_image_url ?>" alt="Photo de <?= $adoptedAnimal->animal_name ?>">
                <h2><?= "Adoption de " . $adoptedAnimal->animal_name . " par " . $owner->getIdentity() ?></h2>
                <a href="<?= URL_PREFIX . "/adoptions/" . $adoption->adoption_id ?>">En savoir plus</a>
            </div>
        <?php } ?>
    </div>
</main>
