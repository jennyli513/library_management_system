<?php require_once('../../private/initialize.php') ?>

<?php

require_login(); 

$id = $_GET['id'] ?? '1';

$book = find_book_by_id($id);

$category = find_category_by_id($book['category_id']);

?>


<?php $page_title = "Show book"; ?>

<?php include(SHARED_PATH . '/admin_header.php') ?>

<div id="content">
   <a class="back-link" href="<?php echo url_for('/book/index.php'); ?>">&laquo;Back to Book list</a>

   <div class="book show">
       <h1>Book: <?php echo h($book['title']); ?></h1>

       <div class="attributes">
           <dl>
               <dt>Book Title</dt>
               <dd><?php echo h($book['title']); ?></dd>
           </dl>

           <dl>
               <dt>ISBN</dt>
               <dd><?php echo h($book['ISBN']); ?></dd>
           </dl>

           <dl>
               <dt>Author</dt>
               <dd><?php echo h($book['author']); ?></dd>
           </dl>

           <dl>
               <dt>Publication Year</dt>
               <dd><?php echo h($book['publication_year']); ?></dd>
           </dl>

           <dl>
               <dt>Category</dt>
               <dd><?php echo h($book['category_id']) ."-" . h($category['category_name']); ?></dd>
           </dl>


       </div>
   </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php') ?>