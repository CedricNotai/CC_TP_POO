<?php 
    use App\Models\Animal;
    use App\Models\Keeper;

    $title = "Administration des traitements";
    $treatments = $params['treatments'];
?>

<main>
    <h1>Administration des traitements</h1>
    <a href="<?= URL_PREFIX . "/admin/treatments/create" ?>">Ajouter un traitement</a>

    <div class="row">
        <?php 
        foreach ($treatments as $treatment) { 
            $keeper = (new Keeper($this->getDatabase()))->findById($treatment->treatment_keeper_id);
            $animal = (new Animal($this->getDatabase()))->findById($treatment->treatment_animal_id);
        ?>
            <div class="card">
                <p>Traitement : <?= $treatment->treatment_id ?></p>
                <p>Nom du soin : <?= $treatment->treatment_name ? $treatment->treatment_name : "non déterminé" ?></p>
                <p>Réalisé par : <?= $keeper->getIdentity() ?></p>
                <p>Animal bénéficiaire : <?= $animal->animal_name?></p>

                <a href="<?= URL_PREFIX . "/admin/treatments/edit/" .  $treatment->treatment_id?>">Modifier</a>
                <form action="<?= URL_PREFIX . "/admin/treatments/delete/" .  $treatment->treatment_id?>" method="POST">
                    <button type="submit">Supprimer</button>
                </form>
            </div>
        <?php } ?>
    </div>
</main>