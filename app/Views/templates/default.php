<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title><?= App::getInstance()->title; ?></title>

    <!-- Bootstrap core CSS -->
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="starter-template.css" rel="stylesheet">
</head>

<body>
    <?php include("header.php"); ?>

    <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger"><?= $errors; ?></div>
    <?php endif; ?>

    <?php if (!empty($message)) : ?>
        <div class="alert alert-success"><?= $message; ?></div>
    <?php endif; ?>

    <?= $content; ?>

    <footer class="pt-5 my-5 text-muted border-top">
        Created by the Bootstrap team &middot; &copy; 2021
    </footer>
    </div>



</body>

</html>
