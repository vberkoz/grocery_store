<?php include_once ROOT . '/views/layouts/admin_header.php'?>

    <div class="card mb-3 w-100">
        <div class="card-body">
            <?php if ($orders): ?>
                <div class="row px-3">
                    <table class="table table-responsive-sm">
                        <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">#</th>
                            <th scope="col">Замовник</th>
                            <th scope="col">Телефон</th>
                            <th scope="col">Адреса</th>
                            <th scope="col">Статус</th>
                            <th scope="col">Дата</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($orders as $key => $order): ?>
                            <tr class="product-record">
                                <td class="align-middle">
                                    <a class="btn btn-outline-secondary btn-sm border-0" href="/admin/order/view/<?php echo $order['id']; ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 500" height="1.4em" fill="currentColor" class="align-middle pb-1">
                                            <path d="M244.425,98.725c-93.4,0-178.1,51.1-240.6,134.1c-5.1,6.8-5.1,16.3,0,23.1c62.5,83.1,147.2,134.2,240.6,134.2   s178.1-51.1,240.6-134.1c5.1-6.8,5.1-16.3,0-23.1C422.525,149.825,337.825,98.725,244.425,98.725z M251.125,347.025   c-62,3.9-113.2-47.2-109.3-109.3c3.2-51.2,44.7-92.7,95.9-95.9c62-3.9,113.2,47.2,109.3,109.3   C343.725,302.225,302.225,343.725,251.125,347.025z M248.025,299.625c-33.4,2.1-61-25.4-58.8-58.8c1.7-27.6,24.1-49.9,51.7-51.7   c33.4-2.1,61,25.4,58.8,58.8C297.925,275.625,275.525,297.925,248.025,299.625z"/>
                                        </svg>
                                    </a>
                                </td>
                                <th scope="row" class="align-middle"><?php echo $key + 1; ?></th>
                                <td class="align-middle"><?php echo $order['user_name']; ?></td>
                                <td class="align-middle"><?php echo $order['user_phone']; ?></td>
                                <td class="align-middle"><?php echo $order['user_address']; ?></td>
                                <td class="align-middle">
                                    <span class="<?php echo Order::STATUS_CAPTIONS_CSS[$order['order_status']]; ?>">
                                        <?php echo Order::STATUS_CAPTIONS[$order['order_status']]; ?>
                                    </span>
                                </td>
                                <td class="align-middle"><?php echo date("m j, Y, G:i", strtotime($order['created_at'])); ?></td>
                                <td class="align-middle text-center">
                                    <a class="btn btn-outline-danger btn-sm border-0" href="/admin/order/delete/<?php echo $order['id']; ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" height="1.4em" fill="currentColor" class="align-middle pb-1">
                                            <path d="M425.298,51.358h-91.455V16.696c0-9.22-7.475-16.696-16.696-16.696H194.854c-9.22,0-16.696,7.475-16.696,16.696v34.662    H86.703c-9.22,0-16.696,7.475-16.696,16.696v51.357c0,9.22,7.475,16.696,16.696,16.696h338.593c9.22,0,16.696-7.475,16.696-16.696    V68.054C441.993,58.832,434.518,51.358,425.298,51.358z M300.45,51.358h-88.9V33.391h88.9V51.358z"/>
                                            <path d="M93.192,169.497l13.844,326.516c0.378,8.937,7.735,15.988,16.68,15.988h264.568c8.945,0,16.302-7.051,16.68-15.989    l13.843-326.515H93.192z M205.53,444.105c0,9.22-7.475,16.696-16.696,16.696c-9.22,0-16.696-7.475-16.696-16.696V237.391    c0-9.22,7.475-16.696,16.696-16.696c9.22,0,16.696,7.475,16.696,16.696V444.105z M272.693,444.105    c0,9.22-7.475,16.696-16.696,16.696s-16.696-7.475-16.696-16.696V237.391c0-9.22,7.475-16.696,16.696-16.696    s16.696,7.475,16.696,16.696V444.105z M339.856,444.105c0,9.22-7.475,16.696-16.696,16.696s-16.696-7.475-16.696-16.696V237.391    c0-9.22,7.475-16.696,16.696-16.696s16.696,7.475,16.696,16.696V444.105z"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p>Замовлень немає</p>
            <?php endif; ?>
        </div>
    </div>

<?php include_once ROOT . '/views/layouts/admin_footer.php'?>