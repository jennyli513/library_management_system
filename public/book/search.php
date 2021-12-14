<?php require_once('../../private/initialize.php') ?>
<?php require_login(); ?>

<?php

//rerieve data from database

$errors = [];

 if(is_post_request())
 {
    $author = $_POST['author'] ?? '';

    if (!is_blank($author)) {
        $book_set = find_book_by_author($author);
        $count = mysqli_num_rows($book_set);
       
    }
    else
    {
        $errors[] = "Author cannot be blank.";
        $book_set = find_all_books();
        $count = 0;
    }

 }
 else
 {
     $book_set = find_all_books();
     $count = mysqli_num_rows($book_set);
 }

?>

<?php $page_title = "Books"; ?>
<?php include(SHARED_PATH. '/admin_header.php') ?>

<div id="content">
    <h1>Search for Books</h1>

    <a class="back-link" href="<?php echo url_for('/book/index.php'); ?>">&laquo;Back to Book list</a>

    <p><?php echo display_errors($errors); ?> </p>

    <form action="<?php echo url_for('/book/search.php'); ?>" method="post">
            <dl>
                <dt>Search by Author</dt>
                <dd><input type="text" name="author" value="" /></dd>
            </dl>
            <div id="operations">
                <input type="submit" value="Search" />
            </div>

   <p><?php echo $count; ?> results are shown</p>

   <?php if($count != 0) { ?>

    <table class="list">
        <tr>
            <th>Book ID</th>
            <th>Book Title</th>
            <th>ISBN</th>
            <th>Author</th>
            <th>Publication Year</th>
            <th>Category</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
        
        <!--loop through the result set and assign values to the table -->
         <?php while ($book = mysqli_fetch_assoc($book_set)) { ?>
            <?php $category = find_category_by_id($book['category_id']); ?>
          <tr>
              <td><?php echo $book['book_id']; ?></td>
              <td><?php echo $book['title']; ?></td>
              <td><?php echo $book['ISBN']; ?></td>
              <td><?php echo $book['author']; ?></td>
              <td><?php echo $book['publication_year']; ?></td>
              <td><?php echo $category['category_name']; ?></td>
              <td><a class="action" href="<?php echo url_for('/book/show.php?id=' . $book['book_id']); ?>">View</a></td>
              <td><a class="action" href="<?php echo url_for('/book/edit.php?id=' . $book['book_id']); ?>">Edit</a></td>
              <td><a class="action" href="<?php echo url_for('/book/delete.php?id=' . $book['book_id']); ?>">Delete</a></td>
          </tr>      
        <?php } ?>
    </table>
    <?php } ?>
</div>

<?php mysqli_free_result($book_set); ?>

<?php include(SHARED_PATH . '/admin_footer.php') ?>