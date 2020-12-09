

const cartCountElement = document.getElementById('cart_count');

(() => {
    $.get(domain + 'cart/summary', r => {
        r = JSON.parse(r);
        let count = r.count;
        let price = new Intl.NumberFormat('uk-UA',{style: 'decimal', minimumFractionDigits: 2}).format(r.price) + ' ₴';
        document.getElementById('summary').innerText = `Товарів: ${count} на суму ${price}`;

        if (count) {
            cartCountElement.classList.remove('d-none');
            cartCountElement.textContent = count.toString();
        } else {
            cartCountElement.classList.add('d-none');
        }
    });
})();
