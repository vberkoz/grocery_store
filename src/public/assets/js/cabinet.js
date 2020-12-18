

const copy = e => {
    let id = e.parentElement.parentElement.getAttribute('data-order-id')
    let order = state.orders.find(i => i.id === id);
    let cart = [];
    order.products.map(i => {
        cart.push({id: i.id, quantity: i.quantity});
    });
    $.post(domain + 'cart/copy', {
        data: cart
    }, r => {
        r = JSON.parse(r);
        hydrateProducts();
        window.location.href = `/public/${lang}/cart.html`;
    });
}

const orders = userId => {
    $.post(domain + 'orders', {
        data: {userId, lang}
    }, r => {
        r = JSON.parse(r);
        state.orders = r;
        let orders = '';
        r.map(i => {
            orderPrice = new Intl.NumberFormat('uk-UA', { style: 'decimal', minimumFractionDigits: 2 }).format(i.price) + ' ₴';
            orderDiscount = new Intl.NumberFormat('uk-UA', { style: 'decimal', minimumFractionDigits: 2 }).format(i.discount) + ' ₴';
            orderSummary = new Intl.NumberFormat('uk-UA', { style: 'decimal', minimumFractionDigits: 2 }).format(i.price - i.discount) + ' ₴';
            let products = '';
            i.products.map(j => {
                productPrice = new Intl.NumberFormat('uk-UA', { style: 'decimal', minimumFractionDigits: 2 }).format(j.price) + ' ₴';
                productSummary = new Intl.NumberFormat('uk-UA', { style: 'decimal', minimumFractionDigits: 2 }).format(j.price * j.quantity) + ' ₴';
                products += `
                    <div class='mb-4 d-inline-block product-item'>
                        <div>
                            <div class="d-inline-block"><img class="product-image" src='http://192.168.1.100:8080/public/${lang}/img/${j.img}' alt='${j.img}'></div>
                            <div class="d-inline-block product-info">
                                <p class='product-title gradient-text mb-0'>${j.title}</p>
                                <small>
                                    <div class='text-muted'>
                                        <span class='py-2'>${j.vol} ${j.unit}</span>
                                        <span class='p-2'>${productPrice}</span>
                                    </div>
                                    <div class='text-dark'>
                                        <span class='py-2'>${j.quantity} ${j.unit}</span>
                                        <span class='p-2'>${productSummary}</span>
                                    </div>
                                </small>
                            </div>
                        </div>
                    </div>
                `;
            });
            orders += `
                <div class='card mb-3 order' data-order-id='${i.id}'>
                    <header class='card-header bg-white'>
                        <b class='d-inline-block mr-3'>${lang === 'ua' ? 'Замовлення' : 'Order'}: ${i.hash}</b>
                        <span>${i.created_at}</span>
                        <button class='btn btn-outline-secondary btn-sm border-0 ml-2 history-order-copy' onclick="copy(this)">
                            <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 330 330' height='1.4em' fill='currentColor' class='align-middle pb-1'>
                                <path d='M35,270h45v45c0,8.284,6.716,15,15,15h200c8.284,0,15-6.716,15-15V75c0-8.284-6.716-15-15-15h-45V15   c0-8.284-6.716-15-15-15H35c-8.284,0-15,6.716-15,15v240C20,263.284,26.716,270,35,270z M280,300H110V90h170V300z M50,30h170v30H95   c-8.284,0-15,6.716-15,15v165H50V30z'></path>
                                <path d='M155,120c-8.284,0-15,6.716-15,15s6.716,15,15,15h80c8.284,0,15-6.716,15-15s-6.716-15-15-15H155z'></path>
                                <path d='M235,180h-80c-8.284,0-15,6.716-15,15s6.716,15,15,15h80c8.284,0,15-6.716,15-15S243.284,180,235,180z'></path>
                                <path d='M235,240h-80c-8.284,0-15,6.716-15,15c0,8.284,6.716,15,15,15h80c8.284,0,15-6.716,15-15C250,246.716,243.284,240,235,240z'></path>
                            </svg> ${lang === 'ua' ? 'Копіювати' : 'Copy'}
                        </button>
                    </header>
                    <div class='card-body'>
                        <div class='row'>
                            <div class='col-md-3'>
                                <h6 class='text-muted'>${lang === 'ua' ? 'Оплата' : 'Payment'}</h6>
                                <p>${lang === 'ua' ? 'Товари' : 'Goods'}: <span>${orderPrice}</span>
                                <br>${lang === 'ua' ? 'Знижка' : 'Discount'}: <span class='text-danger'>${orderDiscount}</span>
                                <br>${lang === 'ua' ? 'Всього' : 'Total'}: <span>${orderSummary}</span></p>
                            </div>
                            <div class='col-md-3'>
                                <h6 class='text-muted'>${lang === 'ua' ? 'Замовник' : 'Customer'}</h6>
                                <p>${i.name}<br>${i.phone}</p>
                            </div>
                            <div class='col-md-3'>
                                <h6 class='text-muted'>${lang === 'ua' ? 'Адреса' : 'Address'}</h6>
                                <p>${i.address}</p>
                            </div>
                            <div class='col-md-3'>
                                <h6 class='text-muted'>${lang === 'ua' ? 'Повідомлення' : 'Message'}</h6>
                                <p>${i.message}</p>
                            </div>
                        </div>
                        <hr>
                        <ul class='row m-0 p-0'>${products}</ul>
                    </div>
                </div>
            `;
        });
        document.getElementById('order_list').innerHTML = orders;
    });
}

const logout = () => {
    $.get(domain + 'logout', () => {
        document.getElementById('account').classList.add('d-none');
        document.getElementById('login').classList.remove('d-none');
    });
}

const logged = () => {
    $.get(domain + 'logged', r => {
        r = JSON.parse(r);
        if (r) {
            orders(r);
            document.getElementById('account').classList.remove('d-none');
        } else {
            document.getElementById('login').classList.remove('d-none');
        }
    });
}
logged();

const login = () => {
    validate(document.getElementById('email'));
    validate(document.getElementById('secret'));
    let email = !state.errors.find(e => e === 'email');
    let secret = !state.errors.find(e => e === 'secret');
    if (email && secret && state.email && state.secret) {
        $.post(domain + 'login', {
            data: {
                email: state.email,
                secret: state.secret
            }
        }, r => {
            r = JSON.parse(r);
            if (r) {
                orders(r);
                document.getElementById('account').classList.remove('d-none');
                document.getElementById('login').classList.add('d-none');
            }
        });
    }
}
