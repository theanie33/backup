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
function filteration($data) {
    if (is_array($data)) {
        // Recursively apply filteration to each element of the array
        foreach ($data as $key => $value) {
            $data[$key] = filteration($value);
        }
    } else if (is_string($data)) {
        // Sanitize a single string
        $data = trim($data);
        $data = stripcslashes($data);
        $data = strip_tags($data);
        $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    }
    // For non-string and non-array data, return it as-is
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
    if ($stmt = mysqli_prepare($con, $sql)) 
    {
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
