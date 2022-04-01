<?php
    $title = "Nos animaux";
    $animals = $params['animals'];
?>

<main>
    <h1>Nos animaux</h1>

    <div class="row">
        <?php foreach($animals as $animal) {
            // exclude dead animals
            if (!$animal->animal_death_date) { ?> 
            <div class="card">
                <h2><?= $animal->animal_name; ?></h2>
                <img src="<?= $animal->animal_image_url ?>" alt="Photo de <?= $animal->animal_name ?>">
                <p><?=  $animal->getSomeInfo(); ?></p>
                <a href="<?= URL_PREFIX . "/animals/" . $animal->animal_id ?>">En savoir plus</a>
            </div>
        <?php }} ?>
    </div>
</main>
