<?php 
    use App\Models\Owner;
    use App\Models\Animal;
    
    $title = "Administration des adoptions";
    $adoptions = $params['adoptions'] 
?>

<main>
    <h1>Administration des adoptions</h1>
    <a href="<?= URL_PREFIX . "/admin/adoptions/create" ?>">Enregistrer une nouvelle adoption</a>

    <div class="row">
        <?php 
            foreach ($adoptions as $adoption) { 
                $adoptedAnimal = (new Animal($this->getDataBase()))->findById($adoption->getAnimalId()->animal_id);
                $owner = (new Owner($this->getDatabase()))->findById($adoption->getOwnerId()->owner_id);
        ?>
                <div class="card">
                    <img src="<?= $adoptedAnimal->animal_image_url ?>" alt="Photo de <?= $adoptedAnimal->animal_name ?>">
                    <h2><?= "Adoption de " . $adoptedAnimal->animal_name . " par " . $owner->getIdentity() ?></h2>
                    <a href="<?= URL_PREFIX . "/admin/adoptions/edit/" .  $adoption->adoption_id?>">Modifier</a>
                    <form action="<?= URL_PREFIX . "/admin/adoptions/delete/" .  $adoption->adoption_id?>" method="POST">
                        <button type="submit">Supprimer</button>
                    </form>
                </div>
        <?php } ?>
    </div>
</main>
