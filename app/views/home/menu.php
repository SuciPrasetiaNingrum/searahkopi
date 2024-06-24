

    <div class="container text-center pt-5 mt-5">
        <p class="text-capitalize fs-3 fw-semibold pt-5">our special menu</p>
    </div>

    <div class="container text-center">
            <div class="row ">
                <?php foreach ($data['lists'] as $list) : ?>
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
                    <div class="col-md-3 col-6 mt-4">
                        <div class="card w-lg-16 w-md-14">
                        <img src="<?= BASEURL ?>/img/<?= $list['imagepath'] ?>" class="card-img-top" alt="catalogue-1">
                            <div class="card-body">
                                <h5 class="card-title text-capitalize"><?= $list['nama_menu'] ?></h5>
                                <h5 class="card-title text-capitalize">Rp.<?= number_format($list['harga'], 0, ',', '.') ?></h5>
                                <p class="card-text fs-7"><?= substr($list['description'], 0, 50) . '...'; ?></p>
                                <div class="d-flex flex-row justify-content-between">
                                    <div class="">
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal<?= $list['id'] ?>">
                                            More
                                        </button>
                                        <?php if (!isset($_SESSION['user'])) : ?>
                                            <a href="<?= BASEURL ?>login/">
                                                <button type="button" class="btn btn-warning btn-sm">
                                                    Login
                                                </button>
                                            </a>
                                        <?php else : ?>
                                        <form id="orderForm">
                                            <input type="hidden" value="<?= $_SESSION['user']['id'] ?>" name="id_user">
                                            <input type="hidden" value="<?= $list['id'] ?>" name="id_menu">
                                            <input type="hidden" value="1" name="amount">
                                            <button type="submit" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                Order
                                            </button>
                                        </form>
                                        <?php endif ?>
                                    </div>
                                    <div class="">
                                        <a href="#"><svg class="mx-4" width="25" fill="lightgreen" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path d="M20.5,4.609A5.811,5.811,0,0,0,16,2.5a5.75,5.75,0,0,0-4,1.455A5.75,5.75,0,0,0,8,2.5,5.811,5.811,0,0,0,3.5,4.609c-.953,1.156-1.95,3.249-1.289,6.66,1.055,5.447,8.966,9.917,9.3,10.1a1,1,0,0,0,.974,0c.336-.187,8.247-4.657,9.3-10.1C22.45,7.858,21.453,5.765,20.5,4.609Zm-.674,6.28C19.08,14.74,13.658,18.322,12,19.34c-2.336-1.41-7.142-4.95-7.821-8.451-.513-2.646.189-4.183.869-5.007A3.819,3.819,0,0,1,8,4.5a3.493,3.493,0,0,1,3.115,1.469,1.005,1.005,0,0,0,1.76.011A3.489,3.489,0,0,1,16,4.5a3.819,3.819,0,0,1,2.959,1.382C19.637,6.706,20.339,8.243,19.826,10.889Z"></path>
                                                </g>
                                            </svg></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->

                <?php endforeach ?>

            </div>



        </div>
    <!--Footer -->
   