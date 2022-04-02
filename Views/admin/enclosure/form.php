<?php 
    $title = "Enregistrement ou modification d'enclos";
    if (isset($params['enclosure'])) {
        $enclosure = $params['enclosure'];
    }
?>

<main>
    <h1><?= isset($params['enclosure']) ? "Modifier le enclos" : "Enregistrer un nouveau enclos" ?></h1>

    <form action="<?= !isset($enclosure) ? "create" : URL_PREFIX . "/admin/enclosures/edit/{$enclosure->enclosure_id}" ?>" method="POST">
        <div>
            <label for="enclosure_name">Nom de l'enclos : </label>
            <input type="text" name="enclosure_name" id="enclosure_name" value="<?= $enclosure->enclosure_name ?? '' ?>">
        </div>

        <div>
            <label for="enclosure_particularity">Particularité de l'enclos : </label>
            <input type="text" name="enclosure_particularity" id="enclosure_particularity" value="<?= $enclosure->enclosure_particularity ?? '' ?>">
        </div>

        <div>
            <label for="enclosure_info">Informations supplémentaires : </label>
            <input type="text" name="enclosure_info" id="enclosure_info" value="<?= $enclosure->enclosure_info ?? '' ?>">
        </div>

        <button type="submit">Valider</button>
    </form>
</main>

<a href="<?= URL_PREFIX . "/admin/treatments/" ?>">Retour à la liste des enclos</a>
