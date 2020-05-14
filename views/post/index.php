<?php include_once ROOT . '/views/layouts/header.php'?>
<?php include_once ROOT . '/views/layouts/catalog.php'?>

<?php foreach ($posts as $post): ?>
    <div>
        <h2><?php echo $post['title'] ?></h2>
        <em>Created at: <?php echo $post['created_at'] ?></em>
        <p><?php echo $post['excerpt'] ?></p>
        <a href="/post/<?php echo $post['id'] ?>">Read more</a><br><br>
    </div>
<?php endforeach; ?>

<?php include_once ROOT . '/views/layouts/footer.php'?>