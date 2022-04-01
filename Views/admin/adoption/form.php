<?php 
    $title = "Enregistrement ou modification d'une adoption";
    if (isset($params['adoption'])) {
        $adoption = $params['adoption'];
        $adoptionDate = (new DateTime($adoption->adoption_date))->format('Y-m-d');
        $returnDate = ($adoption->adoption_return_date) ?? (new DateTime($adoption->adoption_return_date))->format('Y-m-d');;
    }
    $animalsList = $params['animalsList'];
    $ownersList = $params['ownersList'];

?>

<main>
    <h1><?= isset($params['adoption']) ? "Modifier l'adoption" : "Enregistrer une nouvelle adoption" ?></h1>

    <form action="<?= !isset($adoption) ? "create" : URL_PREFIX . "/admin/adoptions/edit/{$adoption->adoption_id}" ?>" method="POST">
        <div>
            <label for="adoption_animal_id">Animal adopté</label>
            <select name="adoption_animal_id" id="adoption_animal_id" required>
                <option value=""> Choisir... </option>

                <?php foreach($animalsList as $animal) { ?>
                    <option 
                        value="<?= $animal->animal_id ?>" 
                        <?php if(isset($params['adoption'])) {
                            if ($adoption->adoption_animal_id == $animal->animal_id) {
                                echo "selected";
                            }
                        } ?>
                    >
                            <?= $animal->animal_name; ?>
                    </option>
                <?php } ?>
            </select>

            <p>Si l'animal n'apparaît pas dans la liste, <a href="<?= URL_PREFIX . "/admin/animals/create" ?>">il faut d'abord l'ajouter</a></p> 
        </div>

        <div>
            <label for="adoption_owner_id">Propriétaire</label>
            <select name="adoption_owner_id" id="adoption_owner_id" required>
                <option value=""> Choisir... </option>

                <?php foreach($ownersList as $owner) { ?>
                    <option 
                        value="<?= $owner->owner_id ?>" 
                        <?php if(isset($params['adoption'])) {
                            if ($adoption->adoption_owner_id == $owner->owner_id) {
                                echo "selected";
                            }
                        } ?>
                    >
                            <?= $owner->getIdentity(); ?>
                    </option>
                <?php } ?>
            </select>

            <p>Si le propriétaire n'apparaît pas dans la liste, <a href="<?= URL_PREFIX . "/admin/owners/create" ?>">il faut d'abord l'ajouter</a></p>
        </div>

        <div>
            <label for="adoption_date">Date de l'adoption</label>
            <input type="date" name="adoption_date" id="adoption_date" value="<?= $adoptionDate ?? '' ?>" required>
        </div>

        <?php if (isset($params['adoption'])) { ?>
            <div>
            <label for="adoption_return_date">Si l'adoption a échoué, merci de renseigner la date de retour. Sinon, laisser le 01/01/1970 par défaut</label>
            <input 
                type="date" 
                name="adoption_return_date" 
                id="adoption_return_date" 
                <?php if (isset($params['adoption']) && $adoption->adoption_return_date) {
                    echo "value=" . $returnDate ;
                } else {
                    echo "value=1970-01-01";
                } ?>
            >
        </div>
        <?php } ?>

        <div>
            <label for="adoption_price">Prix de l'adoption</label>
            <input type="number" name="adoption_price" id="adoption_price" value="<?= $adoption->adoption_price ?? '' ?>" required>
        </div>

        <div>
            <label for="adoption_info">Informations sur l'adoption</label>
            <textarea name="adoption_info" id="adoption_info"><?= $adoption->adoption_info ?? '' ?></textarea>
        </div>

        <button type="submit">Valider</button>
    </form>
</main>

<a href="<?= URL_PREFIX . "/admin/adoptions/" ?>">Retour à la liste des adoptions</a>