<?php

//database connection parameters
$hname = 'localhost';
$uname = 'root';
$pass = '';
$db = 'mywebsite';

//establish connection to DB
$con = mysqli_connect($hname, $uname, $pass, $db);

// terminate execution and display an error message if the connection fails.
if (!$con) {
    die("Cannot connect to database: " . mysqli_connect_error());
}

//santizes input data to prevent common vulnerabilities
function filteration($data){
    foreach($data as $key => $value){
        $value = trim($value); //removes whitespace 
        $value = stripcslashes($value); // removes backslashes 
        $value = strip_tags($value); // strip HTML and PHP tags
        $value = htmlspecialchars($value); //convert special characters to HTML entities 
        $data[$key] = $value; //update array with sanitized value
    } 
    return $data;
}

//retrieve all rows from the specified table.
function selectAll($table)
{
  $con = $GLOBALS['con'];
  $res = mysqli_query($con,"SELECT * FROM $table");
  return $res;
}


function select($sql, $values, $datatypes)
{
    $con = $GLOBALS['con'];
    if ($stmt = mysqli_prepare($con, $sql)) {
        mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
        if (mysqli_stmt_execute($stmt)) {
            $res = mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        } else {
            mysqli_stmt_close($stmt);
            die("Query execution failed - Select");
        }
    } else {
        die("Query preparation failed - Select");
    }
}

function update($sql, $values, $datatypes)
{
    $con = $GLOBALS['con'];
    if ($stmt = mysqli_prepare($con, $sql)) {
        mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
        if (mysqli_stmt_execute($stmt)) {
            $res = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        } else {
            mysqli_stmt_close($stmt);
            die("Query execution failed - Update");
        }
    } else {
        die("Query preparation failed - Update");
    }
}

function insert($sql, $values, $datatypes)
{
    $con = $GLOBALS['con'];
    if ($stmt = mysqli_prepare($con, $sql)) {
        mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
        if (mysqli_stmt_execute($stmt)) {
            $res = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        } else {
            mysqli_stmt_close($stmt);
            die("Query execution failed - Insert");
        }
    } else {
        die("Query preparation failed - Insert");
    }
}

function delete($sql, $values, $datatypes)
{
    $con = $GLOBALS['con'];
    if ($stmt = mysqli_prepare($con, $sql)) {
        mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
        if (mysqli_stmt_execute($stmt)) {
            $res = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        } else {
            mysqli_stmt_close($stmt);
            die("Query execution failed - Delete");
        }
    } else {
        die("Query preparation failed - Delete");
    }
}

?>
