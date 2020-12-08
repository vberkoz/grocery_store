

const domain = 'http://localhost:8080/api/v1/';
const cartCountElement = document.getElementById('cart_count');

let state = {
    price: 0,
    discount: 0,
    total: 0,
    items: []
};

const updateCartTotal = () => {
    state.price = 0;
    state.items.forEach(i => state.price += i.total);
    state.total = state.price - state.discount;
    $('#cart_price').text(
        new Intl.NumberFormat('uk-UA',{style: 'decimal', minimumFractionDigits: 2}).format(state.price) + ' ₴'
    );
    $('#cart_discount').text(
        new Intl.NumberFormat('uk-UA',{style: 'decimal', minimumFractionDigits: 2}).format(state.discount) + ' ₴'
    );
    $('#cart_total').text(
        new Intl.NumberFormat('uk-UA',{style: 'decimal', minimumFractionDigits: 2}).format(state.total) + ' ₴'
    );
}

$.get(domain + 'cart/content', {}, r => {
    r = JSON.parse(r);
    state.items = r;

    if (r.length) {
        cartCountElement.classList.remove('d-none');
        cartCountElement.textContent = r.length.toString();
    } else {
        cartCountElement.classList.add('d-none');
    }

    updateCartTotal();

    let content = '';
    r.map(i => {
        total = new Intl.NumberFormat('uk-UA', { style: 'decimal', minimumFractionDigits: 2 }).format(i.total) + ' ₴';
        price = new Intl.NumberFormat('uk-UA', { style: 'decimal', minimumFractionDigits: 2 }).format(i.price) + ' ₴';
        inputNumberTypeClass = i.unit==='шт' ? 'bag-input-int' : 'bag-input-float';
        content += `
        <tr class='item' data-id='${i.id}'>
            <td class='p-3' style='min-width: 280px;'>
                <div class='row'>
                    <div class='col-4'>
                        <img class='img-fluid' src='assets/images/${i.image}' alt='${i.title}' style="max-width: 60px;">
                    </div>
                    <div class='col-8'>
                        <p class='m-0'>${i.title}</p>
                        <small class='text-muted'>${i.volume} ${i.unit}</small>
                        <small class='text-muted'>${price}</small>
                    </div>
                </div>
            </td>
            
            <td class='p-3' style='min-width: 180px;max-width: 180px;'>
                <div class='input-group'>
                    <div class='input-group-prepend'>
                        <button class='btn btn-outline-primary' type='button' onclick="update(this, 'remove')">
                            <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 459 459' height='0.6em' fill='currentColor' class='align-middle'>
                                <path d='M459.313,229.648c0,22.201-17.992,40.199-40.205,40.199H40.181c-11.094,0-21.14-4.498-28.416-11.774   C4.495,250.808,0,240.76,0,229.66c-0.006-22.204,17.992-40.199,40.202-40.193h378.936   C441.333,189.472,459.308,207.456,459.313,229.648z'/>
                            </svg>
                        </button>
                    </div>
                    
                    <input type='text' value='${i.quantity} ${i.unit}' onchange="update(this, 'change')"
                        class='form-control text-center item-input ${inputNumberTypeClass}' data-unit='${i.unit}'>
                        
                    <div class='input-group-append'>
                        <button class='btn btn-outline-primary' type='button' onclick="update(this, 'add')">
                            <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 448 448' height='0.8em' fill='currentColor' class='align-middle'>
                                <path d='m408 184h-136c-4.417969 0-8-3.582031-8-8v-136c0-22.089844-17.910156-40-40-40s-40 17.910156-40 40v136c0 4.417969-3.582031 8-8 8h-136c-22.089844 0-40 17.910156-40 40s17.910156 40 40 40h136c4.417969 0 8 3.582031 8 8v136c0 22.089844 17.910156 40 40 40s40-17.910156 40-40v-136c0-4.417969 3.582031-8 8-8h136c22.089844 0 40-17.910156 40-40s-17.910156-40-40-40zm0 0'/>
                            </svg>
                        </button>
                    </div>
                </div>
            </td>
            
            <td class='p-3 text-right' style='min-width: 100px;'>
                <span class='total align-middle'>${total}</span>
            </td>
            
            <td class='p-3'>
                <button class='btn btn-outline-danger' type='button' onclick="update(this, 'delete')">
                    <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512' height='1.4em' fill='currentColor' class='align-middle pb-1'>
                        <path d='M425.298,51.358h-91.455V16.696c0-9.22-7.475-16.696-16.696-16.696H194.854c-9.22,0-16.696,7.475-16.696,16.696v34.662    H86.703c-9.22,0-16.696,7.475-16.696,16.696v51.357c0,9.22,7.475,16.696,16.696,16.696h338.593c9.22,0,16.696-7.475,16.696-16.696    V68.054C441.993,58.832,434.518,51.358,425.298,51.358z M300.45,51.358h-88.9V33.391h88.9V51.358z'/>
                        <path d='M93.192,169.497l13.844,326.516c0.378,8.937,7.735,15.988,16.68,15.988h264.568c8.945,0,16.302-7.051,16.68-15.989    l13.843-326.515H93.192z M205.53,444.105c0,9.22-7.475,16.696-16.696,16.696c-9.22,0-16.696-7.475-16.696-16.696V237.391    c0-9.22,7.475-16.696,16.696-16.696c9.22,0,16.696,7.475,16.696,16.696V444.105z M272.693,444.105    c0,9.22-7.475,16.696-16.696,16.696s-16.696-7.475-16.696-16.696V237.391c0-9.22,7.475-16.696,16.696-16.696    s16.696,7.475,16.696,16.696V444.105z M339.856,444.105c0,9.22-7.475,16.696-16.696,16.696s-16.696-7.475-16.696-16.696V237.391    c0-9.22,7.475-16.696,16.696-16.696s16.696,7.475,16.696,16.696V444.105z'/>
                    </svg>
                </button>
            </td>
        </tr>
        `;
    });
    document.getElementsByTagName('tbody')[0].innerHTML = content;
})

const update = (e, action) => {
    const itemElement = e.closest('.item');
    let id = parseInt(itemElement.getAttribute("data-id"));
    let item = {};
    state.items.forEach(i => {parseInt(i.id) === id ? item = i : null});

    let quantity;
    switch (action) {
        case 'add': quantity = parseFloat(item.quantity) + parseFloat(item.volume_min);break;
        case 'remove': quantity = parseFloat(item.quantity) - parseFloat(item.volume_min);break;
        case 'change':
            quantity = e.value;
            if (quantity.includes(' ' + item.unit)) quantity = quantity.slice(0, -3);
            item.quantity = parseFloat(quantity);
            break;
        case 'delete': quantity = 0; break;
    }
    item.quantity = Math.round(quantity * 10) / 10;

    if (parseFloat(item.quantity) < parseFloat(item.volume_min) || !quantity) {
        item.quantity = 0;
        itemElement.remove();
    }

    item.total = item.quantity * parseFloat(item.price);
    if (action !== 'delete') {
        e.closest('.input-group').getElementsByClassName('item-input').item(0)
            .value = item.quantity + ' ' + item.unit;
        e.closest('.item').getElementsByClassName('total').item(0)
            .innerHTML = new Intl.NumberFormat(
            'uk-UA', { style: 'decimal', minimumFractionDigits: 2 }).format(item.total) + ' ₴';
    }

    updateCartTotal();
    updateCart(id, item.quantity);
    return false;
}

const updateCart = (id, quantity) => {
    $.post(domain + 'cart/update', {
        id: id,
        quantity: quantity
    });
}
