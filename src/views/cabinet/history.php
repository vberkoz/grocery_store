<?php include_once ROOT . '/views/layouts/header.php'?>
<?php include_once ROOT . '/views/layouts/cabinet_menu.php'?>
<aside class="col-md-9" id="order_list"></aside>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://getbootstrap.com/docs/4.0/assets/js/vendor/popper.min.js"></script>
<script src="https://getbootstrap.com/docs/4.0/dist/js/bootstrap.min.js"></script>
<script>
    $.get('/cabinet/orders', {}, r => orderHistory(r))

    let historyState = []

    const orderHistory = (data) => {
        historyState = JSON.parse(data)
        let orders = ''
        let deleteOrderButton = `
            <button class="btn btn-outline-danger btn-sm border-0 ml-2 history-order-remove">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" height="1.4em" fill="currentColor" class="align-middle pb-1">
                    <path d="M425.298,51.358h-91.455V16.696c0-9.22-7.475-16.696-16.696-16.696H194.854c-9.22,0-16.696,7.475-16.696,16.696v34.662    H86.703c-9.22,0-16.696,7.475-16.696,16.696v51.357c0,9.22,7.475,16.696,16.696,16.696h338.593c9.22,0,16.696-7.475,16.696-16.696    V68.054C441.993,58.832,434.518,51.358,425.298,51.358z M300.45,51.358h-88.9V33.391h88.9V51.358z"/>
                    <path d="M93.192,169.497l13.844,326.516c0.378,8.937,7.735,15.988,16.68,15.988h264.568c8.945,0,16.302-7.051,16.68-15.989    l13.843-326.515H93.192z M205.53,444.105c0,9.22-7.475,16.696-16.696,16.696c-9.22,0-16.696-7.475-16.696-16.696V237.391    c0-9.22,7.475-16.696,16.696-16.696c9.22,0,16.696,7.475,16.696,16.696V444.105z M272.693,444.105    c0,9.22-7.475,16.696-16.696,16.696s-16.696-7.475-16.696-16.696V237.391c0-9.22,7.475-16.696,16.696-16.696    s16.696,7.475,16.696,16.696V444.105z M339.856,444.105c0,9.22-7.475,16.696-16.696,16.696s-16.696-7.475-16.696-16.696V237.391    c0-9.22,7.475-16.696,16.696-16.696s16.696,7.475,16.696,16.696V444.105z"/>
                </svg>
                Видалити
            </button>
        `
        historyState.map(order => {
            let orderProductsPrice = 0
            let orderProductsDiscount = 0
            let orderProductsTotal = 0
            order.products.map(product => {
                orderProductsPrice += product.price * product.quantity
                let discount_client = parseFloat(product.discount_client)
                orderProductsDiscount += (discount_client + (product.price / 100 * product.discount_restaurant)) * product.quantity
                orderProductsTotal = orderProductsPrice - orderProductsDiscount
            })
            order.price = orderProductsPrice
            order.discount = orderProductsDiscount
            order.total = orderProductsTotal
            orders += `
            <article class="card mb-3 order" data-order-id="${order.id}">
                <header class="card-header bg-white">
                    <b class="d-inline-block mr-3">Замовлення: ${order.order_id}</b>
                    <span>${order.created_at}</span>
                    ${parseInt(order.editable) ? deleteOrderButton : ''}
                    <button class="btn btn-outline-secondary btn-sm border-0 ml-2 history-order-copy">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 330 330" height="1.4em" fill="currentColor" class="align-middle pb-1">
                            <path d="M35,270h45v45c0,8.284,6.716,15,15,15h200c8.284,0,15-6.716,15-15V75c0-8.284-6.716-15-15-15h-45V15   c0-8.284-6.716-15-15-15H35c-8.284,0-15,6.716-15,15v240C20,263.284,26.716,270,35,270z M280,300H110V90h170V300z M50,30h170v30H95   c-8.284,0-15,6.716-15,15v165H50V30z"/>
                            <path d="M155,120c-8.284,0-15,6.716-15,15s6.716,15,15,15h80c8.284,0,15-6.716,15-15s-6.716-15-15-15H155z"/>
                            <path d="M235,180h-80c-8.284,0-15,6.716-15,15s6.716,15,15,15h80c8.284,0,15-6.716,15-15S243.284,180,235,180z"/>
                            <path d="M235,240h-80c-8.284,0-15,6.716-15,15c0,8.284,6.716,15,15,15h80c8.284,0,15-6.716,15-15C250,246.716,243.284,240,235,240z   "/>
                        </svg>
                        Копіювати
                    </button>
                </header>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <h6 class="text-muted">Оплата</h6>
                            <p>
                                Товари: <span class="price">${new Intl.NumberFormat('uk-UA', { style: 'decimal', minimumFractionDigits: 2 }).format(orderProductsPrice) + ' ₴'}</span><br>
                                Знижка: <span class="discount text-danger">${new Intl.NumberFormat('uk-UA', { style: 'decimal', minimumFractionDigits: 2 }).format(orderProductsDiscount) + ' ₴'}</span><br>
                                Всього: <span class="total">${new Intl.NumberFormat('uk-UA', { style: 'decimal', minimumFractionDigits: 2 }).format(orderProductsTotal) + ' ₴'}</span>
                            </p>
                        </div>
                        <div class="col-md-4">
                            <h6 class="text-muted">Замовник</h6>
                            <p>${order.user_name}<br>${order.user_phone}</p>
                        </div>
                        <div class="col-md-4">
                            <h6 class="text-muted">Адреса</h6>
                            <p>${order.user_address ? order.user_address : 'Не вказана'}</p>
                        </div>
                    </div> <!-- row.// -->
                    <hr>
                    ${parseInt(order.editable) ? orderHistoryEditableProducts(order.products) : orderHistoryReadableProducts(order.products)}
                </div> <!-- card-body .// -->
            </article>
            `
        })
        $('#order_list').html(orders)
        $('#spinner').addClass('d-none')
    }

    const orderHistoryReadableProducts = (data) => {
        let products = '<ul class="row m-0 p-0">'
        data.map(i => {
            let price = parseFloat(i.price)
            let quantity = parseFloat(i.quantity)
            let item_total = quantity * price
            products += `
                <div class="col-6 col-md-4 mb-2">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="/template/images/${i.image}" alt="${i.image}" class="img-fluid">
                        </div>
                        <div class="col-md-8">
                            <p class="title mb-0">${i.title}</p>
                            <small>
                                <div class="text-muted">
                                    <span class="py-2">${new Intl.NumberFormat('uk-UA', { style: 'decimal', minimumFractionDigits: 2 }).format(item_total) + ' ₴'}</span>
                                    <span class="p-2">${i.quantity} ${i.unit}</span>
                                </div>
                            </small>
                        </div>
                    </div>
                </div>
            `
        })
        products += '</ul>'
        return products
    }

    const orderHistoryEditableProducts = (data) => {
        let products = `
        <table class="table-responsive">
            <tbody>
                <thead>
                    <tr class="small text-uppercase text-muted">
                        <th scope="col" class="px-3">Продукт</th>
                        <th scope="col" class="px-3" width="200">Кількість</th>
                        <th scope="col" class="px-3" width="150">Ціна</th>
                        <th scope="col" class="text-right d-none d-md-block px-3" width="170"> </th>
                    </tr>
                </thead>
        `
        data.map(i => {
            let price = parseFloat(i.price)
            let quantity = parseFloat(i.quantity)
            let item_total = quantity * price
            let inputTypeClass = i.unit === 'шт' ? 'bag-input-int' : 'bag-input-float'

            products += `
                <tr class="product" data-product-id="${i.id}">
                    <td class="p-3" style="min-width: 280px;">
                        <div class="row">
                            <div class="col-4"><img class="img-fluid" src="/template/images/${i.image}" alt="${i.image}"></div>
                            <div class="col-8">
                                <p class="m-0">${i.title}</p>
                                <small class="text-muted">${i.volume} ${i.unit}</small>
                            </div>
                        </div>
                    </td>
                    <td class="p-3 quantity-col" style="min-width: 180px;">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-primary history-minus" type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 459 459" height="0.6em" fill="currentColor" class="align-middle">
                                        <path d="M459.313,229.648c0,22.201-17.992,40.199-40.205,40.199H40.181c-11.094,0-21.14-4.498-28.416-11.774   C4.495,250.808,0,240.76,0,229.66c-0.006-22.204,17.992-40.199,40.202-40.193h378.936   C441.333,189.472,459.308,207.456,459.313,229.648z"/>
                                    </svg>
                                </button>
                            </div>
                            <input type="text" class="form-control text-center ${inputTypeClass} history-change" value="${i.quantity} ${i.unit}" disabled>
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary history-plus" type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 448" height="0.8em" fill="currentColor" class="align-middle">
                                        <path d="m408 184h-136c-4.417969 0-8-3.582031-8-8v-136c0-22.089844-17.910156-40-40-40s-40 17.910156-40 40v136c0 4.417969-3.582031 8-8 8h-136c-22.089844 0-40 17.910156-40 40s17.910156 40 40 40h136c4.417969 0 8 3.582031 8 8v136c0 22.089844 17.910156 40 40 40s40-17.910156 40-40v-136c0-4.417969 3.582031-8 8-8h136c22.089844 0 40-17.910156 40-40s-17.910156-40-40-40zm0 0"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </td>
                    <td class="p-3" style="min-width: 100px;">
                        <p>
                            <span id="item-total-${i.id}">${new Intl.NumberFormat('uk-UA', { style: 'decimal', minimumFractionDigits: 2 }).format(item_total) + ' ₴'}</span><br>
                            <small class="text-muted item-price">${new Intl.NumberFormat('uk-UA', { style: 'decimal', minimumFractionDigits: 2 }).format(price) + ' ₴'}</small>
                        </p>
                    </td>
                    <td class="p-3">
                        <button class="btn btn-outline-danger history-product-remove">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" height="1.4em" fill="currentColor" class="align-middle pb-1">
                                <path d="M425.298,51.358h-91.455V16.696c0-9.22-7.475-16.696-16.696-16.696H194.854c-9.22,0-16.696,7.475-16.696,16.696v34.662    H86.703c-9.22,0-16.696,7.475-16.696,16.696v51.357c0,9.22,7.475,16.696,16.696,16.696h338.593c9.22,0,16.696-7.475,16.696-16.696    V68.054C441.993,58.832,434.518,51.358,425.298,51.358z M300.45,51.358h-88.9V33.391h88.9V51.358z"/>
                                <path d="M93.192,169.497l13.844,326.516c0.378,8.937,7.735,15.988,16.68,15.988h264.568c8.945,0,16.302-7.051,16.68-15.989    l13.843-326.515H93.192z M205.53,444.105c0,9.22-7.475,16.696-16.696,16.696c-9.22,0-16.696-7.475-16.696-16.696V237.391    c0-9.22,7.475-16.696,16.696-16.696c9.22,0,16.696,7.475,16.696,16.696V444.105z M272.693,444.105    c0,9.22-7.475,16.696-16.696,16.696s-16.696-7.475-16.696-16.696V237.391c0-9.22,7.475-16.696,16.696-16.696    s16.696,7.475,16.696,16.696V444.105z M339.856,444.105c0,9.22-7.475,16.696-16.696,16.696s-16.696-7.475-16.696-16.696V237.391    c0-9.22,7.475-16.696,16.696-16.696s16.696,7.475,16.696,16.696V444.105z"/>
                            </svg>
                        </button>
                    </td>
                </tr>
            `
        })
        products += `
        </tbody></table>
        <input class="form-control w-100 product-index-search" type="search" placeholder="Додати новий товар" id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" autocomplete="off">
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" aria-labelledby="dLabel"></div>
        `
        return products
    }

    $('#order_list').on('keyup click', '.product-index-search', e => {
        $.post('/search', {
            search_term: $(e.target.closest('.product-index-search')).val(),
            user_id: 18
        }, function (r) {
            let products = '';
            JSON.parse(r).slice(0, 5).map(i => {
                products += `<a class="dropdown-item" href="#" data-product-id="${i.id}">${i.title}</a>`
            })
            $('.dropdown-menu').html(products);
        })
    })

    $('#order_list').on('click', '.dropdown-item', e => {
        e.preventDefault()
        $.post('/cabinet/order/product/add', {
            order_id: $(e.target.closest('.order')).attr('data-order-id'),
            product_id: $(e.target.closest('.dropdown-item')).attr('data-product-id')
        }, r => {
            console.log(JSON.parse(r))
        })
        $('#order_list').empty()
        $.get('/cabinet/orders', {}, r => orderHistory(r))
    })

    $('#order_list').on('click', '.history-plus', e => {
        updateHistoryState($(e.target.closest('.order')).attr('data-order-id'), $(e.target.closest('.product')).attr('data-product-id'), e, 'PLUS')
    })

    $('#order_list').on('click', '.history-minus', e => {
        updateHistoryState($(e.target.closest('.order')).attr('data-order-id'), $(e.target.closest('.product')).attr('data-product-id'), e, 'MINUS')
    })

    $('#order_list').on('click', '.history-product-remove', e => {
        updateHistoryState($(e.target.closest('.order')).attr('data-order-id'), $(e.target.closest('.product')).attr('data-product-id'), e, 'REMOVE')
    })

    $('#order_list').on('click', '.history-order-remove', e => {
        e.target.closest('.order').remove()
        $.post('/cabinet/order/remove', {order_id: $(e.target.closest('.order')).attr('data-order-id')})
    })

    $('#order_list').on('click', '.history-order-copy', e => {
        $.post('/cabinet/order/copy', {order_id: $(e.target.closest('.order')).attr('data-order-id')}, r => {
            $('#order_list').empty()
            $.get('/cabinet/orders', {}, r => orderHistory(r))
        })
    })

    const updateHistoryState = (orderId, productId, event, action) => {
        historyState.map(order => {
            if (parseInt(order.id) === parseInt(orderId)) {
                order.products.map((product, index) => {
                    if (parseInt(product.id) === parseInt(productId)) {
                        let productQuantity = 0;
                        switch (action) {
                            case 'PLUS':
                                product.quantity = Math.round((parseFloat(product.quantity) + parseFloat(product.volume_min)) * 10) / 10;
                                productQuantity = product.quantity
                                event.target.closest('.history-plus').parentElement.previousSibling.previousSibling.value = product.quantity + ' ' + product.unit;
                                $('#item-total-' + product.id).text(new Intl.NumberFormat('uk-UA', { style: 'decimal', minimumFractionDigits: 2 }).format(product.quantity * product.price) + ' ₴')

                                order.price += product.volume_min * product.price
                                order.discount += (product.volume_min * product.discount_client) + (product.price / 100 * product.discount_restaurant * product.volume_min)
                                order.total = order.price - order.discount
                                event.target.closest('.order').getElementsByClassName('price')[0].textContent = new Intl.NumberFormat('uk-UA', { style: 'decimal', minimumFractionDigits: 2 }).format(order.price) + ' ₴'
                                event.target.closest('.order').getElementsByClassName('discount')[0].textContent = new Intl.NumberFormat('uk-UA', { style: 'decimal', minimumFractionDigits: 2 }).format(order.discount) + ' ₴'
                                event.target.closest('.order').getElementsByClassName('total')[0].textContent = new Intl.NumberFormat('uk-UA', { style: 'decimal', minimumFractionDigits: 2 }).format(order.total) + ' ₴'
                                break;

                            case 'MINUS':
                                product.quantity = Math.round((parseFloat(product.quantity) - parseFloat(product.volume_min)) * 10) / 10;
                                productQuantity = product.quantity
                                event.target.closest('.history-minus').parentElement.nextSibling.nextSibling.value = product.quantity + ' ' + product.unit;
                                $('#item-total-' + product.id).text(new Intl.NumberFormat('uk-UA', { style: 'decimal', minimumFractionDigits: 2 }).format(product.quantity * product.price) + ' ₴')

                                order.price -= product.volume_min * product.price
                                order.discount -= (product.volume_min * product.discount_client) + (product.price / 100 * product.discount_restaurant * product.volume_min)
                                order.total = order.price - order.discount
                                event.target.closest('.order').getElementsByClassName('price')[0].textContent = new Intl.NumberFormat('uk-UA', { style: 'decimal', minimumFractionDigits: 2 }).format(order.price) + ' ₴'
                                event.target.closest('.order').getElementsByClassName('discount')[0].textContent = new Intl.NumberFormat('uk-UA', { style: 'decimal', minimumFractionDigits: 2 }).format(order.discount) + ' ₴'
                                event.target.closest('.order').getElementsByClassName('total')[0].textContent = new Intl.NumberFormat('uk-UA', { style: 'decimal', minimumFractionDigits: 2 }).format(order.total) + ' ₴'
                                if (parseFloat(product.quantity) < parseFloat(product.volume_min)) {
                                    if (order.products.length == 1) {
                                        productQuantity = 0
                                        event.target.closest('.order').remove()
                                        $.post('/cabinet/order/remove', {order_id: order.id})
                                    } else {
                                        productQuantity = 0
                                        order.products.splice(index, 1)
                                        event.target.closest('.product').remove()
                                    }
                                } else {
                                    event.target.closest('.history-minus').parentElement.nextSibling.nextSibling.value = product.quantity + ' ' + product.unit;
                                }
                                break;

                            case 'REMOVE':
                                if (order.products.length == 1) {
                                    productQuantity = 0
                                    event.target.closest('.order').remove()
                                    $.post('/cabinet/order/remove', {order_id: order.id})
                                } else {
                                    productQuantity = 0
                                    order.products.splice(index, 1)
                                    event.target.closest('.product').remove()
                                }
                                break;

                            default:
                                break;
                        }
                        $.post('/cabinet/order/update', {
                            order_id: order.id,
                            product_id: product.product_id,
                            quantity: productQuantity
                        })
                    }
                })
            }
        })
    }

</script>
<?php include_once ROOT . '/views/layouts/footer.php'?>
