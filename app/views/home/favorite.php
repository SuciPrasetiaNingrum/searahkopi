    <div class="container mt-7">
    <div class="flasher text-center">
            <?php Flasher::flash()?>
    </div>
    <h1 class="text-center mt-5 mb-4">Favorite</h1>
        
    <!--favorite 1-->
    <div class="container text-center">
        <div class="row align-items-start mb-5">
   
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
                    <img src="<?= BASEURL ?>/img/<?= $list['imagepath'] ?>" class="card-img-top" alt="catalogue-1">
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
            <img src="<?= BASEURL ?>/img/<?= $list['imagepath'] ?>" class="card-img-top" alt="catalogue-1">
            <div class="card-body">
                <h5 class="card-title"><?= $list['nama_menu'] ?></h5>
                <h5 class="card-title text-capitalize">Rp.<?= number_format($list['harga'], 0, ',', '.') ?></h5>
                <p class="card-text"><?= substr($list['description'], 0, 50) . '...'; ?></p>
                <div class="d-flex justify-content-center  ">
                    <form id="orderForm<?= $list['id'] ?>" method="POST">
                        <input type="hidden" value="<?= $_SESSION['user']['id'] ?>" name="id_user">
                        <input type="hidden" value="<?= $list['id'] ?>" name="id_menu">
                        <input type="hidden" value="1" name="amount">
                        <button type="submit" class="btn btn-warning btn-sm me-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?= $list['id'] ?>">
                            Order
                        </button>
                    </form>
                    <button type="button" class="btn btn-primary btn-sm me-2" data-bs-toggle="modal" data-bs-target="#modal<?= $list['id'] ?>">
                        More
                    </button>
                    <form action="<?= BASEURL ?>/favorite/delete" method="POST">
                        <input type="hidden" value="<?= $data['userauth']['id'] ?>" name="user_id"> 
                        <input type="hidden" value="<?= $list['id'] ?>" name="id">
                        <button type="sumbit" class="btn btn-danger btn-sm ">
                            Delete
                        </button>
                    </form>
                </div>
                

                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
             
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
