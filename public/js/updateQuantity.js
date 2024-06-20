function updateQuantity(action, id) {
    let quantityElement = document.getElementById('quantity_' + id);
    let currentQuantity = parseInt(quantityElement.innerText);

    if (action === 'plus') {
        currentQuantity++;
    } else if (action === 'minus' && currentQuantity > 1) {
        currentQuantity--;
    }

    quantityElement.innerText = currentQuantity;

    // Update server dengan AJAX
    fetch(`${BASEURL}/keranjang/updateQuantity`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ id: id, quantity: currentQuantity })
    })
    .then(response => response.json())
    .then(data => {
        console.log('Success:', data);
        document.getElementById('subtotal_' + id).innerText = data.newSubtotal;
    })
    .catch((error) => {
        console.error('Error:', error);
    });
}


