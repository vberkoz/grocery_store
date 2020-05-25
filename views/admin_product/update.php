<?php include_once ROOT . '/views/layouts/admin_header.php'?>

    <div class="col-12 mb-3">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Змінити товар</h4>
                <form action="#" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Фото</label>
                                <img src="<?php echo $image; ?>" alt="<?php echo $image; ?>" class="img-thumbnail img-fluid pb-5 mb-3">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image" name="image"
                                           accept="image/jpeg">
                                    <label class="custom-file-label" for="image">Виберіть фото...</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Назва</label>
                                <input type="text" name="title" placeholder="пр. Томат Сливка"
                                       class="form-control <?php if ($errors) {if (in_array(1, $errors)) echo 'is-invalid';} ?>"
                                       value="<?php echo $product['title']; ?>">
                                <?php if ($errors): ?>
                                    <?php if (in_array(1, $errors)): ?>
                                        <div class="invalid-feedback">Назва має бути довжиною не менше 2-х символів</div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div> <!-- form-group end.// -->
                            <div class="form-group">
                                <label>Категорія</label>
                                <select class="form-control" name="category_id">
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?php echo $category['id']; ?>"
                                            <?php if ($category['id'] == $product['category_id']) echo " selected='selected'"; ?>>
                                            <?php echo $category['title']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div> <!-- form-group end.// -->
                            <div class="form-group">
                                <label>Код</label>
                                <input type="text" name="product_id"
                                       class="form-control"
                                       value="<?php echo $product['product_id']; ?>" disabled>
                            </div> <!-- form-group end.// -->
                            <div class="form-group">
                                <label>Ціна, грн</label>
                                <input type="text" name="price" placeholder="пр. 40"
                                       class="form-control digits-only"
                                       value="<?php echo $product['price']; ?>">
                            </div> <!-- form-group end.// -->
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Об'єм</label>
                                <input type="text" name="volume" placeholder="пр. 100"
                                       class="form-control digits-only"
                                       value="<?php echo $product['volume']; ?>">
                            </div> <!-- form-group end.// -->
                            <div class="form-group">
                                <label>Одиниці виміру</label>
                                <input type="text" name="unit" placeholder="пр. г"
                                       class="form-control"
                                       value="<?php echo $product['unit']; ?>">
                            </div> <!-- form-group end.// -->
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="availability" name="availability" value="1"
                                        <?php if ($product['availability']) echo 'checked'; ?>>
                                    <label class="custom-control-label" for="availability">Є в наявності</label>
                                </div>
                            </div> <!-- form-group end.// -->
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="visibility" name="visibility" value="1"
                                        <?php if ($product['visibility']) echo 'checked'; ?>>
                                    <label class="custom-control-label" for="visibility">Показувати</label>
                                </div>
                            </div> <!-- form-group end.// -->
                        </div>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary mt-3">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 384" height="1.2em" fill="currentColor" class="align-middle pb-1">
                            <path d="M369.936,49.936l-35.888-35.888C325.056,5.056,312.848,0,300.112,0H288v96H64V0H32C14.32,0,0,14.32,0,32v320    c0,17.68,14.32,32,32,32h320c17.68,0,32-14.32,32-32V83.888C384,71.152,378.944,58.944,369.936,49.936z M320,320H64V158.944h256    V320z"/>
                            <rect x="208" y="0.002" width="48" height="64"/>
                            <rect x="96" y="192.002" width="192" height="32"/>
                            <rect x="96" y="256.002" width="192" height="32"/>
                        </svg>
                        Зберегти
                    </button>
                </form>
            </div>
        </div>
    </div>

<span class="d-none">

    <?php if (isset($errors) && is_array($errors)): ?>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><p><?php echo $error; ?></p></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form action="#" method="post" style="width: 291px;" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Title" value="<?php echo $product['title']; ?>"><br>
        <select name="category_id">
            <?php foreach ($categories as $category): ?>
                <option value="<?php echo $category['id']; ?>"
                        <?php if ($category['id'] == $product['category_id']) echo " selected='selected'"; ?>>
                    <?php echo $category['title']; ?>
                </option>
            <?php endforeach; ?>
        </select><br>
        <input type="text" name="product_id" placeholder="Product Id" value="<?php echo $product['product_id']; ?>"><br>
        <input type="number" name="price" placeholder="Price" value="<?php echo $product['price']; ?>"><br>
        <select name="availability">
            <option value="1" <?php if ($product['availability'] == 1) echo " selected='selected'"; ?>>Available</option>
            <option value="0" <?php if ($product['availability'] == 0) echo " selected='selected'"; ?>>Not Available</option>
        </select><br>
        <img src="<?php echo $image; ?>" alt="<?php echo $image; ?>" style="width: 291px;">
        <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg"><br>
        <select name="visibility">
            <option value="1" <?php if ($product['visibility'] == 1) echo " selected='selected'"; ?>>Visible</option>
            <option value="0" <?php if ($product['visibility'] == 0) echo " selected='selected'"; ?>>Not Visible</option>
        </select><br>
        <input type="submit" name="submit" value="Save">
    </form>
</span>

<?php include_once ROOT . '/views/layouts/admin_footer.php'?>