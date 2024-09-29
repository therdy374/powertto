<?php
session_start();

require 'dbcon.php';

// input field validation
function validate($inputData)
{
    global $conn;
    $validateData = mysqli_real_escape_string($conn, $inputData);
    return trim($validateData);
}

//insert record using this function
function insert($tableName, $data)
{
    global $conn;

    $table = validate($tableName);

    $columns = array_keys($data);
    $values = array_values($data);

    $finalColumn = implode(',', $columns);
    $finalValues = "'" . implode("', '", $values) . "'";

    $query = "INSERT INTO $table ($finalColumn) VALUES ($finalValues)";
    $result = mysqli_query($conn, $query);
    return $result;
}


// update data using this function
function update($tableName, $id, $data)
{
    global $conn;

    $table = validate($tableName);
    $id = validate($id);

    $updateDataString = "";

    foreach ($data as $column => $value) {
        $updateDataString .= $column . '=' . "'$value',";
    }

    $finalUpdateData = substr(trim($updateDataString), 0, -1);

    $query = "UPDATE $table SET $finalUpdateData WHERE id='$id'";
    $result = mysqli_query($conn, $query);

    // Check if the update was successful and the password was updated
    if ($result && isset($data['password'])) {
        // Destroy session to automatically logout user
        session_destroy();
    }

    return $result;
}


// get all data
function getAll($tableName, $status = NULL)
{
    global $conn;

    $table = validate($tableName);
    $status = validate($status);

    if ($status == 'status') {
        $query = "SELECT * FROM $table WHERE status='0'";
    } else {
        $query = "SELECT * FROM $table";
    }
    return mysqli_query($conn, $query);
}

// get each data
function getById($tableName, $id)
{
    global $conn;

    $table = validate($tableName);
    $id = validate($id);

    $query = "SELECT * FROM $table WHERE id='$id' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $response = [
                'status' => 200,
                'data' => $row,
                'message' => 'Record Found'
            ];
            return $response;
        } else {
            $response = [
                'status' => 404,
                'message' => 'No Data Found'
            ];
            return $response;
        }
    } else {
        $response = [
            'status' => 500,
            'message' => 'something went wrong'
        ];
        return $response;
    }
}

// get delete data
function delete($tableName, $id)
{
    global $conn;

    $table = validate($tableName);
    $id = validate($id);

    $query = "DELETE FROM $table WHERE id='$id' LIMIT 1";
    $result = mysqli_query($conn, $query);
    return $result;
}

// check paramater
function checkParamId($type)
{
    if (isset($_GET[$type])) {
        if ($_GET[$type] != '') {
            return $_GET[$type];
        } else {
            return '<h5>No Id Found!</h5>';
        }
    } else {
        return '<h5>No Id Given!</h5>';
    }
}

// logged out session
function logoutSession()
{
    unset($_SESSION['loggedIn']);
    unset($_SESSION['loggeInUser']);
    // session_destroy();
}

// redirect from 1 page to another with the msg
function redirect($url, $status)
{
    $_SESSION['status'] = $status;
    header('Location:' . $url);
    exit(0);
}

// display msg or status after any process
function alertMessage()
{
    if (isset($_SESSION['status'])) {

        echo '<script>alert("POWER TTO!\n' . $_SESSION['status'] . ' ")</script>';
        unset($_SESSION['status']);
    }
}
