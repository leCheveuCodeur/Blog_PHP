<!-- Navigation-->
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container-xxl">
        <a class="navbar-brand me-5" href="index.php">Julien JAMET</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse row text-center py-3" id="navbarNav">
            <ul class="navbar-nav">
                <div class="d-md-flex flex-grow-1">
                    <?php if (!empty($this->SERVER['QUERY_STRING'])) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Accueil</a>
                        </li>
                        <?php if (preg_match('/=post.show|=mail.contact|=admin/', $this->SERVER['QUERY_STRING'])) : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?p=post.index">Le Blog</a>
                            </li>
                        <?php endif; ?>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?p=post.index">Le Blog</a>
                        </li>
                    <?php }; ?>
                    <?php if (isset($this->SESSION['admin']) && !preg_match('/=user/', $this->SERVER['QUERY_STRING'])) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?p=admin.user.index">Dashboard<?php if (count($alert) > 0 && isset($alert)) : ?>
                                <span class="badge bg-primary text-light"><?= count($alert); ?></span>
                            <?php endif; ?>
                            </a>
                        </li>
                    <?php endif; ?>
                </div>
                <div class="d-md-flex">
                    <?php if (isset($this->SESSION['auth'])) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="?p=user.deconnect<?= \str_replace('p=', '&return=', $this->SERVER['QUERY_STRING']); ?>">D??connect'</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="?p=user.login<?= !empty($this->SERVER['QUERY_STRING']) ? str_replace('p=', '&return=', $this->SERVER['QUERY_STRING']) : ''; ?>">Se Connecter</a>
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
