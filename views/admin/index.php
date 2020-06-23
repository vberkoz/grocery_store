<?php include_once ROOT . '/views/layouts/admin_header.php'?>

<div class="col-12">
    <?php if ($yesterdayProducts): ?>
        <div class="card mb-3 mx-auto">
            <div class="card-body">
                <h5 class="card-title">
                    Замовлено товарів від 04:00
                    <?php echo (date('j')-1) . date('-n') . date('-Y') ?>
                    до 04:00
                    <?php echo date('j') . date('-n') . date('-Y') ?>
                </h5>
                <div class="row px-3">
                    <table class="table table-responsive-sm">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Фото</th>
                            <th scope="col">Назва</th>
                            <th scope="col" class="text-center">Об'єм</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($yesterdayProducts as $key => $product): ?>
                            <tr class="product-record">
                                <th scope="row" class="align-middle"><?php echo $key + 1; ?></th>
                                <td class="align-middle">
                                    <img class="img-fluid" style="width: 3em;"
                                         src="/template/images/<?php echo $product['image']; ?>"
                                         alt="<?php echo $product['title']; ?>">
                                </td>
                                <td class="align-middle"><?php echo $product['title']; ?></td>

                                <td class="align-middle text-center"><?php echo $product['volume'] . ' ' . $product['unit']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-secondary" role="alert">Замовлень ще немає</div>
    <?php endif; ?>
</div>

<?php include_once ROOT . '/views/layouts/admin_footer.php'?>