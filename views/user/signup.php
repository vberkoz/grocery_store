<?php include_once ROOT . '/views/layouts/header.php'?>

<div class="col-md-3"></div>
<aside class="col-md-6">
    <?php if (isset($result) && $result): ?>
        <div class="alert alert-success" role="alert">
            User <b><?php echo $name; ?></b> with email <b><?php echo $email; ?></b> is successfully registered. Thank you!
        </div>
    <?php else: ?>
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
            <article class="card-body">
                <header class="mb-4">
                    <h4 class="card-title">Sign up</h4>
                </header>
                <form action="#" method="post">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" placeholder="John" value="<?php echo $name; ?>" name="name"
                               class="form-control <?php if ($errors) {if (in_array(1, $errors)) echo 'is-invalid';} ?>">
                        <?php if ($errors): ?>
                            <?php if (in_array(1, $errors)): ?>
                                <div class="invalid-feedback">Name has to be at least 2 symbols length</div>
                            <?php else: ?>
                                <div style="height: 23px;"></div>
                            <?php endif; ?>
                        <?php else: ?>
                            <div style="height: 23px;"></div>
                        <?php endif; ?>
                    </div> <!-- form-group end.// -->
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" placeholder="ex. name@gmail.com" value="<?php echo $email; ?>" name="email"
                               class="form-control <?php if ($errors) {if (in_array(2, $errors) || in_array(3, $errors)) echo 'is-invalid';} ?>">
                        <?php if ($errors): ?>
                            <?php if (in_array(2, $errors)): ?>
                                <div class="invalid-feedback">Email is not valid</div>
                            <?php elseif (in_array(3, $errors)): ?>
                                <div class="invalid-feedback">Email is already exists</div>
                            <?php else: ?>
                                <small class="form-text text-muted">We'll never share your email with anyone else</small>
                            <?php endif; ?>
                        <?php else: ?>
                            <small class="form-text text-muted">We'll never share your email with anyone else</small>
                        <?php endif; ?>
                    </div> <!-- form-group end.// -->

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Create password</label>
                            <input class="form-control <?php if ($errors) {if (in_array(4, $errors)) echo 'is-invalid';} ?>"
                                   type="password" placeholder="******" name="password">
                            <?php if ($errors): ?>
                                <?php if (in_array(4, $errors)): ?>
                                    <div class="invalid-feedback">Min 6 characters</div>
                                <?php else: ?>
                                    <div style="height: 23px;"></div>
                                <?php endif; ?>
                            <?php else: ?>
                                <div style="height: 23px;"></div>
                            <?php endif; ?>
                        </div> <!-- form-group end.// -->
                        <div class="form-group col-md-6">
                            <label>Repeat password</label>
                            <input class="form-control <?php if ($errors) {if (in_array(5, $errors)) echo 'is-invalid';} ?>"
                                   type="password" placeholder="******" name="repeat">
                            <?php if ($errors): ?>
                                <?php if (in_array(5, $errors)): ?>
                                    <div class="invalid-feedback">Passwords does not match</div>
                                <?php else: ?>
                                    <div style="height: 23px;"></div>
                                <?php endif; ?>
                            <?php else: ?>
                                <div style="height: 23px;"></div>
                            <?php endif; ?>
                        </div> <!-- form-group end.// -->
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-primary btn-block" name="submit"> Register  </button>
                    </div> <!-- form-group// -->
                </form>
                <p class="text-center">Have an account? <a href="">Sign In</a></p>
            </article> <!-- card-body end .// -->
        </div> <!-- card.// -->
    <?php endif; ?>
</aside>
<div class="col-md-3"></div>

<?php include_once ROOT . '/views/layouts/footer.php'?>