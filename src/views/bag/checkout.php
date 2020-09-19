<?php include_once ROOT . '/views/layouts/header.php'?>

    <div class="col-md-12 mb-3">
        <?php if ($result): ?>
            <div class="d-flex justify-content-center w-100">
                <div class="alert alert-success" role="alert">
                    Ваше замовлення успішно оформлено і буде доставлено завтра. Дякуємо за покупку!
                </div>
            </div>
        <?php else: ?>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Ваше замовлення</h5>
                <p class="card-subtitle mb-2 text-success">Товарів: <?php echo $totalNumber; ?> на суму <?php echo numfmt_format_currency($fmt, $totalPrice, "UAH"); ?>.</p>
                <p class="card-text">Для того щоб оформити замовлення заповніть форму. Наш працівник незабаром зв'яжеться з вами.</p>
                <hr>
                <form action="#" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputName">Ваше ім'я</label>
                            <input type="text" name="userName" class="form-control <?php if ($errors) {if (in_array(1, $errors)) echo 'is-invalid';} ?>" id="inputName" placeholder="Григорій" value="<?php echo $userName; ?>">
                            <?php if ($errors): ?>
                                <?php if (in_array(1, $errors)): ?>
                                    <div class="invalid-feedback">Ім'я має бути не менше 2-х символів</div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputPhone">Номер телефону</label>
                            <input type="text" name="userPhone" class="form-control <?php if ($errors) {if (in_array(2, $errors)) echo 'is-invalid';} ?>" id="inputPhone" placeholder="0661234567" value="<?php echo $userPhone; ?>">
                            <?php if ($errors): ?>
                                <?php if (in_array(2, $errors)): ?>
                                    <div class="invalid-feedback">Мінімум 10 цифр</div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputAddress">Адреса</label>
                            <input type="text" name="userAddress" class="form-control" id="inputAddress" placeholder="Адреса" value="<?php echo $userAddress; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Коментар збирачу</label>
                        <textarea name="userComment" class="form-control" id="exampleFormControlTextarea1" rows="3"><?php echo $userComment; ?></textarea>
                        <small id="phoneHelp" class="form-text text-muted">Ми не передаємо особисту інформацію наших клієнтів іншим сторонам.</small>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Оформити замовлення</button>
                </form>
            </div>
        </div>
        <?php endif; ?>
    </div>

<?php include_once ROOT . '/views/layouts/footer.php'?>