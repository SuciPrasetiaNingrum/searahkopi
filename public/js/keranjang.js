$(document).ready(function() {
    function updateTotalHarga() {
        var total = 0;
        $('.subtotal').each(function() {
            var subtotal = parseFloat($(this).text().replace(/[^0-9,-]+/g, ""));
            total += subtotal;
        });
        $('#total-harga').text('Rp.' + total.toLocaleString('id-ID', { minimumFractionDigits: 0 }));
    }

    $('.increase, .decrease').click(function() {
        var row = $(this).closest('tr');
        var rowid = row.data('rowid');
        var qtyInput = row.find('input[type="number"]');
        var newQty = parseInt(qtyInput.val());

        if ($(this).hasClass('increase')) {
            newQty += 1;
        } else {
            if (newQty > 1) {
                newQty -= 1;
            }
        }

        qtyInput.val(newQty);

        // Update jumlah item di server
        $.post("keranjang/update", { rowid: rowid, qty: newQty }, function(data) {
            var price = parseFloat(row.find('.price').text().replace(/[^0-9,-]+/g, ""));
            var subtotal = newQty * price;
            row.find('.subtotal').text('Rp.' + subtotal.toLocaleString('id-ID', { minimumFractionDigits: 0 }));
            updateTotalHarga();
        });
    });
});
