<?php

// NEED TO EDIT


//display all the record
if (empty($_POST)) {
    $array_result = Select_Result();
    $html = include 'include_table.php';
    return $html;
}
DeleteRecord();
function DeleteRecord()
{
    $array_result = array();
    $contact_id =  $_POST['contact_id'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "myDB";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Failed! " . $conn->connect_error);
    }
    // echo $encryption;exit;
    $sql = "delete from contactus where id = $contact_id";

    if ($conn->query($sql)) {
        $array_result = Select_Result(); //select the updated values
        $html = include 'include_table.php';
        return $html;
    } else {
        echo "error" . $conn->connect_error;
    }



    $conn->close();
}
function Select_Result()
{

    $array_result = array();

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "myDB";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Failed! " . $conn->connect_error);
    }
    // echo $encryption;exit;
    $sql = "select * from contactus";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $array_result = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        echo $conn->connect_error;
    }
    $conn->close();
    return $array_result;
}
