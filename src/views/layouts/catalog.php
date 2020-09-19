<aside class="col-md-3 mb-3">
    <div class="list-group">
        <?php foreach ($categories as $category): ?>
            <a href="/category/<?php echo $category['id']; ?>"
               class="list-group-item list-group-item-action
                    <?php if (isset($categoryId)): ?>
                        <?php if ($categoryId == $category['id']): ?>
                            <?php $currentCategoryName = $category['title']; ?>active
                        <?php endif; ?>
                    <?php endif; ?>
                ">
                <?php echo $category['title']; ?>
            </a>
        <?php endforeach; ?>
    </div>
</aside>