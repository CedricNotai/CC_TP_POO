<?php 
    $title = "Ajout ou modification de propriétaire";
    if (isset($params['owner'])) {
        $owner = $params['owner'];
        $registrationDate = (new DateTime($owner->owner_registration_date))->format('Y-m-d');
    }
?>

<main>
    <h1><?= isset($params['owner']) ? "Modifier {$owner->getIdentity()}" : "Ajouter un propriétaire" ?></h1>

    <form action="<?= !isset($owner) ? "create" : URL_PREFIX . "/admin/owners/edit/{$owner->owner_id}" ?>" method="POST">
        <div>
            <label for="owner_first_name">Prénom du propriétaire</label>
            <input type="text" name="owner_first_name" id="owner_first_name" value="<?= $owner->owner_first_name ?? '' ?>" required>
        </div>

        <div>
            <label for="owner_last_name">Nom du propriétaire</label>
            <input type="text" name="owner_last_name" id="owner_last_name" value="<?= $owner->owner_last_name ?? '' ?>" required>
        </div>

        <div>
            <label for="owner_address">Adresse</label>
            <input type="text" name="owner_address" id="owner_address" value="<?= $owner->owner_address ?? '' ?>" required>
        </div>

        <div>
            <label for="owner_zip_code">Code postal</label>
            <input type="text" name="owner_zip_code" id="owner_zip_code" value="<?= $owner->owner_zip_code ?? '' ?>" required>
        </div>

        <div>
            <label for="owner_city">Ville</label>
            <input type="text" name="owner_city" id="owner_city" value="<?= $owner->owner_city ?? '' ?>" required>
        </div>

        <div>
            <label for="owner_phone">Numéro de téléphone</label>
            <input type="tel" name="owner_phone" id="owner_phone" value="<?= $owner->owner_phone ?? '' ?>" required>
        </div>

        <div>
            <label for="owner_email">Adresse mail</label>
            <input type="email" name="owner_email" id="owner_email" value="<?= $owner->owner_email ?? '' ?>" required>
        </div>

        <div>
            <label for="owner_registration_date">Date d'enregistrement</label>
            <input type="date" name="owner_registration_date" id="owner_registration_date" value="<?= $registrationDate ?? '' ?>" required>
        </div>

        <div>
            <label for="owner_info">Informations sur le propriétaire</label>
            <textarea name="owner_info" id="owner_info"><?= $owner->owner_info ?? '' ?></textarea>
        </div>

        <button type="submit">Valider</button>
    </form>
</main>

<a href="<?= URL_PREFIX . "/admin/owners/" ?>">Retour à la liste des propriétaires</a>