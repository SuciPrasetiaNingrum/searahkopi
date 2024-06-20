<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASEURL ?>css/main.css">
    <script src="<?= BASEURL ?>js/bootstrap.js"></script>
    <script src="<?= BASEURL ?>js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="<?= BASEURL ?>/css/tiny-slider.css">
</head>
<body>

    <!-- Navbar-->
    <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
        <div class="container">
            <a class="navbar-brand me-auto fw-semibold fs-1" href="#"><span class="text-primary"> Searah </span>Coffee</a>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <!-- Logo Off Canvas -->
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel"><span class="text-primary"> Searah </span>Coffee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <!-- Navbar Tengah -->
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
                        <?= $_SESSION['user']['name'] ?>
                    </a>
                    <ul class="dropdown-menu">
                        <?php if ($_SESSION['user']['is_owner'] == 1) : ?>
                            <li><a class="dropdown-item" href="">Dashboard</a></li>
                        <?php endif ?>
                        <li><a class="dropdown-item" href="<?= BASEURL ?>logout/">Logout</a></li>
                    </ul>
                </div>
            <?php endif ?>
            <!-- Garis Tiga -->
            <button class="navbar-toggler pe-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
    
    <div class="container mt-7">
        <h1 class="text-center mt-5 mb-4">Favorite</h1>
        
    <!--favorite 1-->
    <div class="container text-center">
        <div class="row align-items-start">
            
        <?php
$displayedIds = [];

foreach ($data['lists'] as $list):
    if (in_array($list['id'], $displayedIds)) {
        continue; // Skip this iteration if the ID is already displayed
    }
    $displayedIds[] = $list['id']; // Add the ID to the array of displayed IDs
?>
    <!-- Modal -->
    <div class="modal fade" id="modal<?= $list['id'] ?>" tabindex="-1" aria-labelledby="modalLabel<?= $list['id'] ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel<?= $list['id'] ?>"><?= $list['nama_menu'] ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="<?= BASEURL ?>/img/iklan-1.jpg" class="card-img-top" alt="catalogue-1">
                    <p class="mt-5"><?= $list['description'] ?></p>
                    <h5 class="card-title text-capitalize">Rp.<?= number_format($list['harga'], 0, ',', '.') ?></h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card border-width: 2px" style="width: 18rem;">
            <img src="../img/iklan-1.jpg" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title"><?= $list['nama_menu'] ?></h5>
                <h5 class="card-title text-capitalize">Rp.<?= number_format($list['harga'], 0, ',', '.') ?></h5>
                <p class="card-text"><?= substr($list['description'], 0, 50) . '...'; ?></p>

                <form id="orderForm<?= $list['id'] ?>" method="POST">
                    <input type="hidden" value="<?= $_SESSION['user']['id'] ?>" name="id_user">
                    <input type="hidden" value="<?= $list['id'] ?>" name="id_menu">
                    <input type="hidden" value="1" name="amount">
                    <button type="submit" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?= $list['id'] ?>">
                        Order
                    </button>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal<?= $list['id'] ?>">
                        More
                    </button>
                </form>

                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
                <style>
                    .heart {
                        cursor: pointer;
                        color: #ccc; /* Default color */
                        transition: color 0.3s ease;
                        float: right;
                    }
                    .heart.liked {
                        color: #32cd32; /* Liked state color */
                    }
                </style>
                <i class="fa fa-heart heart" onclick="toggleHeart(this)"></i>
            </div>
        </div>
        <script>
            function toggleHeart(element) {
                element.classList.toggle('liked');
            }
        </script>
    </div>
