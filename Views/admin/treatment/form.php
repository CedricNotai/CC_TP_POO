<?php 
    $title = "Enregistrement ou modification de traitement";
    if (isset($params['treatment'])) {
        $treatment = $params['treatment'];
    }
    $keepersList = $params['keepersList'];
    $animalsList = $params['animalsList'];
?>

<main>
    <h1><?= isset($params['treatment']) ? "Modifier le traitement" : "Enregistrer un nouveau traitement" ?></h1>
    
    <form action="<?= !isset($treatment) ? "create" : URL_PREFIX . "/admin/treatments/edit/{$treatment->treatment_id}" ?>" method="POST">
        <div>
            <label for="treatment_name">Nom du soin</label>
            <input type="text" name="treatment_name" id="treatment_name" value="<?= $treatment->treatment_name ?? '' ?>">
        </div>

        <div>
            <label for="treatment_animal_id">Animal bénéficiaire</label>
            <select name="treatment_animal_id" id="treatment_animal_id" required>
                <option value=""> Choisir... </option>

                <?php foreach($animalsList as $animal) { ?>
                    <option 
                        value="<?= $animal->animal_id ?>" 
                        <?php if(isset($params['treatment'])) {
                            if ($treatment->treatment_animal_id == $animal->animal_id) {
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
            <label for="treatment_keeper_id">Soin prodigué par</label>
            <select name="treatment_keeper_id" id="treatment_keeper_id" required>
                <option value=""> Choisir... </option>

                <?php foreach($keepersList as $keeper) { ?>
                    <option 
                        value="<?= $keeper->keeper_id ?>" 
                        <?php if(isset($params['treatment'])) {
                            if ($treatment->treatment_keeper_id == $keeper->keeper_id) {
                                echo "selected";
                            }
                        } ?>
                    >
                            <?= $keeper->getIdentity(); ?>
                    </option>
                <?php } ?>
            </select>

            <p>Si le propriétaire n'apparaît pas dans la liste, <a href="<?= URL_PREFIX . "/admin/owners/create" ?>">il faut d'abord l'ajouter</a></p>
        </div>

        <button type="submit">Valider</button>
    </form>
</main>

<a href="<?= URL_PREFIX . "/admin/treatments/" ?>">Retour à la liste des traitements</a>