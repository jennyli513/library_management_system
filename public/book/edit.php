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
    //create a book array
    $book =[];

    $book['book_id'] = test_input($id);
    $book['title'] = test_input($_POST['title']) ?? '';
    $book['ISBN'] = test_input($_POST['ISBN']) ?? '';
    $book['author'] = test_input($_POST['author']) ?? '';
    $book['publication_year'] = test_input($_POST['publication_year']) ?? '';
    $book['category_id'] = test_input($_POST['category_id']) ?? '';

    $result = update_book($book);
    if($result === true)
    {
        $_SESSION['message'] = 'The book was updated successfully.';
        redirect_to(url_for('/book/show.php?id=' . $id));
    }
    else
    {
        $errors = $result;

    }
    
}
else
{
    $book = find_book_by_id($id);

    $book_set = find_all_books();
    $book_count = mysqli_num_rows($book_set);
    mysqli_free_result($book_set);
}


?>


<?php $page_title = "Edit book"; ?>

<?php include(SHARED_PATH . '/admin_header.php') ?>

<div id="content">
    <div class="backtolist">
       <a class="back-link" href="<?php echo url_for('/book/index.php'); ?>">&laquo;Back to Book list</a>
    </div>
    <div class="book edit">
        <h1>Edit Book</h1>

        <?php echo display_errors($errors); ?>

        <form action="<?php echo url_for('/book/edit.php?id=' . (h(u($id)))); ?>" method="post">
            <dl>
                <dt>Book Title</dt>
                <dd><input type="text" name="title" value="<?php echo h($book['title']); ?> " /></dd>
            </dl>
            <dl>
                <dt>ISBN</dt>
                <dd><input type="text" name="ISBN" value="<?php echo h($book['ISBN']); ?>" /></dd>
            </dl>
            <dl>
                <dt>Author</dt>
                <dd><input type="text" name="author" value="<?php echo h($book['author']); ?>" /></dd>
            </dl>
            <dl>
                <dt>Publication year</dt>
                <dd><input type="text" name="publication_year" value="<?php echo h($book['publication_year']); ?>" /></dd>
            </dl>
            <dl>
                <dt>Category</dt>
                <dd>
                    <select name="category_id">
                       <?php
                         $category_set = find_all_categories();
                         while($category = mysqli_fetch_assoc($category_set))
                         {
                             echo "<option value=\"" . h($category['category_id']) . "\"";
                             if($book['category_id'] == $category['category_id'])
                             {
                                 echo " selected";
                             }
                             echo ">" . h( $category['category_id']) . "-" . h($category['category_name']) . "</option>";
                         }
                         mysqli_free_result($category_set);

                       ?>
                    
                    </select>
                </dd>
            </dl>

            <div id="operations">
                <input type="submit" value="Edit Book" />
            </div>

        </form>
    </div>

</div>


<?php include(SHARED_PATH . '/admin_footer.php') ?>