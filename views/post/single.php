<?php include_once ROOT . '/views/layouts/header.php'?>
<?php include_once ROOT . '/views/layouts/catalog.php'?>

<h1><?php echo $post['title'] ?></h1>
<em><b><?php echo $post['author'] ?></b> | Created at: <?php echo $post['created_at'] ?></em>
<p><?php echo $post['content'] ?></p>
<a href="/posts">Back to news</a><br><br>

<?php include_once ROOT . '/views/layouts/footer.php'?>