<?php 
    $title = "Administration des soigneurs";
    $keepers = $params['keepers'] 
?>

<main>
    <h1>Administration des soigneurs</h1>
    <a href="<?= URL_PREFIX . "/admin/keepers/create" ?>">Ajouter un soigneur</a>

    <div class="row">
        <?php 
            foreach ($keepers as $keeper) { 
                $manager = $keeper->getManager($keeper->keeper_manager_id);
        ?>
            <div class="card">
                <img src="<?= $keeper->keeper_image_url ?>" alt="Photo de <?= $keeper->getIdentity() ?>">
                <p><?= $keeper->getDetails(); ?></p>

                <!-- If manager, display -->
                <?= (isset($manager)) ? "Manager : " . $manager->getIdentity() : ""; ?>

                <a href="<?= URL_PREFIX . "/admin/keepers/edit/" .  $keeper->keeper_id?>">Modifier</a>
                <form action="<?= URL_PREFIX . "/admin/keepers/delete/" .  $keeper->keeper_id?>" method="POST">
                    <button type="submit">Supprimer</button>
                </form>
            </div>
        <?php } ?>
    </div>
</main>