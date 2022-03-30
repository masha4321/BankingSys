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