<?php include_once ROOT . '/views/layouts/header.php'?>
<aside class="col-md-4"></aside>
<aside class="col-md-4">
    <output>
        <?php if (isset($result) && $result): ?>
            <div class="alert alert-success" role="alert">
                Your message has been sent successfully. We will contact you shortly. Thank you!
            </div>
        <?php else: ?>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Feedback</h4>
                    <form action="#" method="post">
                        <div class="form-group">
                            <label>Your email</label>
                            <input type="text" placeholder="ex. name@gmail.com"
                                   class="form-control <?php if ($errors) {if (in_array(1, $errors)) echo 'is-invalid';} ?>"
                                   value="<?php echo $userEmail; ?>" name="email">
                            <?php if ($errors): ?>
                                <?php if (in_array(1, $errors)): ?>
                                    <div class="invalid-feedback">Email is not valid</div>
                                <?php else: ?>
                                    <small class="form-text text-muted">We'll never share your email with anyone else</small>
                                <?php endif; ?>
                            <?php else: ?>
                                <small class="form-text text-muted">We'll never share your email with anyone else</small>
                            <?php endif; ?>
                        </div> <!-- form-group end.// -->
                        <div class="form-group">
                            <label>What is message about?</label>
                            <select class="form-control">
                                <option>Select</option>
                                <option>Technical issue</option>
                                <option>Money refund</option>
                                <option>Recommendation</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>What is message about?</label>
                            <textarea class="form-control" style="min-height: 100px;"
                                      value="<?php echo $userText; ?>" name="message"></textarea>
                        </div>
                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="validatedCustomFile">
                                <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                            </div>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary btn-block">Send</button>
                    </form>
                </div> <!-- card-body.// -->
            </div> <!-- card .// -->
        <?php endif; ?>
    </output>
</aside>
<aside class="col-md-4"></aside>

<?php include_once ROOT . '/views/layouts/footer.php'?>