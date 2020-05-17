<?php include_once ROOT . '/views/layouts/header.php'?>

<div class="col-md-4">
</div>
<div class="col-md-4">
    <?php if ($errors): ?>
        <?php if (in_array(3, $errors)): ?>
            <div class="alert alert-danger" role="alert">Wrong user data</div>
        <?php else: ?>
            <div style="height: 66px;"></div>
        <?php endif; ?>
    <?php else: ?>
        <div style="height: 66px;"></div>
    <?php endif; ?>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Sign in</h4>
            <div style="height: 23px;"></div>
            <form action="#" method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email"
                           class="form-control <?php if ($errors) {if (in_array(1, $errors)) echo 'is-invalid';} ?>"
                           name="email" id="exampleInputEmail1" aria-describedby="emailHelp"
                           placeholder="ex. name@gmail.com" value="<?php echo $email; ?>">
                    <?php if ($errors): ?>
                        <?php if (in_array(1, $errors)): ?>
                            <div class="invalid-feedback">Email is not valid</div>
                        <?php else: ?>
                            <div style="height: 23px;"></div>
                        <?php endif; ?>
                    <?php else: ?>
                        <div style="height: 23px;"></div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <a class="float-right" href="#">Forgot</a>
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password"
                           class="form-control <?php if ($errors) {if (in_array(2, $errors)) echo 'is-invalid';} ?>"
                           name="password" id="exampleInputPassword1" placeholder="******">
                    <?php if ($errors): ?>
                        <?php if (in_array(2, $errors)): ?>
                            <div class="invalid-feedback">Password has to be at least 6 symbols length</div>
                        <?php else: ?>
                            <div style="height: 23px;"></div>
                        <?php endif; ?>
                    <?php else: ?>
                        <div style="height: 23px;"></div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" checked="">
                        <div class="custom-control-label">Remember</div>
                    </label>
                </div>
                <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-primary btn-block">Login</button>
                </div>
                <p class="text-center">New here? <a href="/signup">Sign up</a></p>
            </form>
        </div>
    </div>
</div>
<div class="col-md-4"></div>

<?php include_once ROOT . '/views/layouts/footer.php'?>