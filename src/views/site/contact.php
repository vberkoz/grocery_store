<?php include_once ROOT . '/views/layouts/header.php'?>
<aside class="col-md-4"></aside>
<aside class="col-md-4">
    <output>
        <?php if (isset($result) && $result): ?>
            <div class="alert alert-success" role="alert">
                Ваше повідомлення було успішно відправлено. Ми незабаром зв'яжемось з вами. Дякуємо!
            </div>
        <?php else: ?>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Залишити відгук</h4>
                    <form action="#" method="post">
                        <div class="form-group">
                            <label>Ваша електронна пошта</label>
                            <input type="text" placeholder="пр. name@gmail.com"
                                   class="form-control <?php if ($errors) {if (in_array(1, $errors)) echo 'is-invalid';} ?>"
                                   value="<?php echo $userEmail; ?>" name="email">
                            <?php if ($errors): ?>
                                <?php if (in_array(1, $errors)): ?>
                                    <div class="invalid-feedback">Невірний формат електронної пошти</div>
                                <?php else: ?>
                                    <small class="form-text text-muted">Ми не передаємо особисту інформацію наших клієнтів іншим сторонам.</small>
                                <?php endif; ?>
                            <?php else: ?>
                                <small class="form-text text-muted">Ми не передаємо особисту інформацію наших клієнтів іншим сторонам.</small>
                            <?php endif; ?>
                        </div> <!-- form-group end.// -->
                        <div class="form-group">
                            <label>Тема повідомлення</label>
                            <select class="form-control">
                                <option>Вибрати</option>
                                <option>Технічна проблема</option>
                                <option>Повернення коштів</option>
                                <option>Рекомендація</option>
                            </select>
                        </div> <!-- form-group end.// -->
                        <div class="form-group">
                            <label>Ваше повідомлення</label>
                            <textarea class="form-control" style="min-height: 100px;"
                                      value="<?php echo $userText; ?>" name="message"></textarea>
                        </div>
                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="validatedCustomFile">
                                <label class="custom-file-label" for="validatedCustomFile">Виберіть файл...</label>
                            </div>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary btn-block">Відправити</button>
                    </form>
                </div> <!-- card-body.// -->
            </div> <!-- card .// -->
        <?php endif; ?>
    </output>
</aside>
<aside class="col-md-4"></aside>

<?php include_once ROOT . '/views/layouts/footer.php'?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://getbootstrap.com/docs/4.0/assets/js/vendor/popper.min.js"></script>
<script src="https://getbootstrap.com/docs/4.0/dist/js/bootstrap.min.js"></script>