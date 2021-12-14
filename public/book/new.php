<?php require_once('../../private/initialize.php');

require_login(); 

//$book_set = find_all_books();
//$book_count = mysqli_num_rows($book_set)

//handle form values sent by new.php
if(is_post_request())
{
    $book = [];
    $book['title'] = test_input($_POST['title']) ?? '';
    $book['ISBN'] = test_input($_POST['ISBN']) ?? '';
    $book['author'] = test_input($_POST['author']) ?? '';
    $book['publication_year'] = test_input($_POST['publication_year']) ?? '';
    $book['category_id'] = test_input($_POST['category_id']) ?? '';

    $result = insert_book($book);
    if($result === true)
    {
        $new_id = mysqli_insert_id($db);
        $_SESSION['message'] = 'The book was created successfully.';
        redirect_to(url_for('/book/show.php?id=' . $new_id));
    }
    else
    {
        $errors = $result;
    }
}
else
{
    //display the blank form
    $book = [];
    $book['title'] = '';
    $book['ISBN'] = '';
    $book['author'] = '';
    $book['publication_year'] = '';
    $book['category_id'] = '';
}




?>


<?php $page_title = "Create new book"; ?>

<?php include(SHARED_PATH . '/admin_header.php') ?>

<div id="content">
    <div class="backtolist">
       <a class="back-link" href="<?php echo url_for('/book/index.php'); ?>">&laquo;Back to Book list</a>
    </div>
    <div class="book new">
        <h1>Create new Book</h1>

        <!--display errors-->
        <?php echo display_errors($errors); ?>

        <form action="<?php echo url_for('/book/new.php'); ?>" method="post">
            <dl>
                <dt>Book Title</dt>
                <dd><input type="text" name="title" value="" /></dd>
            </dl>
            <dl>
                <dt>ISBN</dt>
                <dd><input type="text" name="ISBN" value="" /></dd>
            </dl>
            <dl>
                <dt>Author</dt>
                <dd><input type="text" name="author" value="" /></dd>
            </dl>
            <dl>
                <dt>Publication year</dt>
                <dd><input type="text" name="publication_year" value="" /></dd>
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
                             if($category['category_id'] == 1)
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
                <input type="submit" value="Create Book" />
            </div>

        </form>
    </div>

</div>


<?php include(SHARED_PATH . '/admin_footer.php') ?>