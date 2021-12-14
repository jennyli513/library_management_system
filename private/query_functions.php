<?php

//function to find all the books in database
function find_all_books()
{
   global $db;

   $sql = "SELECT * FROM tblbook ";
   $sql .= "ORDER BY book_id ASC";
   $result = mysqli_query($db, $sql);
   //error handling: check if the result set was returned
   confirm_result_set($result);
   return $result;
}
//find book by id
function find_book_by_id($id)
{
    global $db;

    $sql = "SELECT * FROM tblbook ";
    $sql .="WHERE book_id='" . $id . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $book = mysqli_fetch_assoc($result);
    mysqli_free_result($result);

    return $book; //return an assoc array
}

//insert a new book
function insert_book($book)
{
    global $db;

    $errors = validate_book($book);
    if(!empty($errors))
    {
        return $errors;
    }

    $sql = "INSERT INTO tblbook ";
    $sql .= "(title, ISBN, author, publication_year, category_id) ";
    $sql .= "VALUES (";
    $sql .= "'" . $book['title'] . "',";
    $sql .= "'" . $book['ISBN'] . "',";
    $sql .= "'" . $book['author'] . "',";
    $sql .= "'" . $book['publication_year'] . "',";
    $sql .= "'" . $book['category_id'] . "'";
    $sql .= ")";

    $result = mysqli_query($db, $sql);
   //for Insert statement, result will return ture/false
    if($result)
    {
        return true;
    }
    else
    {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

//update a book
function update_book($book)
{
    global $db;

    $errors = validate_book($book);
    if(!empty($errors))
    {
        return $errors;
    }

    $sql = "UPDATE tblbook SET ";
    $sql .= "title='" . $book['title'] . "',";
    $sql .= "ISBN='" . $book['ISBN'] . "',";
    $sql .= "author='" . $book['author'] . "',";
    $sql .= "publication_year='" . $book['publication_year'] . "',";
    $sql .= "category_id='" . $book['category_id'] . "'";
    $sql .= "WHERE book_id='" . $book['book_id'] . "' ";
    $sql .= "LIMIT 1"; //ensure that will be only affect 1 row

    $result = mysqli_query($db, $sql);
    if($result)
    {
        return true;
    }
    else
    {
        //update failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }

}

//delete a book
function delete_book($id)
{
    global $db;

    $sql = "DELETE FROM tblbook ";
    $sql .= "WHERE book_id='" . $id . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);

    if($result)
    {
        return true;

    }
    else
    {
        //delete failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

//find all categories
function find_all_categories()
{
   global $db;

   $sql = "SELECT * FROM tblcategory ";
   $sql .= "ORDER BY category_id ASC";
   $result = mysqli_query($db, $sql);
   //error handling: check if the result set was returned
   confirm_result_set($result);
   return $result;
}

//find category by id
function find_category_by_id($id)
{
    global $db;

    $sql = "SELECT * FROM tblcategory ";
    $sql .="WHERE category_id='" . $id . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $category = mysqli_fetch_assoc($result);
    mysqli_free_result($result);

    return $category; //return an assoc array
}

function find_book_by_author($author)
{
    global $db;

    $sql = "SELECT * FROM tblbook ";
    $sql .="WHERE author LIKE '" . "%".$author."%" . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
   // $book = mysqli_fetch_assoc($result);
   // mysqli_free_result($result);

    return $result; //return an assoc array
}

function validate_book($book)
{
    $errors = [];
    
    //book title
    if(is_blank($book['title']))
    {
        $errors[] = "Book title cannot be blank.";
    }
    elseif(!has_length($book['title'], ['min' => 2, 'max' => 255]))
    {
        $errors[] = "Book title must be between 2 and 255 characters. ";
    }

    //ISBN
    if(is_blank($book['ISBN']))
    {
        $errors[] = "ISBN cannot be blank.";
    }
     elseif(!is_numeric($book['ISBN']))
     {
        $errors[] = "ISBN must be numbers.";
     }

    //author
    if(is_blank($book['author']))
    {
        $errors[] = "Author cannot be blank.";
    }
    elseif(!has_length($book['author'], ['min' => 2, 'max' => 255]))
    {
        $errors[] = "Author must be between 2 and 255 characters. ";
    }
    //publication year
    if(empty($book['publication_year'])) {
        $errors[] = "Publication year cannot be blank.";
    } else if(!is_numeric($book['publication_year'])) {
        $errors[] = "Publication year must be numbers.";
    } else if((int)$book['publication_year'] > 2021 || (int)$book['publication_year'] <1000) {
        $errors[] = "Publication year must be between 1000 to 2021 .";
    } 

    return $errors;

}

function insert_admin($admin)
{
    global $db;
    $errors = validate_admin($admin);
    if(!empty($errors))
    {
        return $errors;
    }
    $hashed_password = password_hash($admin['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO tbladmin ";
    $sql .= "(firstname, lastname, email, username, hashed_password) ";
    $sql .= "VALUES (";
    $sql .= "'" . $admin['firstname'] . "',";
    $sql .= "'" . $admin['lastname'] . "',";
    $sql .= "'" . $admin['email'] . "',";
    $sql .= "'" . $admin['username'] . "',";
    $sql .= "'" . $hashed_password . "'";
    $sql .= ")";

    $result = mysqli_query($db, $sql);

    if($result)
    {
        return true;
    }
    else
    {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}
/*
function validate_admin($admin)
{
    $errors = [];
    if(is_blank($admin['username']))
    {
        $errors[] = "Username cannot be blank.";
    }
    if(is_blank($admin['password']))
    {
        $errors[] = "Password cannot be blank.";
    }
    return $errors;
}
*/

function validate_admin($admin, $options=[]) {

    //check if the password required or not
    $password_required = $options['password_required'] ?? true;

    if(is_blank($admin['firstname'])) {
      $errors[] = "First name cannot be blank.";
    } elseif (!has_length($admin['firstname'], array('min' => 2, 'max' => 255))) {
      $errors[] = "First name must be between 2 and 255 characters.";
    }

    if(is_blank($admin['lastname'])) {
      $errors[] = "Last name cannot be blank.";
    } elseif (!has_length($admin['lastname'], array('min' => 2, 'max' => 255))) {
      $errors[] = "Last name must be between 2 and 255 characters.";
    }

    if(is_blank($admin['email'])) {
      $errors[] = "Email cannot be blank.";
    } elseif (!has_length($admin['email'], array('max' => 255))) {
      $errors[] = "Last name must be less than 255 characters.";
    } elseif (!has_valid_email_format($admin['email'])) {
      $errors[] = "Email must be a valid format.";
    }

    if(is_blank($admin['username'])) {
      $errors[] = "Username cannot be blank.";
    } elseif (!has_length($admin['username'], array('min' => 4, 'max' => 255))) {
      $errors[] = "Username must be between 4 and 255 characters.";
    } elseif (!has_unique_username($admin['username'], $admin['id'] ?? 0)) {
      $errors[] = "Username already exist. Try another one.";
    }

    if($password_required) {
      if(is_blank($admin['password'])) {
        $errors[] = "Password cannot be blank.";
      } elseif (!has_length($admin['password'], array('min' => 8))) {
        $errors[] = "Password must contain 8 or more characters";
      } elseif (!preg_match('/[A-Z]/', $admin['password'])) {
        $errors[] = "Password must contain at least 1 uppercase letter";
      } elseif (!preg_match('/[a-z]/', $admin['password'])) {
        $errors[] = "Password must contain at least 1 lowercase letter";
      } elseif (!preg_match('/[0-9]/', $admin['password'])) {
        $errors[] = "Password must contain at least 1 number";
      } elseif (!preg_match('/[^A-Za-z0-9\s]/', $admin['password'])) {
        $errors[] = "Password must contain at least 1 symbol";
      }

      if(is_blank($admin['confirm_password'])) {
        $errors[] = "Confirm password cannot be blank.";
      } elseif ($admin['password'] !== $admin['confirm_password']) {
        $errors[] = "Password and confirm password must match.";
      }
    }

    return $errors;
  }

function find_admin_by_username($username)
{
    global $db;

    $sql = "SELECT * FROM tbladmin ";
    $sql .= "WHERE username='" . $username . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $admin = mysqli_fetch_assoc($result); //find admin
    mysqli_free_result($result);
    return $admin; //return the array
}

function find_admin_by_id($id)
{
    global $db;

    $sql = "SELECT * FROM tbladmin ";
    $sql .= "WHERE id='" . $id . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $admin = mysqli_fetch_assoc($result); //find admin
    mysqli_free_result($result);
    return $admin; //return the array
}

function find_all_admins()
{
    global $db;

    $sql = "SELECT * FROM tbladmin ";
    $sql .= "ORDER BY id ASC";
    $result = mysqli_query($db, $sql);
    //error handling: check if the result set was returned
    confirm_result_set($result);
    return $result;
}

function update_admin($admin)
{
    global $db;

    $password_sent = !is_blank($admin['password']);

    $errors = validate_admin($admin, ['password_required' => $password_sent]);
    if (!empty($errors)) {
      return $errors;
    }

    $hashed_password = password_hash($admin['password'], PASSWORD_BCRYPT);

    $sql = "UPDATE tbladmin SET ";
    $sql .= "firstname='" . $admin['firstname'] . "', ";
    $sql .= "lastname='" . $admin['lastname'] . "', ";
    $sql .= "email='" .  $admin['email'] . "', ";
    if($password_sent) {
      $sql .= "hashed_password='" . $hashed_password . "', ";
    }
    $sql .= "username='" .  $admin['username'] . "' ";
    $sql .= "WHERE id='" . $admin['id'] . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    // For UPDATE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // UPDATE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
}

function delete_admin($id)
{
  global $db;

  $sql = "DELETE FROM tbladmin ";
  $sql .= "WHERE id='" . $id . "' ";
  $sql .= "LIMIT 1";

  $result = mysqli_query($db, $sql);

  if($result)
  {
      return true;

  }
  else
  {
      //delete failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
  }

}

//functions for reset password
function find_admin_by_email($email)
{
    global $db;

    $sql = "SELECT * FROM tbladmin ";
    $sql .= "WHERE email='" . $email . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $admin = mysqli_fetch_assoc($result); //find admin
    mysqli_free_result($result);
    return $admin; //return the array
}

function insert_token($email, $token)
{
    global $db;

    $sql = "INSERT INTO password_reset ";
    $sql .= "(email, token) ";
    $sql .= "VALUES (";
    $sql .= "'" . $email . "',";
    $sql .= "'" . $token . "'";
    $sql .= ")";

    $result = mysqli_query($db, $sql);

    if($result)
    {
        return true;
    }
    else
    {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function find_token_by_email($email)
{
    global $db;

    $sql = "SELECT * FROM password_reset ";
    $sql .= "WHERE email='" . $email . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $email_token_set = mysqli_fetch_assoc($result); 
    mysqli_free_result($result);
    return $email_token_set; //return the array
}

function update_token($email, $token)
{
    global $db;

    $sql = "UPDATE password_reset SET ";
    $sql .= "token='" . $token . "' ";
    $sql .= "WHERE email='" . $email . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    // For UPDATE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // UPDATE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
}

function validate_password($password, $confirmPassword)
{
        
     if (is_blank($password)) {
       $errors[] = "Password cannot be blank.";
     } elseif (!has_length($password, array('min' => 8))) {
        $errors[] = "Password must contain 8 or more characters";
    } elseif (!preg_match('/[A-Z]/', $password)) {
        $errors[] = "Password must contain at least 1 uppercase letter";
    } elseif (!preg_match('/[a-z]/', $password)) {
        $errors[] = "Password must contain at least 1 lowercase letter";
    } elseif (!preg_match('/[0-9]/', $password)) {
        $errors[] = "Password must contain at least 1 number";
    } elseif (!preg_match('/[^A-Za-z0-9\s]/', $password)) {
        $errors[] = "Password must contain at least 1 symbol";
    } elseif ($password !== $confirmPassword) {
        $errors[] = "Password and confirm password must match.";
    }

    return $errors;
}

function update_password($password, $confirmPassword, $email)
{
    global $db;

    $errors= validate_password($password, $confirmPassword);
    if (!empty($errors)) {
      return $errors;
    }
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $sql = "UPDATE tbladmin SET ";
    $sql .= "hashed_password='" . $hashed_password . "' ";
    $sql .= "WHERE email='" . $email . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    // For UPDATE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // UPDATE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
}

function is_old_password($password, $email)
{
  $admin = find_admin_by_email($email);
  if(password_verify($password, $admin['hashed_password']))
  {
    return true;
  }
  else
  {
    return false;
  }

}

function delete_token($email)
{
  global $db;

  $sql = "DELETE FROM password_reset ";
  $sql .= "WHERE email='" . $email . "' ";
  $sql .= "LIMIT 1";

  $result = mysqli_query($db, $sql);

  if($result)
  {      return true;
  }
  else
  {
      //delete failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
  }

}

?>