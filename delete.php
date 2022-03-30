<?php

$array_result = Select_Result();

function DeleteRecord()
{
    require "connect.php";

    $array_result = array();
    $contact_id =  $_POST['contact_id'];

    $sql = "delete from contactus where id = $contact_id";

    if ($conn->query($sql)) {
        $array_result = Select_Result(); //select the updated values
        $html = include 'include_table.php';
        return $html;
    } else {
        echo "error" . $conn->connect_error;
    }
    $conn->close();

    header('admin_dashboard.php');
}
function Select_Result()
{
    require "connect.php";

    $array_result = array();

    $sql = "SELECT * FROM user_accounts";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $array_result = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        echo $conn->connect_error;
    }
    $conn->close();
    return $array_result;

    DeleteRecord();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Log in</title>
    <link rel="stylesheet" href="css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/admin.css">
</head>

<body>
    <div class="container">
        <div class="maindiv">
            <div>
                <div>Are you sure you want to delete this user?</div>
                <a type="button"><button class="btn btn-outline-primary">Yes</button></a>
                <a type="button" href="admin_dashboard.php"><button class="btn btn-outline-primary">No</button></a>
            </div>
        </div>
    </div>
    </div>
    </div>
</body>

</html>