<?php include_once ROOT . '/views/layouts/admin_header.php'?>

    <div class="col-md-12">
        <div class="card mb-3 mx-auto">
            <div class="card-body">
                <h5 class="card-title">
                    <?php echo $user['username']; ?>
                    <small class="text-muted">
                        <?php echo $user['email']; ?>
                        <?php echo $user['phone']; ?>
                        <?php echo $user['address']; ?>
                    </small>
                </h5>

                <?php if ($products): ?>
                    <div class="row px-3">
                        <table class="table table-responsive-sm">
                            <thead>
                            <tr>
                                <th class="align-middle" scope="col">#</th>
                                <th class="align-middle" scope="col">Фото</th>
                                <th class="align-middle" scope="col">Назва</th>
                                <th class="align-middle" scope="col">
                                    <div class="dropdown">
                                        <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Категорія
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <?php foreach ($categories as $category): ?>
                                                <a class="dropdown-item"
                                                   href="/admin/user/view/<?php echo $user['id']; ?>/<?php echo $category['id']; ?>">
                                                    <?php echo $category['title']; ?>
                                                </a>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </th>
                                <th class="align-middle text-center" scope="col">Об'єм</th>
                                <th class="align-middle text-right" scope="col">Ціна</th>
                                <th class="align-middle text-right" scope="col">Знижка</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($products as $key => $product): ?>
                                <tr class="product-record">
                                    <th scope="row" class="align-middle"><?php echo $key + 1; ?></th>
                                    <td class="align-middle">
                                        <img class="img-fluid" style="width: 3em;"
                                             src="/template/images/<?php echo $product['image']; ?>"
                                             alt="<?php echo $product['title']; ?>">
                                    </td>
                                    <td class="align-middle"><?php echo $product['title']; ?></td>
                                    <td class="align-middle">
                                        <?php foreach ($categories as $category) {
                                            if ($category['id'] == $product['category_id']) echo $category['title'];
                                        } ?>
                                    </td>
                                    <td class="align-middle text-center">
                                        <?php echo $product['volume'] . ' ' . $product['unit']; ?>
                                    </td>
                                    <td class="align-middle text-right">
                                        <?php echo numfmt_format_currency($fmt, $product['price'], "UAH"); ?>
                                    </td>
                                    <td class="align-middle text-right">
                                        <input type="text"
                                               value="<?php $discountValue = '';
                                                    foreach ($discounts as $discount) {
                                                            if ($product['id'] == $discount['product_id']) {
                                                                $discountValue = $discount['currency'];
                                                            }
                                                    }
                                                    if ($discountValue) echo $discountValue;
                                                    $discountValue = ''; ?>"
                                               class="form-control text-right digits-only input-discount-currency"
                                               data-user-id="<?php echo $userId; ?>"
                                               data-product-id="<?php echo $product['id']; ?>"
                                               style="width: 50px;display: inline;">
                                        <span style="display: inline;" class="mr-2">₴</span>
                                        
                                        <?php if ($user['role'] == 'restaurant'): ?>
                                            <input type="text" value="<?php $discountValue = '';
                                                    foreach ($discounts as $discount) {
                                                            if ($product['id'] == $discount['product_id']) {
                                                                $discountValue = $discount['percent'];
                                                            }
                                                    }
                                                    if ($discountValue) echo $discountValue;
                                                    $discountValue = ''; ?>"
                                                class="form-control text-right digits-only input-discount-percent"
                                                data-user-id="<?php echo $userId; ?>"
                                                data-product-id="<?php echo $product['id']; ?>"
                                                style="width: 50px;display: inline;">
                                            <span style="display: inline;">%</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <div>
                        <?php echo $pagination->get(); ?>
                    </div>
                <?php else: ?>
                    <p>Тут ще немає жодного товару</p>
                <?php endif; ?>
            </div>
        </div>

<?php include_once ROOT . '/views/layouts/admin_footer.php'?>