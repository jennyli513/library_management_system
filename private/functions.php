<?php

//get the url
function url_for($script_path)
{
    //add the leading "/" if not present
    if($script_path[0] != '/')
    {
        $script_path = '/' . $script_path;
    }

    return WWW_ROOT . $script_path;
}

//url encode
function u($string="")
{
    return urlencode($string);
}

// raw url encode
function raw_u($string="")
{
    return rawurlencode($string);
}

//html special chars
function h($string="")
{
    return htmlspecialchars($string);
}

//error handling
function error_404()
{
    header($_SERVER["SERVER_PROTOCOL"] . " 404 not found");
    exit();
}

function error_500()
{
    header($_SERVER["SERVER_PROTOCOL"] . " 500 Internal Server Error");
    exit();
}

//header: redirect
function redirect_to($location)
{
    header("Location: " . $location);
    exit;
}

//check if the request post
function is_post_request()
{
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}
//check if get the request
function is_get_request()
{
    return $_SERVER['REQUEST_METHOD'] === 'GET';
}

function display_errors($errors=array()) {
    $output = '';
    if(!empty($errors)) {
      $output .= "<div class=\"errors\">";
      $output .= "Please fix the following errors:";
      $output .= "<ul>";
      foreach($errors as $error) {
        $output .= "<li>" . h($error) . "</li>";
      }
      $output .= "</ul>";
      $output .= "</div>";
    }
    return $output;
  }

  function get_and_clear_session_message()
  {
      if(isset($_SESSION['message']) && $_SESSION['message'] != '')
      {
          $msg = $_SESSION['message'];
          unset($_SESSION['message']);
          return $msg;
      }
  }

  function display_session_message()
  {
      $msg = get_and_clear_session_message();
      if(!is_blank($msg))
      {
          return '<div id="message">' . h($msg) . '</div>';
      }
  }

  function display_login_errors($errors=array()) {
    $output = '';
    if(!empty($errors)) {
      $output .= "<div class=\"loginerrors\">";
      $output .= "Please fix the following errors:";
      $output .= "<ul>";
      foreach($errors as $error) {
        $output .= "<li>" . $error . "</li>";
      }
      $output .= "</ul>";
      $output .= "</div>";
    }
    return $output;
  }

  //Validate Form Data
//trim(): Strip unnecessary characters (extra space, tab, newline) from the user input data
//stripslashes(): Remove backslashes (\) from the user input data
//htmlspecialchars(): onverts special characters to HTML entities
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  //debug function
  function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

?>