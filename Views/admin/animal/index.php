<?php 
use App\Models\Enclosure;
use App\Models\Treatment;
use App\Models\Keeper;

    $title = "Administration des animaux";
    $animals = $params['animals'];
?>

<main>
    <h1>Administration des animaux</h1>
    <a href="<?= URL_PREFIX . "/admin/animals/create" ?>">Ajouter un animal</a>

    <div class="row">
        <?php 
            foreach ($animals as $animal) { 
                if ($animal->animal_favorite_keeper) {
                    $favoriteKeeper = (new Keeper($this->getDatabase()))->findById($animal->animal_favorite_keeper);
                }

                $treatments = $animal->getTreatments();
                if ($treatments) {
                    foreach ($treatments as $treatment) {
                        $treatment = new Treatment($this->getDatabase());
                    }
                } else {
                    $treatments = null;
                }

                $enclosure = ($animal->getEnclosure());
                $enclosureId = $enclosure->enclosure_id;
                $currentEnclosure = (new Enclosure($this->getDatabase()))->findById($enclosureId);
        ?>

        <div class="card">
            <h2><?= $animal->animal_name ?></h2>
            <img src="<?= $animal->animal_image_url ?>" alt="Photo de <?= $animal->animal_name ?>">
            <p><?= $animal->getAllInfo() ?></p>
            <p>
                <?php if (isset($favoriteKeeper)) {
                    echo "Soigneur préféré : " . $favoriteKeeper->getIdentity() . ".";
                } else {
                    echo "Pas de soigneur préféré.";
                } ?>
            </p>
            <?php if (!$animal->animal_death_date) {?>
                <p>Actuellement dans l'enclos <?= $currentEnclosure->getName(); ?>.</p>
            <?php } else { ?>
                <p><?= $animal->animal_name ?> repose en paix dans notre cimetière des animaux.</p>
            <?php } ?>

            <?php if (isset($treatments)) { ?>
                <h3>Traitements reçus</h2>
                <?php foreach($treatments as $treatment) { 
                    $keeper = new Keeper($this->getDatabase());
                    $treatmentKeeper = $keeper->findById($treatment->treatment_keeper_id);
                ?>
                    <p>Soin <?= $treatment->treatment_name ? $treatment->treatment_name : 'non défini' ?> prodigué par <?= $treatmentKeeper->getIdentity(); ?>.</p>
                <?php } ?>
            <?php } ?>
            <a href="<?= URL_PREFIX . "/admin/animals/edit/" .  $animal->animal_id?>">Modifier cet animal</a>
            <form action="<?= URL_PREFIX . "/admin/animals/delete/" .  $animal->animal_id?>" method="POST">
                <button type="submit">Supprimer cet animal</button>
            </form>
        </div>
        <?php } ?>
    </div>

</main>



