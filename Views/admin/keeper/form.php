<?php 
    $title = "Ajout ou modification de soigneur";
    if (isset($params['keeper'])) {
        $keeper = $params['keeper'];
        $entryDate = (new DateTime($keeper->keeper_entry_date))->format('Y-m-d');
        $exitDate = (new DateTime($keeper->keeper_exit_date))->format('Y-m-d');
    }

    $keepersList = $params['keepersList'];
    $animalsList = $params['animalsList'];
?>

<main>
    <h1><?= isset($params['keeper']) ? "Modifier {$keeper->getIdentity()}" : "Ajouter un soigneur" ?></h1>
    <form action="<?= !isset($keeper) ? "create" : URL_PREFIX . "/admin/keepers/edit/{$keeper->keeper_id}" ?>" method="POST">
        <div>
            <label for="keeper_first_name">Prénom du soigneur</label>
            <input type="text" name="keeper_first_name" id="keeper_first_name" value="<?= $keeper->keeper_first_name ?? '' ?>" required>
        </div>

        <div>
            <label for="keeper_last_name">Nom du soigneur</label>
            <input type="text" name="keeper_last_name" id="keeper_last_name" value="<?= $keeper->keeper_last_name ?? '' ?>" required>
        </div>

        <div>
            <label for="keeper_gender">Sexe</label>
            <select name="keeper_gender" id="keeper_gender" required>
                <option value=""> Choisir... </option>
                <option value="f" <?= isset($params['keeper']) ? (strtolower($keeper->keeper_gender) == "f" ? "selected" : "") : "" ?> >Femme</option>
                <option value="m" <?= isset($params['keeper']) ? (strtolower($keeper->keeper_gender) == "m" ? "selected" : "") : "" ?> >Homme</option>
            </select>
        </div>

        <div>
            <label for="keeper_image_url">URL de la photo</label>
            <input type="text" name="keeper_image_url" id="keeper_image_url" value="<?= $keeper->keeper_image_url ?? '' ?>" required>
        </div>

        <div>
            <label for="keeper_phone">Numéro de téléphone</label>
            <input type="tel" name="keeper_phone" id="keeper_phone" value="<?= $keeper->keeper_phone ?? '' ?>">
        </div>

        <div>
            <label for="keeper_email">Adresse mail</label>
            <input type="email" name="keeper_email" id="keeper_email" value="<?= $keeper->keeper_email ?? '' ?>">
        </div>

        <div>
            <label for="keeper_speciality">Spécialité</label>
            <input type="text" name="keeper_speciality" id="keeper_speciality" value="<?= $keeper->keeper_speciality ?? '' ?>">
        </div>

        <div>
            <label for="keeper_max_daily_treatments">Nombre de soins maximum par jour</label>
            <input type="number" name="keeper_max_daily_treatments" id="keeper_max_daily_treatments" value="<?= $keeper->keeper_max_daily_treatments ? $keeper->keeper_max_daily_treatments : 0 ?>">
        </div>

        <div>
            <label for="keeper_entry_date">Date d'entrée</label>
            <input type="date" name="keeper_entry_date" id="keeper_entry_date" value="<?= $entryDate ?? '' ?>" required>
        </div>

        <div>
            <label for="keeper_exit_date">Date de sortie (si pas de sortie, laisser 01/01/1970 par défaut)</label>
            <input 
                type="date" 
                name="keeper_exit_date" 
                id="keeper_exit_date" 
                <?php if (isset($params['keeper']) && $keeper->keeper_exit_date) {
                    echo "value=" . $exitDate;
                } else {
                    echo "value=1970-01-01";
                } ?>
            >
        </div>

        <div>
            <label for="keeper_info">Informations sur le soigneur</label>
            <textarea name="keeper_info" id="keeper_info"><?= $keeper->keeper_info ?? '' ?></textarea>
        </div>

        <div>
            <label for="keeper_manager_id">Manager</label>
            <select name="keeper_manager_id" id="keeper_manager_id">
                <option value=""> Choisir... </option>

                <?php foreach($keepersList as $manager) { ?>
                    <option 
                        value="<?= $manager->keeper_id ?>" 
                        <?php if(isset($params['keeper'])) {
                            if ($keeper->keeper_manager_id == $manager->keeper_id) {
                                echo "selected";
                            }
                        } ?>
                    >
                            <?= $manager->getIdentity(); ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <button type="submit">Valider</button>
    </form>
</main>

<a href="<?= URL_PREFIX . "/admin/keepers/" ?>">Retour à la liste des soigneurs</a>
