<header>
    <a href="index.php" class="btn">Accueil</a>
    <?php if (isset($_SESSION['auth'])) { ?>
        <a href="?p=user.deconnect<?= \str_replace('p=', '&return=', $_SERVER['QUERY_STRING']); ?>" class="btn">Déconnexion</a>
        <?php if (isset($_SESSION['admin'])) : ?>
            <a href="index.php?p=admin.user.index" class="btn">Tableau de bord</a>
        <?php endif; ?>
    <?php } else { ?>
        <a href="?p=user.login<?= \str_replace('p=', '&return=', $_SERVER['QUERY_STRING']); ?>" class="btn">Login</a>
    <?php }; ?>
    <a href="?p=mail.contact" class="btn">Me contacter</a>
</header>
