<?php include_once ROOT . '/views/layouts/header.php'?>
<?php include_once ROOT . '/views/layouts/cabinet_menu.php'?>
    <aside class="col-md-9 mb-3">
        <?php if (isset($result) && $result): ?>
            <div class="alert alert-success" role="alert">Дані успішно оновлено. Дякую!</div>
        <?php endif; ?>
        <div class="card mb-3">
            <article class="card-body">
                <header class="mb-4">
                    <h4 class="card-title">Змінити інформацію користувача</h4>
                </header>
                <form action="#" method="post">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Електронна пошта</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" id="inputEmail3" placeholder="Email"
                                   value="<?php echo $user_email; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputName3" class="col-sm-3 col-form-label">Ім'я</label>
                        <div class="col-sm-9">
                            <input type="text" name="user_name" id="inputName3" placeholder="John"
                                   class="form-control <?php if ($errors) {if (in_array(1, $errors)) echo 'is-invalid';} ?>"
                                   value="<?php echo $user_name; ?>">
                            <?php if ($errors): ?>
                                <?php if (in_array(1, $errors)): ?>
                                    <div class="invalid-feedback">Ім'я має бути не менше 2-х символів</div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPhone" class="col-sm-3 col-form-label">Номер телефону</label>
                        <div class="col-sm-9">
                            <input type="text" name="user_phone" id="inputPhone" placeholder="0663213211"
                                   class="form-control <?php if ($errors) {if (in_array(6, $errors)) echo 'is-invalid';} ?>"
                                   value="<?php echo $user_phone; ?>">
                            <?php if ($errors): ?>
                                <?php if (in_array(6, $errors)): ?>
                                    <div class="invalid-feedback">Номер телефону має бути 10 символів</div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputAddress" class="col-sm-3 col-form-label">Адреса доставки</label>
                        <div class="col-sm-9">
                            <input type="text" name="user_address" id="inputAddress" placeholder="Комарова 6/2"
                                   class="form-control"
                                   value="<?php echo $user_address; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-9">
                            <button type="submit" name="change_info" class="btn btn-primary">Зберегти</button>
                        </div>
                    </div>
                </form>
            </article> <!-- card-body end .// -->
        </div> <!-- card.// -->

        <div class="card">
            <article class="card-body">
                <header class="mb-4">
                    <h4 class="card-title">Змінити пароль</h4>
                </header>
                <form action="#" method="post">
                    <div class="form-group row">
                        <label for="inputPassword2" class="col-sm-3 col-form-label">Старий пароль</label>
                        <div class="col-sm-9">
                            <input type="password" name="old" id="inputPassword2" placeholder="******"
                                   class="form-control <?php if ($errors) {if (in_array(2, $errors)) echo 'is-invalid';} ?>">
                            <?php if ($errors): ?>
                                <?php if (in_array(2, $errors)): ?>
                                    <div class="invalid-feedback">Старий пароль невірний</div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-3 col-form-label">Новий пароль</label>
                        <div class="col-sm-9">
                            <input type="password" name="secret" id="inputPassword3" placeholder="******"
                                   class="form-control <?php if ($errors) {if (in_array(3, $errors)) echo 'is-invalid';} ?>">
                            <?php if ($errors): ?>
                                <?php if (in_array(3, $errors)): ?>
                                    <div class="invalid-feedback">Пароль має бути не менше 6-ти символів</div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword4" class="col-sm-3 col-form-label">Повторити пароль</label>
                        <div class="col-sm-9">
                            <input type="password" name="secret2" id="inputPassword4" placeholder="******"
                                   class="form-control <?php if ($errors) {if (in_array(4, $errors) || in_array(5, $errors)) echo 'is-invalid';} ?>">
                            <?php if ($errors): ?>
                                <?php if (in_array(4, $errors)): ?>
                                    <div class="invalid-feedback">Пароль має бути не менше 6-ти символів</div>
                                <?php elseif (in_array(5, $errors)): ?>
                                    <div class="invalid-feedback">Паролі не співпадають</div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-9">
                            <button type="submit" name="change_pass" class="btn btn-primary">Змінити</button>
                        </div>
                    </div>
                </form>
            </article> <!-- card-body end .// -->
        </div> <!-- card.// -->
    </aside>
<?php include_once ROOT . '/views/layouts/footer.php'?>