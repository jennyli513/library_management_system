<?php 

require_once('../../private/initialize.php');

require_login(); 

if(!isset($_GET['id']))
{
    redirect_to(url_for('/book/index.php'));
}

$id = $_GET['id'];

if(is_post_request())
{
    $result = delete_book($id);
    $_SESSION['message'] = 'The book was deleted successfully.';
    redirect_to(url_for('/book/index.php'));
}
else
{
    $book = find_book_by_id($id);
}


?>

<?php $page_title = "Delete book"; ?>

<?php include(SHARED_PATH . '/admin_header.php') ?>

<div id="content">
    <a class="back-link" href="<?php echo url_for('/book/index.php'); ?>">&laquo;Back to Book list</a>

    <div class="book delete">
        <h1>Delete Book</h1>
        <p>Are you sure you want to delete this book?</p>
        <p class="item"><?php echo "Book Title: " . h($book['title']); ?></p>

        <form action="<?php echo url_for('/book/delete.php?id=' . h(u($book['book_id']))); ?>"
         method="post">
         <div id="operations">
             <input type="submit" name="commit" value="Delete Book"/>
         </div>
        </form>
    </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php') ?>
