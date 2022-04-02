<?php 
    $title = "Modification du refuge";
    if (isset($params['refuge'])) {
        $refuge = $params['refuge'];
    }
?>

<main>
    <h1>Modifier le refuge</h1>
    
    <form action="<?= URL_PREFIX . "/admin/refuge/edit/" . $refuge->refuge_id ?>" method="POST">
        <div>
            <label for="refuge_name">Nom du refuge</label>
            <input type="text" name="refuge_name" id="refuge_name" value="<?= $refuge->refuge_name ?? '' ?>">
        </div>

        <div>
            <label for="refuge_address">Adresse</label>
            <input type="text" name="refuge_address" id="refuge_address" value="<?= $refuge->refuge_address ?? '' ?>" required>
        </div>

        <div>
            <label for="refuge_zip_code">Code postal</label>
            <input type="text" name="refuge_zip_code" id="refuge_zip_code" value="<?= $refuge->refuge_zip_code ?? '' ?>" required>
        </div>

        <div>
            <label for="refuge_city">Ville</label>
            <input type="text" name="refuge_city" id="refuge_city" value="<?= $refuge->refuge_city ?? '' ?>" required>
        </div>

        <div>
            <label for="refuge_phone">Numéro de téléphone</label>
            <input type="tel" name="refuge_phone" id="refuge_phone" value="<?= $refuge->refuge_phone ?? '' ?>" required>
        </div>

        <button type="submit">Valider</button>
    </form>
</main>

<a href="<?= URL_PREFIX . "/admin/treatments/" ?>">Retour à la liste des traitements</a>