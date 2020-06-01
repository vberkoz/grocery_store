<?php include_once ROOT . '/views/layouts/header.php'?>

<div class="col-md-4">
</div>
<div class="col-md-4">
    <div class="d-none w-100" id="remindSuccess">
        <div class="alert alert-success" role="alert">
            На вашу електронну пошту було вислано листа з інструкціями для відновлення паролю.
        </div>
    </div>
    <?php if ($errors): ?>
        <?php if (in_array(3, $errors)): ?>
            <div class="alert alert-danger" role="alert">Невірні дані користувача</div>
        <?php endif; ?>
    <?php endif; ?>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Вхід в акаунт</h4>
            <div style="height: 23px;"></div>
            <form action="#" method="post">
                <div class="form-group">
                    <label for="inputEmail">Електронна пошта</label>
                    <input type="email"
                           class="form-control <?php if ($errors) {if (in_array(1, $errors)) echo 'is-invalid';} ?>"
                           name="email" id="inputEmail" aria-describedby="emailHelp"
                           placeholder="пр. name@gmail.com" value="<?php echo $email; ?>">
                    <?php if ($errors): ?>
                        <?php if (in_array(1, $errors)): ?>
                            <div class="invalid-feedback" id="invalidEmail">Невірний формат електронної пошти</div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-link float-right p-0" id="remind">Не пам'ятаю</button>
                    <label for="exampleInputPassword1">Пароль</label>
                    <input type="password"
                           class="form-control <?php if ($errors) {if (in_array(2, $errors)) echo 'is-invalid';} ?>"
                           name="password" id="exampleInputPassword1" placeholder="******">
                    <?php if ($errors): ?>
                        <?php if (in_array(2, $errors)): ?>
                            <div class="invalid-feedback">Пароль має бути не менше 6-ти символів</div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" checked="">
                        <div class="custom-control-label">Запам'ятати мене</div>
                    </label>
                </div>
                <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-primary btn-block">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 515.556 515.556" height="1.2em" fill="currentColor" class="align-middle pb-1">
                            <path d="m96.667 0v96.667h64.444v-32.223h257.778v386.667h-257.778v-32.222h-64.444v96.667h386.667v-515.556z"/>
                            <path d="m157.209 331.663 45.564 45.564 119.449-119.449-119.448-119.449-45.564 45.564 41.662 41.662h-166.65v64.445h166.65z"/>
                        </svg>
                        Зайти
                    </button>
                </div>
                <p class="text-center">Вперше тут? <a href="/signup">Зареєструйся</a></p>
            </form>
        </div>
    </div>
</div>
<div class="col-md-4 mb-3"></div>

<?php include_once ROOT . '/views/layouts/footer.php'?>