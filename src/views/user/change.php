<?php include_once ROOT . '/views/layouts/header.php'?>

    <div class="col-md-4"></div>
    <aside class="col-md-4">
        <?php if (isset($result) && $result): ?>
            <div class="alert alert-success" role="alert">
                Пароль успішно змінено.
            </div>
        <?php else: ?>
            <div class="card">
                <article class="card-body">
                    <header class="mb-4">
                        <h4 class="card-title">Змінити пароль</h4>
                    </header>
                    <form action="#" method="post">
                        <div class="form-group">
                            <label>Новий пароль</label>
                            <input class="form-control <?php if ($errors) {if (in_array(1, $errors)) echo 'is-invalid';} ?>"
                                   type="password" placeholder="******" name="password">
                            <?php if ($errors): ?>
                                <?php if (in_array(1, $errors)): ?>
                                    <div class="invalid-feedback">Мінімум 6 символів</div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div> <!-- form-group end.// -->
                        <div class="form-group">
                            <label>Повторити пароль</label>
                            <input class="form-control <?php if ($errors) {if (in_array(2, $errors)) echo 'is-invalid';} ?>"
                                   type="password" placeholder="******" name="repeat">
                            <?php if ($errors): ?>
                                <?php if (in_array(2, $errors)): ?>
                                    <div class="invalid-feedback">Паролі не співпадають</div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div> <!-- form-group end.// -->
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary btn-block" name="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 30 512 450" height="1.2em" fill="currentColor" class="align-middle pb-1">
                                    <path d="m431.964 435.333c-.921-58.994-19.3-112.636-51.977-151.474-32.487-38.601-76.515-59.859-123.987-59.859s-91.5 21.258-123.987 59.859c-32.646 38.797-51.013 92.364-51.973 151.285 18.46 9.247 94.85 44.856 175.96 44.856 87.708 0 158.845-35.4 175.964-44.667z"/>
                                    <circle cx="256" cy="120" r="88"/>
                                </svg>
                                Змінити
                            </button>
                        </div> <!-- form-group// -->
                    </form>
                </article> <!-- card-body end .// -->
            </div> <!-- card.// -->
        <?php endif; ?>
    </aside>
    <div class="col-md-4 mb-3"></div>

<?php include_once ROOT . '/views/layouts/footer.php'?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://getbootstrap.com/docs/4.0/assets/js/vendor/popper.min.js"></script>
<script src="https://getbootstrap.com/docs/4.0/dist/js/bootstrap.min.js"></script>