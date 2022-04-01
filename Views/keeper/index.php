<?php
    $title = "Nos soigneurs";
    $keepers = $params['keepers'];
?>

<main>
    <h1>Nos soigneurs</h1>

    <div class="row">
        <?php foreach($keepers as $keeper) { ?>
            <div class="card">
                <h2><?= $keeper->getIdentity(); ?></h2>
                <img src="<?= $keeper->keeper_image_url ?>" alt="Photo de <?= $keeper->getIdentity() ?>">
                <p><?= $keeper->getSomeInfo() ?></p>
                <a href="<?= URL_PREFIX . "/keepers/" . $keeper->keeper_id ?>">En savoir plus</a>
            </div>
        <?php } ?>
    </div>
</main>
