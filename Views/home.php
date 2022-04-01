<?php
    $title = "Page d'accueil du refuge";
    require '../views/require/top.php';
    $refuge = $params['refuge'];
?>

<body>
    <header>
        <h1>Bienvenue chez <?= $refuge->refuge_name ?></h1>
    </header>

    <main>
        <p>
            <?php echo $refuge; ?>
        </p>
    </main>
    
</body>

</html>