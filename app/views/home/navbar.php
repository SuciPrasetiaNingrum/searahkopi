<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Searah Kopi | Home</title>
</head>
<body>
    <!--Start Navbar-->
    <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
        <div class="container">
            <a class="navbar-brand me-auto fw-semibold fs-1" href="#"><span class="text-primary"> Searah </span>Coffee</a>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <!--Logo Off Canvas-->
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel"><span class="text-primary"> Searah </span>Coffee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>

                <!--Navbar Tengah-->
                <nav id="navbar-scroll" class="navbar navbar-expand-lg fixed-top navbar-light bg-body-tertiary px-3 justify-content-center" data-bs-spy="scroll" data-bs-target="#navbarNav" data-bs-offset="0" style="position: sticky; top: 0;">
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASEURL ?>/home/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASEURL ?>/home/">Menu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASEURL ?>/favorite/">Favorite</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASEURL ?>/keranjang/">Keranjang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#location">Location</a>
                        </li>
                    </ul>
                </nav>
            </div>
            
            <!--Login Register-->
            <?php if (!isset($_SESSION['user'])) : ?>
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Login
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="<?= BASEURL ?>/login/" class="dropdown-item">Login</a></li>
                        <li><a href="<?= BASEURL ?>/register/" class="dropdown-item">Register</a></li>
                    </ul>
                </div>
            <?php else : ?>
                <div class="dropdown">
                    <a class="btn btn-primary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?=  $data['userauth']['name'] ?>
                    </a>

                    <ul class="dropdown-menu">
                        <?php if ($data['userauth']['is_owner']) : ?>
                            <li><a class="dropdown-item" href="">Dashboard</a></li>
                        <?php endif ?>
                        <li><a class="dropdown-item" href="<?= BASEURL ?>logout/">Logout</a></li>
                    </ul>
                </div>
            <?php endif ?>

            <!--Garis Tiga-->
            <button class="navbar-toggler pe-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
    <!--End Navbar-->
</body>
</html>