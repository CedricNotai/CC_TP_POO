<?php
    $title = "Les propriétaires";
    $owners = $params['owners'];
?>

<main>
    <h1>Les propriétaires</h1>

    <div class="row">
        <?php foreach($owners as $owner) { ?>
            <div class="card">
                <h2><?= $owner->getIdentity(); ?></h2>
                <a href="<?= URL_PREFIX . "/owners/" . $owner->owner_id ?>">En savoir plus</a>
            </div>
        <?php } ?>
    </div>
</main>
