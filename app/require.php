<?php
    ob_start();
    //Require libraries from folder libraries
    require_once 'libraries/Core.php';
    require_once 'libraries/Controller.php';
    require_once 'libraries/Database.php';

    require_once 'helpers/session_helper.php';

    require_once 'config/config.php';
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo SITENAME; ?></title>
    <!-- Public CSS -->
    <link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/responzive.css">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/style.css">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/users.css">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/admin.css">
    <!-- Chart -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo URLROOT ?>/public/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/public/bootstrap/css/bootstrap.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid" style="padding: 0px 200px;">
            <!-- <a class="navbar-brand" href="#">LOGO</a> -->

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?php echo URLROOT; ?>">Home</a>
                    </li>
                </ul>

                <ul class="navbar-nav">
                    <?php if(isset($_SESSION['user_id'])) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo URLROOT; ?>/users/logout">Odjava</a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="<?php echo URLROOT .'/users/register'; ?>">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="<?php echo URLROOT .'/users/login'; ?>">Login</a>
                        </li>
                    <?php endif; ?>

                    <?php
                    // <!-- <div class="nav-item">
                    //    <a class="nav-link" href="javascript:void(0)" id="mode"></a>
                    // </div> -->
                    ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="main">
    <?php
        //Instantiate core class
        $init = new Core();
    ?>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.js" 
    integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <!-- Bootstrap -->
    <script src="<?php echo URLROOT ?>/public/bootstrap/js/bootstrap.js"></script>
    <script src="<?php echo URLROOT ?>/public/bootstrap/js/bootstrap.min.js"></script>
    <!-- Chart -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <!-- JS -->
    <script src="<?php echo URLROOT ?>/public/js/script.js"></script>
    <script src="<?php echo URLROOT ?>/public/js/admin.js"></script>
</body>
</html>
<?php 
ob_end_flush();
?>