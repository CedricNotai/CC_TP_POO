<nav>
    <ul>
        <li><a href="<?= URL_PREFIX ?>">Accueil</a></li>
        <li><a href="<?= URL_PREFIX . "/keepers/"?>">Nos soigneurs</a></li>
        <li><a href="<?= URL_PREFIX . "/animals/"?>">Nos animaux</a></li>
        <li><a href="<?= URL_PREFIX . "/owners/"?>">Les propriétaires</a></li>
        <li><a href="<?= URL_PREFIX . "/adoptions/"?>">Les adoptions</a></li>

    <?php if (isset($_SESSION['auth'])) { ?>
        <li>
            <a href="<?= URL_PREFIX . "/logout/"?>">Se déconnecter</a>
            <p>Menu backoffice</p>
            <ul>
                <li><a href="<?= URL_PREFIX . "/admin/refuge"?>">Le refuge</a></li>
                <li><a href="<?= URL_PREFIX . "/admin/animals"?>">Animaux</a></li>
                <li><a href="<?= URL_PREFIX . "/admin/keepers"?>">Soigneurs</a></li>
                <li><a href="<?= URL_PREFIX . "/admin/owners"?>">Propriétaires</a></li>
                <li><a href="<?= URL_PREFIX . "/admin/adoptions"?>">Adoptions</a></li>
                <li><a href="<?= URL_PREFIX . "/admin/treatments"?>">Traitements</a></li>
                <li><a href="<?= URL_PREFIX . "/admin/enclosures"?>">Enclos</a></li>
            </ul>
        </li>
    <?php } else  { ?>
        <li><a href="<?= URL_PREFIX . "/login/"?>">Se connecter</a></li>
    <?php } ?>
    </ul>
</nav>