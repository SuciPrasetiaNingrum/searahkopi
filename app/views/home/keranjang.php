
    <!-- Start Keranjang -->
    <div class="container mt-7">
    <div class="row">
    <div class="flasher text-center">
            <?php Flasher::flash()?>
            </div>
        <div class="col">
            <?php if (empty($data['lists'])) : ?>
                <div class="alert alert-warning" role="alert">
                    Keranjang belanja Anda kosong.
                </div>
            <?php else : ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Hapus</th>
                            <th scope="col">Nama Kopi</th>
                            <th scope="col">Gambar</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Sub Total</th>
                        </tr>
                    </thead>
                    <?php $totalKeseluruhan = 0; ?>
                    <?php foreach ($data['lists'] as $index => $list) : ?>
                        <tbody class="align-middle">
                            <tr>
                                <th scope="row">
                                    <!-- Tombol Hapus -->
                                    <form action="<?=BASEURL?>keranjang/deleteKeranjang/<?=$list['id']?>" method="POST">
                                        <button type="submit" class="btn btn-danger btn-sm">
                                        <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path d="M10 11V17" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M14 11V17" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M4 7H20" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M6 7H12H18V18C18 19.6569 16.6569 21 15 21H9C7.34315 21 6 19.6569 6 18V7Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V7H9V5Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </g>
                                        </svg>
                                        </button>
                                    </form>
                                </th>
                                <td><?= htmlspecialchars($list['nama_menu'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td><img src="<?= htmlspecialchars(BASEURL, ENT_QUOTES, 'UTF-8') ?>/img/<?= htmlspecialchars($list['imagepath'], ENT_QUOTES, 'UTF-8') ?>" width="60"></td>
                                <td>Rp.<?= number_format($list['harga'], 0, ',', '.') ?></td>
                                <td>
                                    <div style="display: flex; gap: 5px;">
                                    <!-- Tombol Kurang -->
                                    <form action="<?=BASEURL?>keranjang/trialQuantity/<?=$list['id']?>" method="post">
                                        <button type="submit" class="btn btn-dark btn-sm"><i class="fas fa-minus">-</i></button>
                                    </form>
                                    <span id="jumlah-<?= $index ?>" class="mx-2"><?= $list['jumlah'] ?></span>
                                    <!-- Tombol Tambah -->
                                    <form action="<?=BASEURL?>keranjang/plusQuantity/<?=$list['id']?>" method="post">
                                        <button type="submit" class="btn btn-warning btn-sm"><i class="fas fa-plus text-white">+</i></button>
                                    </form>
                                    </div>
                                </td>
                                <td id="subtotal-<?= $index ?>">Rp.<?= number_format($list['jumlah'] * $list['harga'], 0, ',', '.') ?></td>
                            </tr>
                        </tbody>
                        <?php $totalKeseluruhan += $list['jumlah'] * $list['harga']; ?>
                    <?php endforeach; ?>
                </table>
            <?php endif; ?>
        </div>
    </div>

    <?php if (!empty($data['lists'])) : ?>
        <!-- Total Harga -->
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" colspan="2">Total Keranjang Belanja</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="fw-bold">Total Harga</td>
                    <td id="totalKeseluruhan">Rp.<?= number_format($totalKeseluruhan, 0, ',', '.') ?></td>
                </tr>
                <tr>
                    
                    <form action="<?=BASEURL?>keranjang/addPayment" method="POST">
                        <input type="hidden" name="user_id" value="<?= $data['userauth']['id']?>">
                        <input type="hidden" name="amount" value="<?= $totalKeseluruhan ?>">
                    <td colspan="2"><button type="submit" class="btn btn-dark btn-sm">Checkout</button></td>
                    </form>
                </tr>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<script>
    function tambahJumlah(index) {
        var jumlahElem = document.getElementById('jumlah-' + index);
        var subtotalElem = document.getElementById('subtotal-' + index);
        var totalElem = document.getElementById('totalKeseluruhan');

        var jumlah = parseInt(jumlahElem.innerText);
        var harga = parseInt(subtotalElem.innerText.replace(/\D/g, ''));
        var hargaPerItem = harga / jumlah;
        
        jumlah++;
        jumlahElem.innerText = jumlah;
        subtotalElem.innerText = 'Rp.' + (jumlah * hargaPerItem).toLocaleString();

        updateTotal();
    }

    function kurangJumlah(index) {
        var jumlahElem = document.getElementById('jumlah-' + index);
        var subtotalElem = document.getElementById('subtotal-' + index);
        var totalElem = document.getElementById('totalKeseluruhan');

        var jumlah = parseInt(jumlahElem.innerText);
        var harga = parseInt(subtotalElem.innerText.replace(/\D/g, ''));
        var hargaPerItem = harga / jumlah;

        if (jumlah > 1) {
            jumlah--;
            jumlahElem.innerText = jumlah;
            subtotalElem.innerText = 'Rp.' + (jumlah * hargaPerItem).toLocaleString();

            updateTotal();
        }
    }

    function updateTotal() {
        var totalKeseluruhan = 0;
        var subtotalElems = document.querySelectorAll('[id^="subtotal-"]');
        
        subtotalElems.forEach(function(elem) {
            totalKeseluruhan += parseInt(elem.innerText.replace(/\D/g, ''));
        });

        document.getElementById('totalKeseluruhan').innerText = 'Rp.' + totalKeseluruhan.toLocaleString();
    }

    function hapusItem(index) {
        if (confirm('Apakah Anda yakin ingin menghapus item ini?')) {
        // Hapus baris item dari DOM
        var table = document.querySelector('table');
        table.deleteRow(index + 1); // index + 1 karena ada baris thead di urutan pertama

        // Update total keseluruhan
        updateTotal();
        }
    }
</script>

    
    <!-- End Keranjang-->

  