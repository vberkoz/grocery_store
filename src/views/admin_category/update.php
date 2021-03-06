<?php include_once ROOT . '/views/layouts/admin_header.php'?>

    <div class="col-md-4"></div>
    <div class="col-md-4 mb-3">
        <div class="card mb-3">
            <div class="card-body">
                <h4 class="card-title">Змінити категорію</h4>
                <form action="#" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="categoryTitle">Назва</label>
                                <input type="text" name="title" placeholder="пр. Томат Сливка" id="categoryTitle"
                                       class="form-control <?php if ($errors) {if (in_array(1, $errors)) echo 'is-invalid';} ?>"
                                       value="<?php echo $category['title']; ?>">
                                <?php if ($errors): ?>
                                    <?php if (in_array(1, $errors)): ?>
                                        <div class="invalid-feedback">Назва має бути довжиною не менше 2-х символів</div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div> <!-- form-group end.// -->
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="visibility" name="visibility" value="1"
                                        <?php if ($category['visibility']) echo 'checked'; ?>>
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

        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Видалення категорії</h4>
                <p class="card-text">Цю дію неможливо відмінити, категорію буде видалено остаточно.</p>
                <a class="btn btn-danger" href="/admin/category/delete/<?php echo $category['id']; ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" height="1.4em" fill="currentColor" class="align-middle pb-1">
                        <path d="M425.298,51.358h-91.455V16.696c0-9.22-7.475-16.696-16.696-16.696H194.854c-9.22,0-16.696,7.475-16.696,16.696v34.662    H86.703c-9.22,0-16.696,7.475-16.696,16.696v51.357c0,9.22,7.475,16.696,16.696,16.696h338.593c9.22,0,16.696-7.475,16.696-16.696    V68.054C441.993,58.832,434.518,51.358,425.298,51.358z M300.45,51.358h-88.9V33.391h88.9V51.358z"/>
                        <path d="M93.192,169.497l13.844,326.516c0.378,8.937,7.735,15.988,16.68,15.988h264.568c8.945,0,16.302-7.051,16.68-15.989    l13.843-326.515H93.192z M205.53,444.105c0,9.22-7.475,16.696-16.696,16.696c-9.22,0-16.696-7.475-16.696-16.696V237.391    c0-9.22,7.475-16.696,16.696-16.696c9.22,0,16.696,7.475,16.696,16.696V444.105z M272.693,444.105    c0,9.22-7.475,16.696-16.696,16.696s-16.696-7.475-16.696-16.696V237.391c0-9.22,7.475-16.696,16.696-16.696    s16.696,7.475,16.696,16.696V444.105z M339.856,444.105c0,9.22-7.475,16.696-16.696,16.696s-16.696-7.475-16.696-16.696V237.391    c0-9.22,7.475-16.696,16.696-16.696s16.696,7.475,16.696,16.696V444.105z"/>
                    </svg>
                    Видалити
                </a>
            </div>
        </div>
    </div>

<span class="d-none">
    <h2>Edit Category</h2>

    <?php if (isset($errors) && is_array($errors)): ?>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><p><?php echo $error; ?></p></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form action="#" method="post" style="width: 291px;" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Title" value="<?php echo $category['title']; ?>"><br>
        <select name="visibility">
            <option value="1" <?php if ($category['visibility'] == 1) echo " selected='selected'"; ?>>Visible</option>
            <option value="0" <?php if ($category['visibility'] == 0) echo " selected='selected'"; ?>>Not Visible</option>
        </select><br>
        <input type="number" name="sort_order" placeholder="Sort Order" value="<?php echo $category['sort_order']; ?>"><br>
        <input type="submit" name="submit" value="Save">
    </form>
</span>

<?php include_once ROOT . '/views/layouts/admin_footer.php'?>