<?php
define("WEBROOT", "http://localhost:8080/");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Articles</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            background-color: #f8f9fa;
            padding-top: 20px;
        }

        .content {
            margin-left: 270px;
            padding: 20px;
        }

        .user-info {
            text-align: center;
            padding: 10px;
        }

        .user-info img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
        }

        .user-info h5 {
            margin-top: 10px;
        }

        .d-none {
            display: none !important;
        }
    </style>
</head>

<body>
    <div class="sidebar d-none d-lg-block">
        <div class="user-info">
            <img src="img/profil.jpg" alt="User Photo">
            <h5>Nour BG</h5>
            <p>Email: DEV.Nour.gmail.com</p>
        </div>
        <nav class="nav flex-column">
            <a class="nav-link active" href="<?= WEBROOT ?>?action=lister-article">Articles</a>
            <a class="nav-link active" href="<?= WEBROOT ?>?action=lister-categorie">Categorie</a>
            <a class="nav-link active" href="<?= WEBROOT ?>?action=lister-type">Types</a>
            <a class="nav-link" href="#">Approvisionnement</a>
        </nav>


    </div>


    <div class="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <!-- <a class="navbar-brand" href="#">6point9</a> -->
            <button id="toggleSidebar" class="btn btn-primary">Menu</button>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">DEV Nour</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><img src="https://via.placeholder.com/40" alt="User Photo"
                                class="rounded-circle"></a>
                    </li>
                </ul>
            </div>
        </nav>
        <?php
        $action = $_REQUEST['action'] ?? 'lister-article';

        if ($action == 'lister-article' || $action == 'form-article' || $action == 'add-article') {
            require_once ("../controllers/article.controller.php");
        } elseif ($action == 'lister-categorie' || $action == 'form-categorie' || $action == 'add-categorie') {
            require_once ("../controllers/categorie.controller.php");
        } elseif ($action == 'lister-type' || $action == 'form-type' || $action == 'add-type') {
            require_once ("../controllers/type.controller.php");
        } else {
            require_once ("../controllers/article.controller.php");
        }


        ?>

        <!-- Bootstrap JS, Popper.js, and jQuery -->
        <script src="./index.php">
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="js/script.js"></script>
</body>

</html>