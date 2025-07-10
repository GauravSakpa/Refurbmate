let cart = [];
let totalPrice = 0;

function addToCart(phoneName, phonePrice) {
    cart.push({ name: phoneName, price: phonePrice });
    totalPrice += phonePrice;
    updateCartDisplay();
}

function updateCartDisplay() {
    const cartItemsList = document.getElementById('cart-items');
    cartItemsList.innerHTML = '';
    cart.forEach(item => {
        const listItem = document.createElement('li');
        listItem.textContent = `${item.name} - ₹${item.price}`;
        cartItemsList.appendChild(listItem);
    });
    document.getElementById('total-price').textContent = `Total Price: ₹${totalPrice}`;
}

function proceedToCheckout() {
    alert('Proceeding to checkout...');
    // Here you can redirect to the checkout page or handle the checkout process
}