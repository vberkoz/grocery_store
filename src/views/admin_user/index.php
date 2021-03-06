<?php include_once ROOT . '/views/layouts/admin_header.php'?>

    <div class="col-12">
        <div class="card mb-3 mx-auto">
            <div class="card-body">
                <?php if ($users): ?>
                    <div class="row px-3">
                        <table class="table table-responsive-sm">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Ім'я</th>
                                <th scope="col">Електронна пошта</th>
                                <th scope="col">Телефон</th>
                                <th scope="col" style="min-width: 200px;">Адреса</th>
                                <th scope="col">Ресторан</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($users as $key => $user): ?>
                                <tr class="product-record">
                                    <th scope="row" class="align-middle"><?php echo $key + 1; ?></th>
                                    <td class="align-middle"><?php echo $user['username']; ?></td>
                                    <td class="align-middle"><?php echo $user['email']; ?></td>
                                    <td class="align-middle"><?php echo $user['phone']; ?></td>
                                    <td class="align-middle"><?php echo $user['address']; ?></td>
                                    <td class="align-middle">
                                        <div class="form-group m-0">
                                            <div class="custom-control custom-checkbox ml-4">
                                                <input type="checkbox" 
                                                       class="custom-control-input restaurant" 
                                                       id="<?php echo 'restaurant' . ($key + 1); ?>"
                                                       data-user-id="<?php echo $user['id']; ?>"
                                                    <?php if ($user['role'] == 'restaurant') echo 'checked'; ?>>
                                                <label class="custom-control-label" for="<?php echo 'restaurant' . ($key + 1); ?>"></label>
                                            </div>
                                        </div> <!-- form-group end.// -->
                                    </td>
                                    <td class="align-middle">
                                        <a class="btn btn-outline-secondary btn-sm border-0"
                                           href="/admin/user/view/<?php echo $user['id']; ?>/1">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 500" height="1.4em" fill="currentColor" class="align-middle pb-1">
                                                <path d="M244.425,98.725c-93.4,0-178.1,51.1-240.6,134.1c-5.1,6.8-5.1,16.3,0,23.1c62.5,83.1,147.2,134.2,240.6,134.2   s178.1-51.1,240.6-134.1c5.1-6.8,5.1-16.3,0-23.1C422.525,149.825,337.825,98.725,244.425,98.725z M251.125,347.025   c-62,3.9-113.2-47.2-109.3-109.3c3.2-51.2,44.7-92.7,95.9-95.9c62-3.9,113.2,47.2,109.3,109.3   C343.725,302.225,302.225,343.725,251.125,347.025z M248.025,299.625c-33.4,2.1-61-25.4-58.8-58.8c1.7-27.6,24.1-49.9,51.7-51.7   c33.4-2.1,61,25.4,58.8,58.8C297.925,275.625,275.525,297.925,248.025,299.625z"/>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p>Користувачів немає</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

<?php include_once ROOT . '/views/layouts/admin_footer.php'?>