<?php include_once ROOT . '/views/layouts/header.php'?>
<?php include_once ROOT . '/views/layouts/cabinet_menu.php'?>
    <aside class="col-md-9">
        <?php if (isset($result) && $result): ?>
            <div class="alert alert-success" role="alert">
                User with email <b><?php echo $user_email; ?></b> is successfully updated. Thank you!
            </div>
        <?php endif; ?>
        <div class="card">
            <article class="card-body">
                <header class="mb-4">
                    <h4 class="card-title">Edit user data</h4>
                </header>
                <form action="#" method="post">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" id="inputEmail3" placeholder="Email"
                                   value="<?php echo $user_email; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputName3" class="col-sm-3 col-form-label">Name</label>
                        <div class="col-sm-9">
                            <input type="text" name="user_name" id="inputName3" placeholder="John"
                                   class="form-control <?php if ($errors) {if (in_array(1, $errors)) echo 'is-invalid';} ?>"
                                   value="<?php echo $user_name; ?>">
                            <?php if ($errors): ?>
                                <?php if (in_array(1, $errors)): ?>
                                    <div class="invalid-feedback">Name has to be at least 2 symbols length</div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword2" class="col-sm-3 col-form-label">Old Password</label>
                        <div class="col-sm-9">
                            <input type="password" name="old" id="inputPassword2" placeholder="******"
                                   class="form-control <?php if ($errors) {if (in_array(2, $errors)) echo 'is-invalid';} ?>">
                            <?php if ($errors): ?>
                                <?php if (in_array(2, $errors)): ?>
                                    <div class="invalid-feedback">Old password is wrong</div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-9">
                            <input type="password" name="secret" id="inputPassword3" placeholder="******"
                                   class="form-control <?php if ($errors) {if (in_array(3, $errors)) echo 'is-invalid';} ?>">
                            <?php if ($errors): ?>
                                <?php if (in_array(3, $errors)): ?>
                                    <div class="invalid-feedback">Password has to be at least 6 symbols length</div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword4" class="col-sm-3 col-form-label">Repeat Password</label>
                        <div class="col-sm-9">
                            <input type="password" name="secret2" id="inputPassword4" placeholder="******"
                                   class="form-control <?php if ($errors) {if (in_array(4, $errors) || in_array(5, $errors)) echo 'is-invalid';} ?>">
                            <?php if ($errors): ?>
                                <?php if (in_array(4, $errors)): ?>
                                    <div class="invalid-feedback">Password has to be at least 6 symbols length</div>
                                <?php elseif (in_array(5, $errors)): ?>
                                    <div class="invalid-feedback">Passwords does not match</div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-9">
                            <button type="submit" name="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </article> <!-- card-body end .// -->
        </div> <!-- card.// -->
    </aside>
<?php include_once ROOT . '/views/layouts/footer.php'?>