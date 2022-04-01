<?php 
    $title = "Ajout ou modification d'animal";
    if (isset($params['animal'])) {
        $animal = $params['animal'];
        $entryDate = (new DateTime($animal->animal_entry_date))->format('Y-m-d');
        $birthDate = (new DateTime($animal->animal_birth_date))->format('d/m/Y');
        $deathDate = (new DateTime($animal->animal_death_date))->format('d/m/Y');
    }

    $keepersList = $params['keepersList'];
    $enclosuresList = $params['enclosuresList'];

?>

<main>
    <h1><?= isset($params['animal']) ? "Modifier {$animal->animal_name}" : "Ajouter un animal" ?></h1>

    <form action="<?= !isset($animal) ? "create" : URL_PREFIX . "/admin/animals/edit/{$animal->animal_id}" ?>" method="POST">
        <div>
            <label for="animal_name">Nom de l'animal</label>
            <input type="text" name="animal_name" id="animal_name" value="<?= $animal->animal_name ?? '' ?>" required>
        </div>

        <div>
            <label for="animal_species">Espèce de l'animal</label>
            <input type="text" name="animal_species" id="animal_species" value="<?= $animal->animal_species ?? '' ?>" required>
        </div>

        <div>
            <label for="animal_gender">Sexe</label>
            <select name="animal_gender" id="animal_gender" required>
                <option value=""> Choisir... </option>
                <option value="f" <?= isset($params['animal']) ? (strtolower($animal->animal_gender) == "f" ? "selected" : "") : "" ?> >Femelle</option>
                <option value="m" <?= isset($params['animal']) ? (strtolower($animal->animal_gender) == "m" ? "selected" : "") : "" ?> >Mâle</option>
            </select>
        </div>

        <div>
            <label for="animal_image_url">URL de la photo</label>
            <input type="text" name="animal_image_url" id="animal_image_url" value="<?= $animal->animal_image_url ?? '' ?>" required>
        </div>

        <div>
            <label for="animal_weight">Poids (kg)</label>
            <input type="number" name="animal_weight" id="animal_weight" value="<?= $animal->animal_weight ?? '' ?>" required>
        </div>

        <div>
            <label for="animal_entry_date">Date d'entrée au refuge</label>
            <input type="date" name="animal_entry_date" id="animal_entry_date" value="<?= $entryDate ?? '' ?>" required>
        </div>

        <div>
            <label for="animal_birth_date">Date de naissance</label>
            <input type="date" name="animal_birth_date" id="animal_birth_date" value="<?= $birthDate ?? '' ?>" required>
        </div>

        <div>
            <label for="animal_death_date">Date de décès (si l'animal n'est pas décédé, laisser 01/01/1970 par défaut)</label>
            <input 
                type="date" 
                name="animal_death_date" 
                id="animal_death_date" 
                <?php if (isset($params['animal']) && $animal->animal_death_date) {
                    echo "value=" . $deathDate;
                } else {
                    echo "value=1970-01-01";
                } ?>
            >
        </div>

        <div>
            <label for="animal_chip_number">Numéro de puce</label>
            <input type="number" name="animal_chip_number" id="animal_chip_number" value="<?= $animal->animal_chip_number ?? '' ?>" required>
        </div>

        <div>
            <label for="animal_info">Informations complémentaires</label>
            <textarea name="animal_info" id="animal_info"><?= $animal->animal_info ?? '' ?></textarea>
        </div>

        <div>
            <label for="animal_favorite_keeper">Assigner un soigneur préféré</label>
            <select name="animal_favorite_keeper" id="animal_favorite_keeper">
                <option value=""> Choisir... </option>

                <?php foreach($keepersList as $keeper) { ?>
                    <option 
                        value="<?= $keeper->keeper_id ?>" 
                        <?php if(isset($params['animal'])) {
                            if ($animal->animal_favorite_keeper == $keeper->keeper_id) {
                                echo "selected";
                            }
                        } ?>
                    >
                            <?= $keeper->getIdentity(); ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div>
            <label for="animal_enclosure_id">Assigner un enclos</label>
            <select name="animal_enclosure_id" id="animal_enclosure_id" required>
                <option value=""> Choisir... </option>

                <?php foreach($enclosuresList as $enclosure) { ?>
                    <option 
                        value="<?= $enclosure->enclosure_id ?>" 
                        <?php if(isset($params['animal'])) {
                            if ($animal->animal_enclosure_id == $enclosure->enclosure_id) {
                                echo "selected";
                            }
                        } ?>
                    >
                            <?= $enclosure->getName(); ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <button type="submit">Valider</button>
    </form>
</main>

<a href="<?= URL_PREFIX . "/admin/keepers/" ?>">Retour à la liste des soigneurs</a>
