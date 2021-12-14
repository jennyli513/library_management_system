<?php

require_once('db_credentials.php');

//connect to database
function db_connect()
{
    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    //check database connection
    confirm_db_connect();
    return $connection;
}

//close databas connection
function db_disconnect($connection)
{
    if(isset($connection))
    {
        mysqli_close($connection);
    }
   
}

//error handling
function confirm_db_connect()
{
    if(mysqli_connect_errno())
    {
        $msg = "Datebase connection failed: ";
        $msg .= mysqli_connect_error();
        $msg .= " (" . mysqli_connect_errno() . ")";
        exit($msg);
    }
}

//check if the result set was returned
function confirm_result_set($result_set)
{
    if(!$result_set)
    {
        exit("Database query failed. ");
    }
}

//DO NOT use this function
function db_escape($connection, $string)
{
    return mysqli_real_escape_string($connection, $string);
}
?>