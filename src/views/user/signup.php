<?php include_once ROOT . '/views/layouts/header.php'?>

<div class="col-md-3"></div>
<aside class="col-md-6">
    <?php if (isset($result) && $result): ?>
        <div class="alert alert-success" role="alert">
            Користувач <b><?php echo $name; ?></b> з електронною поштою <b><?php echo $email; ?></b> успішно зареєстрований. Дякуємо!
        </div>
    <?php else: ?>
        <?php if ($errors): ?>
            <?php if (in_array(3, $errors)): ?>
                <div class="alert alert-danger" role="alert">Невірні дані користувача</div>
            <?php endif; ?>
        <?php endif; ?>
        <div class="card">
            <article class="card-body">
                <header class="mb-4">
                    <h4 class="card-title">Зареєструвати користувача</h4>
                </header>
                <form action="#" method="post">
                    <div class="form-group">
                        <label>Ім'я користувача</label>
                        <input type="text" placeholder="Григорій" value="<?php echo $name; ?>" name="name"
                               class="form-control <?php if ($errors) {if (in_array(1, $errors)) echo 'is-invalid';} ?>">
                        <?php if ($errors): ?>
                            <?php if (in_array(1, $errors)): ?>
                                <div class="invalid-feedback">Ім'я має бути не менше 2-х символів</div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div> <!-- form-group end.// -->
                    <div class="form-group">
                        <label>Електронна пошта</label>
                        <input type="email" placeholder="пр. name@gmail.com" value="<?php echo $email; ?>" name="email"
                               class="form-control <?php if ($errors) {if (in_array(2, $errors) || in_array(3, $errors)) echo 'is-invalid';} ?>">
                        <?php if ($errors): ?>
                            <?php if (in_array(2, $errors)): ?>
                                <div class="invalid-feedback">Невірний формат електронної пошти</div>
                            <?php elseif (in_array(3, $errors)): ?>
                                <div class="invalid-feedback">Така електронна пошта вже існує</div>
                            <?php else: ?>
                                <small class="form-text text-muted">Ми не передаємо особисту інформацію наших клієнтів іншим сторонам.</small>
                            <?php endif; ?>
                        <?php else: ?>
                            <small class="form-text text-muted">Ми не передаємо особисту інформацію наших клієнтів іншим сторонам.</small>
                        <?php endif; ?>
                    </div> <!-- form-group end.// -->

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Створити пароль</label>
                            <input class="form-control <?php if ($errors) {if (in_array(4, $errors)) echo 'is-invalid';} ?>"
                                   type="password" placeholder="******" name="password">
                            <?php if ($errors): ?>
                                <?php if (in_array(4, $errors)): ?>
                                    <div class="invalid-feedback">Мінімум 6 символів</div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div> <!-- form-group end.// -->
                        <div class="form-group col-md-6">
                            <label>Повторити пароль</label>
                            <input class="form-control <?php if ($errors) {if (in_array(5, $errors)) echo 'is-invalid';} ?>"
                                   type="password" placeholder="******" name="repeat">
                            <?php if ($errors): ?>
                                <?php if (in_array(5, $errors)): ?>
                                    <div class="invalid-feedback">Паролі не співпадають</div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div> <!-- form-group end.// -->
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-primary btn-block" name="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 30 512 450" height="1.2em" fill="currentColor" class="align-middle pb-1">
                                <path d="m431.964 435.333c-.921-58.994-19.3-112.636-51.977-151.474-32.487-38.601-76.515-59.859-123.987-59.859s-91.5 21.258-123.987 59.859c-32.646 38.797-51.013 92.364-51.973 151.285 18.46 9.247 94.85 44.856 175.96 44.856 87.708 0 158.845-35.4 175.964-44.667z"/>
                                <circle cx="256" cy="120" r="88"/>
                            </svg>
                            Зареєструватися
                        </button>
                    </div> <!-- form-group// -->
                </form>
                <p class="text-center">Вже є акаунт? <a href="/signin">Вхід</a></p>
            </article> <!-- card-body end .// -->
        </div> <!-- card.// -->
    <?php endif; ?>
</aside>
<div class="col-md-3 mb-3"></div>

<?php include_once ROOT . '/views/layouts/footer.php'?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://getbootstrap.com/docs/4.0/assets/js/vendor/popper.min.js"></script>
<script src="https://getbootstrap.com/docs/4.0/dist/js/bootstrap.min.js"></script>