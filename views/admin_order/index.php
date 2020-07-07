<?php include_once ROOT . '/views/layouts/admin_header.php' ?>

<div class="col-12">
<div class="card">
    <div class="card-header">
        <!-- <ul class="nav nav-pills card-header-pills"> -->
        <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
                <a class="nav-link <?php if ($_SERVER['REQUEST_URI'] == '/admin/order') echo 'active'; ?>" 
                   href="/admin/order">Вчора <span class="badge badge-danger"><?php echo $badge[1]; ?></span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if ($_SERVER['REQUEST_URI'] == '/admin/order/today') echo 'active'; ?>"
                   href="/admin/order/today">Сьогодні <span class="badge badge-danger"><?php echo $badge[0]; ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if ($_SERVER['REQUEST_URI'] == '/admin/order/all') echo 'active'; ?>"
                   href="/admin/order/all">Всі</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="col-12">
            <?php if ($products) : ?>
                <div class="card mb-3 mx-auto">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?php echo $tableTitle; ?>
                        </h5>
                        <div class="row px-3">
                            <table class="table table-responsive-sm table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Назва</th>
                                        <th scope="col" class="text-left">Об'єм</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($products as $key => $product) : ?>
                                        <tr class="product-record">
                                            <th scope="row" class="align-middle"><?php echo $key + 1; ?></th>
                                            <td class="align-middle"><?php echo $product['title']; ?></td>

                                            <td class="align-middle text-left">
                                                <?php echo $product['quantity'] . ' ';
                                                if ($product['unit'] == 'г') {
                                                    echo 'шт';
                                                } else {
                                                    echo 'кг';
                                                } ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <?php foreach ($orders as $order) : ?>
                    <div class="card mb-3 mx-auto">
                        <div class="card-body">
                            <h5 class="card-title">
                                <?php echo $order['user_name']; ?>
                                <small class="text-muted">
                                    <?php echo $order['user_phone']; ?>
                                    <?php echo $order['user_address']; ?>
                                </small>

                                <small><?php echo $order['order_id']; ?></small>

                                <a class="btn btn-outline-secondary btn-sm border-0 float-right" href="/admin/order/view/<?php echo $order['id']; ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 500" height="1.4em" fill="currentColor" class="align-middle pb-1">
                                        <path d="M244.425,98.725c-93.4,0-178.1,51.1-240.6,134.1c-5.1,6.8-5.1,16.3,0,23.1c62.5,83.1,147.2,134.2,240.6,134.2   s178.1-51.1,240.6-134.1c5.1-6.8,5.1-16.3,0-23.1C422.525,149.825,337.825,98.725,244.425,98.725z M251.125,347.025   c-62,3.9-113.2-47.2-109.3-109.3c3.2-51.2,44.7-92.7,95.9-95.9c62-3.9,113.2,47.2,109.3,109.3   C343.725,302.225,302.225,343.725,251.125,347.025z M248.025,299.625c-33.4,2.1-61-25.4-58.8-58.8c1.7-27.6,24.1-49.9,51.7-51.7   c33.4-2.1,61,25.4,58.8,58.8C297.925,275.625,275.525,297.925,248.025,299.625z" />
                                    </svg>
                                </a>

                                <?php if ($order['user_comment']): ?>
                                    <p><small><?php echo $order['user_comment']; ?></small></p>
                                <?php endif; ?>
                            </h5>
                            <div class="row px-3">
                                <table class="table table-responsive-sm table-sm">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Назва</th>
                                            <th scope="col" class="text-left">Об'єм</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($order['products'] as $key => $product) : ?>
                                            <tr class="product-record">
                                                <th scope="row" class="align-middle"><?php echo $key + 1; ?></th>
                                                <td class="align-middle"><?php echo $product['title']; ?></td>
                                                <td class="align-middle text-left">
                                                    <?php echo $product['quantity'] . ' ';
                                                    if ($product['unit'] == 'г') {
                                                        echo 'шт';
                                                    } else {
                                                        echo 'кг';
                                                    } ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="alert alert-secondary" role="alert">Замовлень немає</div>
            <?php endif; ?>
        </div>
    </div>
</div>
</div>

<?php include_once ROOT . '/views/layouts/admin_footer.php' ?>