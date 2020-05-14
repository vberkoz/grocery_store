<?php include_once ROOT . '/views/layouts/header.php'?>

    <div class="col-md-12">
        <?php if ($result): ?>
            <div class="alert alert-success" role="alert">
                Your order has been processed. We will contact you shortly. Thank you!
            </div>
        <?php else: ?>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Check Out</h5>
                <p class="card-subtitle mb-2 text-success">Selected items <?php echo $totalNumber; ?> total price <?php echo numfmt_format_currency($fmt, $totalPrice, "GBP"); ?>.</p>
                <p class="card-text">To process order complete the form. Our manager will contact you shortly.</p>
                <hr>
                <form action="#" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputName">Name</label>
                            <input type="text" name="userName" class="form-control <?php if ($errors) {if (in_array(1, $errors)) echo 'is-invalid';} ?>" id="inputName" placeholder="Name" value="<?php echo $userName; ?>">
                            <?php if ($errors): ?>
                                <?php if (in_array(1, $errors)): ?>
                                    <div class="invalid-feedback">Name has to be at least 2 symbols length</div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputPhone">Phone number</label>
                            <input type="text" name="userPhone" class="form-control <?php if ($errors) {if (in_array(2, $errors)) echo 'is-invalid';} ?>" id="inputPhone" placeholder="Phone number" value="<?php echo $userPhone; ?>">
                            <?php if ($errors): ?>
                                <?php if (in_array(2, $errors)): ?>
                                    <div class="invalid-feedback">Phone has to be at least 10 symbols length</div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputAddress">Address</label>
                            <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Comment</label>
                        <textarea name="userComment" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Comment"><?php echo $userComment; ?></textarea>
                        <small id="phoneHelp" class="form-text text-muted">We'll never share your personal information with anyone else.</small>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Process</button>
                </form>
            </div>
        </div>
        <?php endif; ?>
    </div>

<?php include_once ROOT . '/views/layouts/footer.php'?>