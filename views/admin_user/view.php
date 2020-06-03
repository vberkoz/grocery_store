<?php include_once ROOT . '/views/layouts/admin_header.php'?>

    <div class="col-md-3">
        <div class="card mb-3">
            <div class="card-body">
                <div class="form-group">
                    <label>Ім'я</label>
                    <input type="text" class="form-control" value="<?php echo $user['username']; ?>" disabled>
                </div> <!-- form-group end.// -->
                <div class="form-group">
                    <label>Телефон</label>
                    <input type="text" class="form-control" value="<?php echo $user['phone']; ?>" disabled>
                </div> <!-- form-group end.// -->
                <div class="form-group">
                    <label>Адреса</label>
                    <input type="text" class="form-control" value="<?php echo $user['address']; ?>" disabled>
                </div> <!-- form-group end.// -->
                <div class="form-group">
                    <label>Електронна пошта</label>
                    <input type="text" class="form-control" value="<?php echo $user['email']; ?>" disabled>
                </div> <!-- form-group end.// -->
                <div class="form-group">
                    <label>Знижка</label>
                    <select class="form-control discount" user-id="<?php echo $user['id']; ?>">
                        <option value="0" <?php if ($user['discount'] == 0) echo 'selected'; ?>>0 %</option>
                        <option value="5" <?php if ($user['discount'] == 5) echo 'selected'; ?>>5 %</option>
                        <option value="10" <?php if ($user['discount'] == 10) echo 'selected'; ?>>10 %</option>
                        <option value="15" <?php if ($user['discount'] == 15) echo 'selected'; ?>>15 %</option>
                        <option value="20" <?php if ($user['discount'] == 20) echo 'selected'; ?>>20 %</option>
                        <option value="25" <?php if ($user['discount'] == 25) echo 'selected'; ?>>25 %</option>
                        <option value="30" <?php if ($user['discount'] == 30) echo 'selected'; ?>>30 %</option>
                    </select>
                </div> <!-- form-group end.// -->
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <?php if ($products): ?>
        <div class="card mb-3 w-100">
            <div class="card-body">
                <div class="row px-3">
                    <table class="table table-responsive-sm">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Фото</th>
                                <th scope="col">Назва</th>
                                <th scope="col" class="text-center">Об'єм</th>
                                <th scope="col" class="text-right">Сума</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td colspan="4"></td>
                            <td class="align-middle text-right"><strong><?php echo numfmt_format_currency($fmt, $total, "UAH"); ?></strong></td>
                        </tr>
                        <?php foreach ($products as $key => $product): ?>
                            <tr class="product-record">
                                <th scope="row" class="align-middle"><?php echo $key + 1; ?></th>
                                <td class="align-middle">
                                    <img class="img-fluid" style="width: 3em;"
                                         src="/template/images/<?php echo $product['image']; ?>"
                                         alt="<?php echo $product['title']; ?>">
                                </td>
                                <td class="align-middle"><?php echo $product['title']; ?></td>

                                <td class="align-middle text-center"><?php echo $product['volume'] . ' ' . $product['unit']; ?></td>
                                <td class="align-middle text-right"><?php echo numfmt_format_currency($fmt, $product['price'], "UAH"); ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php else: ?>
            <div class="alert alert-secondary" role="alert">Користувач ще не робив замовлень</div>
        <?php endif; ?>
    </div>

<?php include_once ROOT . '/views/layouts/admin_footer.php'?>