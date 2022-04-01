<?php
    $title = "Panel d'administration";
    require '../views/require/top.php';
?>

<body>
    <header>
        <h1>Bienvenue dans l'administration</h1>
    </header>

    <ul>
        <li><a href="<?= URL_PREFIX . "/admin/animals"?>">Animaux</a></li>
        <li><a href="<?= URL_PREFIX . "/admin/keepers"?>">Soigneurs</a></li>
        <li><a href="<?= URL_PREFIX . "/admin/owners"?>">Propriétaires</a></li>
        <li><a href="<?= URL_PREFIX . "/admin/adoptions"?>">Adoptions</a></li>
        <li><a href="<?= URL_PREFIX . "/admin/treatments"?>">Traitements</a></li>
        <li><a href="<?= URL_PREFIX . "/admin/enclosures"?>">Enclos</a></li>
    </ul>
    
</body>

</html>