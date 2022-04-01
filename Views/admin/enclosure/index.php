<?php 
    $title = "Administration des enclos";
    $enclosures = $params['enclosures'];
?>

<main>
    <h1>Administration des enclos</h1>
    <a href="<?= URL_PREFIX . "/admin/enclosures/create" ?>">Ajouter un enclos</a>

    <div class="row">
        <?php 
        foreach ($enclosures as $enclosure) { ?>
            <div class="card">
                <p>Enclos n° <?= $enclosure->enclosure_id ?></p>
                <p>Nom de l'enclos : <?= $enclosure->enclosure_name ? $enclosure->enclosure_name : "non déterminé" ?></p>
                <p>Particularité de l'enclos : <?= $enclosure->enclosure_particularity ?></p>
                <p>Infos sur l'enclos : <?= $enclosure->enclosure_info ?></p>
                <a href="<?= URL_PREFIX . "/admin/enclosures/edit/" .  $enclosure->enclosure_id?>">Modifier</a>
                <form action="<?= URL_PREFIX . "/admin/enclosures/delete/" .  $enclosure->enclosure_id?>" method="POST">
                    <button type="submit">Supprimer</button>
                </form>
            </div>
        <?php } ?>
    </div>
</main>