

const cartCountElement = document.getElementById('cart_count');

(() => {
    $.post(domain + 'cart/summary', {lang}, r => {
        r = JSON.parse(r);
        let count = r.count;
        let price = new Intl.NumberFormat('uk-UA',{style: 'decimal', minimumFractionDigits: 2}).format(r.price) + ' ₴';
        let text = '';
        switch (lang) {
            case 'ua': text = `Товарів: ${count} на суму ${price}`; break;
            case 'en': text = `Goods: ${count} for amount of ${price}`; break;
        }
        document.getElementById('summary').innerText = text;

        if (count) {
            cartCountElement.classList.remove('d-none');
            cartCountElement.textContent = count.toString();
        } else {
            cartCountElement.classList.add('d-none');
        }
    });
})();
