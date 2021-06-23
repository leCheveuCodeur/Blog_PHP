<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/src/css/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;600&display=swap" rel="stylesheet">
    <title><?= App::getInstance()->title; ?></title>
</head>

<body class="bg-dark">
    <header class="">
        <?php include("nav.php"); ?>
    </header>

    <main class="container-xxl text-light">
        <?php if (!empty($errors)) : ?>
            <div class="alert alert-danger w-50 ma-auto"><?= $errors; ?></div>
        <?php endif; ?>

        <?php if (!empty($message)) : ?>
            <div class="alert alert-success w-50 mx-auto"><?= $message; ?></div>
        <?php endif; ?>

        <?= $content; ?>
    </main>

    <footer class="container-fluid pt-4 bg-dark">
        <?php include("footer.php"); ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>

</body>

</html>
