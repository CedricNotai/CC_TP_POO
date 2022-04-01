<?php 
    $title = "Administration des propriétaires";
    $owners = $params['owners'] 
?>

<main>
    <h1>Administration des propriétaires</h1>
    <a href="<?= URL_PREFIX . "/admin/owners/create" ?>">Ajouter un propriétaire</a>

    <div class="row">
        <?php 
            foreach ($owners as $owner) { 
        ?>
            <div class="card">
                <p><?= $owner->getAllInfo(); ?></p>
                <a href="<?= URL_PREFIX . "/admin/owners/edit/" .  $owner->owner_id?>">Modifier</a>
                <form action="<?= URL_PREFIX . "/admin/owners/delete/" .  $owner->owner_id?>" method="POST">
                    <button type="submit">Supprimer</button>
                </form>
            </div>
        <?php } ?>
    </div>
</main>