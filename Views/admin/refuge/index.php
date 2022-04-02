<?php 
    $title = "Administration du refuge";
    $refuge = $params['refuge'];
?>

<main>
    <h1>Administration du refuge</h1>

    <?= $refuge; ?>

    <a href="<?= URL_PREFIX . "/admin/refuge/edit/" .  $refuge->refuge_id?>">Modifier</a>

</main>