<?php endforeach; ?>
        </div>
      </div>

    <!-- Footer -->
    <div class="footerContainer mt-5">
        <div class="row align-items-center text-center">
            <div class="col-12 py-2 border">
                <div class="row align-items-center justify-content-center">
                    <div class="col-1">
                        <a href="">
                            <svg width="20" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title>Twitter</title><path d="M21.543 7.104c.015.211.015.423.015.636 0 6.507-4.954 14.01-14.01 14.01v-.003A13.94 13.94 0 0 1 0 19.539a9.88 9.88 0 0 0 1.149.064 9.89 9.89 0 0 0 6.132-2.114 4.946 4.946 0 0 1-4.616-3.432 4.918 4.918 0 0 0 2.23-.085A4.942 4.942 0 0 1 .975 9.665v-.064a4.93 4.93 0 0 0 2.23.616A4.942 4.942 0 0 1 1.675 3.1a14.03 14.03 0 0 0 10.184 5.165 4.943 4.943 0 0 1 8.418-4.505 9.868 9.868 0 0 0 3.13-1.196 4.94 4.94 0 0 1-2.17 2.723 9.868 9.868 0 0 0 2.846-.775 10.646 10.646 0 0 1-2.49 2.575z"/></svg>
                        </a>
                    </div>
                    <div class="col-1">
                        <a href="">
                            <svg width="20" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title>Instagram</title><path d="M12 2.163c3.204 0 3.584.012 4.85.07 1.366.062 2.633.332 3.608 1.308.975.976 1.246 2.242 1.308 3.608.058 1.267.07 1.646.07 4.85s-.012 3.584-.07 4.85c-.062 1.366-.332 2.633-1.308 3.608-.976.975-2.242 1.246-3.608 1.308-1.267.058-1.646.07-4.85.07s-3.584-.012-4.85-.07c-1.366-.062-2.633-.332-3.608-1.308-.975-.976-1.246-2.242-1.308-3.608C2.175 15.747 2.163 15.368 2.163 12s.012-3.584.07-4.85c.062-1.366.332-2.633 1.308-3.608.976-.975 2.242-1.246 3.608-1.308 1.267-.057 1.646-.07 4.85-.07zm0-2.163C8.756 0 8.337.014 7.053.072 5.72.13 4.473.422 3.36 1.536 2.246 2.649 1.954 3.896 1.896 5.229 1.838 6.513 1.825 6.933 1.825 12s.014 5.487.072 6.771c.058 1.333.35 2.48 1.464 3.593 1.113 1.114 2.36 1.406 3.693 1.464 1.284.058 1.704.072 6.771.072s5.487-.014 6.771-.072c1.333-.058 2.48-.35 3.593-1.464 1.114-1.113 1.406-2.36 1.464-3.693.058-1.284.072-1.704.072-6.771s-.014-5.487-.072-6.771c-.058-1.333-.35-2.48-1.464-3.593-1.113-1.114-2.36-1.406-3.693-1.464C15.487.014 15.067 0 12 0zm0 5.838a6.162 6.162 0 1 0 6.162 6.162A6.168 6.168 0 0 0 12 5.838zm0 10.162a3.999 3.999 0 1 1 3.999-3.999A4.004 4.004 0 0 1 12 16zm6.406-11.845a1.44 1.44 0 1 1-1.44-1.44 1.44 1.44 0 0 1 1.44 1.44z"/></svg>
                        </a>
                    </div>
                    <div class="col-1">
                        <a href="">
                            <svg width="20" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title>Facebook</title><path d="M22.675 0h-21.35C.596 0 0 .593 0 1.326v21.349C0 23.407.593 24 1.325 24H12.82v-9.294H9.692v-3.622h3.128V8.413c0-3.1 1.892-4.788 4.658-4.788 1.325 0 2.463.099 2.795.143v3.24h-1.918c-1.505 0-1.796.715-1.796 1.764v2.31h3.587l-.467 3.622h-3.12V24h6.116c.73 0 1.324-.593 1.324-1.325V1.325C24 .593 23.407 0 22.675 0z"/></svg>
                        </a>
                    </div>
                </div>
                <div class="row align-items-center justify-content-center mt-4">
                    <div class="col-2 text-center">
                        <p>&copy; 2023 Searah Coffee. All rights reserved.</p>
                    </div>
                </div>
                <div class="col-12 py-3">
                    <p>Copyright &copy;2024; Designed by <span class="designer">Searah Coffee</span></p>
                </div>
            </div>
        </div>
        
  </body>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
$(document).ready(function() {
    $('form[id^="orderForm"]').submit(function(event) {
        event.preventDefault(); // Mencegah form dari reload halaman

        var form = $(this);
        var url = '<?= BASEURL ?>Keranjang/addItem';
        
        $.ajax({
            type: 'POST',
            url: url,
            data: form.serialize(),
            success: function(response) {
                // Lakukan sesuatu setelah sukses
                console.log(response);
                alert('Item berhasil ditambahkan ke keranjang.');
            },
            error: function(xhr, status, error) {
                // Tangani kesalahan
                console.error(error);
                alert('Terjadi kesalahan. Silakan coba lagi.');
            }
        });
    });
});
</script>
</html>
