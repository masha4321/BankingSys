<?php
$timeout = 600;

ini_set("session.gc_maxlifetime", $timeout);
ini_set("session.cookie_lifetime", $timeout);
session_start();
$s_name = session_name();
if (isset($_COOKIE[$s_name])) {
    setcookie($s_name, $_COOKIE[$s_name], time() + $timeout, '/');
} else {
    header("Location: session_error.php");
    die();
}

if (isset($_SESSION['user_id'])) {
    $userID =  $_SESSION['user_id'];
    $array_result = InsertValue($userID);
} else {
    header("Location: session_error.php");
    die();
}

$array_result = InsertValue($userID);

foreach ($array_result as $value) {
    $userAccountNumber = $value['account_number'];
}

$array_result_banking = InsertBankingValue($userAccountNumber);

$array_result_contact = InsertContactValue($userAccountNumber);

function InsertValue($userID)
{
    require "connect.php";
    $sql = "select * from user_accounts WHERE username = '{$userID}'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $array_result = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        echo "error" . $conn->connect_error;
    }
    $conn->close();
    return $array_result;
}

function InsertBankingValue($userAccountNumber)
{
    require "connect.php";
    $sql = "select * from transactions WHERE account_number = '{$userAccountNumber}'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $array_result_banking = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        echo "error" . $conn->connect_error;
    }
    $conn->close();
    return $array_result_banking;
}

function InsertContactValue($userAccountNumber)
{
    require "connect.php";
    $sql = "select * from contact WHERE account_number = '{$userAccountNumber}'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $array_result_contact = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        echo "error" . $conn->connect_error;
    }
    $conn->close();
    return $array_result_contact;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transfer</title>
    <link rel="stylesheet" href="css/index.css">
</head>

<body>
    <div class="container">
        <div class="maindiv">
            <div class="success">Withdraw Amount</div>
            <div class="col-6">
                <?php echo $balance_log['balance'] ?>
                <?php //echo $error_log['success'];
                ?>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

                    <label for="amount">Amount <span class="error-msg"><span></label>
                    <input type="text" class="input-div-nn" id="amount" name="amount" value="<?php echo $amount; ?>">
                    <!-- <p class="error-msg"><?php echo $error_log['amount']; ?></p> -->
                    <br>
                    <label for="recipient">Recipient<span class="error-msg"></label>
                    <input type="recipient" class="input-div-nn" id="recipient" name="recipient" value="<?php echo $recipient; ?>">
                    <!-- <p class="error-msg"><?php echo $error_log['recipient']; ?></p> -->

                    <input type="submit" class="submit" value="Confirm">

                    <a href="profile.php" class="href">Cancel</a>
                    <br>
                    <a href="index.php" class="href">Logout</a>
                </form>
            </div>
            <div class="col-6"></div>
        </div>
    </div>
</body>

</html>