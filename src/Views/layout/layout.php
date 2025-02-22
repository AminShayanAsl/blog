<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog</title>
    <link href="Css/style.css" rel="stylesheet">
    <link href="Css/bootstrap.min.css" rel="stylesheet">
    <script src="Js/jquery.js"></script>
    <script src="Js/bootstrap.min.js"></script>
    <script src="Js/app.js"></script>
</head>
<body dir="rtl" class="text-right">
<div class="wrapper pt-5">
    <?php
    session_start();
    include 'partials/header.php'
    ?>

    <?php if (isset($_SESSION['message'])) { ?>
    <div class="container alert <?= $_SESSION['alert-class'] ?> alert-dismissible fade show mt-4" role="alert">
        <?= $_SESSION['message'] ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php
        unset($_SESSION['message']);
        unset($_SESSION['alert-class']);
    }
    ?>


    <div class="content container mt-5">
        <?php echo isset($content) ? $content : ''; ?>
    </div>

    <?php include 'partials/footer.php' ?>
</div>
</body>
</html>
