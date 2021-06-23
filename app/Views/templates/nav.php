<!-- Navigation-->
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container-xxl">
        <a class="navbar-brand me-5" href="index.php">Julien JAMET</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse row" id="navbarNav">
            <ul class="navbar-nav">
                <div class="d-md-flex flex-grow-1">
                    <?php if (!empty($_SERVER['QUERY_STRING'])) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Accueil</a>
                        </li>
                        <?php if (preg_match('/=post.show|=mail.contact/', $_SERVER['QUERY_STRING'])) : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?p=post.index">Le Blog</a>
                            </li>
                        <?php endif; ?>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?p=post.index">Le Blog</a>
                        </li>
                    <?php }; ?>
                    <?php if (isset($_SESSION['admin'])) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?p=admin.user.index">Dashboard<?php if (count($alert) > 0) : ?>
                                <span class="badge bg-primary text-light"><?= count($alert); ?></span>
                            <?php endif; ?>
                            </a>
                        </li>
                    <?php endif; ?>
                </div>
                <div class="d-md-flex">
                    <?php if (isset($_SESSION['auth'])) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="?p=user.deconnect<?= \str_replace('p=', '&return=', $_SERVER['QUERY_STRING']); ?>">Déconnect'</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="?p=user.login<?= \str_replace('p=', '&return=', $_SERVER['QUERY_STRING']); ?>">Se Connecter</a>
                        </li>
                    <?php }; ?>
                    <li class="nav-item">
                        <a class="btn btn-primary" href="?p=mail.contact">Me Contacter</a>
                    </li>
                </div>
            </ul>
        </div>
    </div>
</nav>
