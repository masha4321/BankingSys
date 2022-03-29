<?php
    $username = $pwd  = '';
    if(!empty($_POST)){
        if($_POST['username'] !='' ){
            $username = $_POST['username'];
        }
        if($_POST['pwd'] !='' ){
            $pwd = $_POST['pwd'];
        }
    }
    $error_log = array();
    $error_log = formValidation();
    function formValidation(){
        $error_log['username'] = $error_log['pwd'] = '';
        if(isset($_POST) && !empty($_POST)  ){
            if(trim($_POST['username']) == ''){
                $error_log['username'] = 'Please enter your Name';   
            }
            if($_POST['pwd'] == ''){
                $error_log['pwd'] = 'Please enter your Password';
            }
            if($_POST['username']!='' && $_POST['pwd']!=''){
                $error_log['sucess'] = '<p class="success">Thank you we will contact you soon</p>';
                $name = '';
            }
    }

    return $error_log;

    }
    if(isset($error_log['sucess']) && !empty($error_log['sucess'])){
       $error_log =  InsertValue();
        $name = $email = $mobile = $message = '';
    }

    function InsertValue(){
            $error_log = array();
            $error_log['username'] = $error_log['pwd']   = '';

            $servername = "localhost";
            $username = "root";
            $password = ""; 
            $dbname = "banking_system_db";
            $conn = new mysqli($servername, $username, $password, $dbname);

        $ciphering = "AES-128-CTR";
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0;
        $decryption_iv = '1234567891011121';
        $decryption_key = "GeeksforGeeks";
            if($conn ->connect_error){
                die("Failed! ". $conn->connect_error);
            }
            $sql = "select * from user_accounts where username = '$_POST[username]'";    
            $result = $conn->query($sql);
            if($result->num_rows >0){
                $row = $result->fetch_assoc();
                $decryption=openssl_decrypt ($row['pwd'], $ciphering,
                $decryption_key, $options, $decryption_iv);
                if($_POST['pwd'] == $decryption){
                    session_start();
                    $_SESSION['user_id'] = $_POST['username'];
                    header("Location: dashboard.php");
                    die();
                }
                    else{
                    $error_log['pwd'] = 'Incorrect password try again!';
                }
            } else {
                echo "error".$conn->connect_error;
                $error_log['username'] = 'Please try again!'; 
            }
        $conn->close();
        return $error_log;
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
    </head>
    <body>
        <div class="container">
            <div class="maindiv">
            <div class="success">Welcome to the log in page!</div>
            <div class="col-6">

                <?php //echo $error_log['sucess'];?>
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                    
                    <label for="username">Username <span class = "error-msg" >*<span></label>
                    <input type="text" class ="input-div-nn" id="username" name = "username"
                    value = "<?php echo $username; ?>">
                    <p class = "error-msg"><?php echo $error_log['username'];?></p>
                    
                    <label for="pwd">Password<span class = "error-msg" >*</label>
                    <input type="password" class ="input-div-nn" id="pwd" name="pwd"
                    value = "<?php echo $pwd; ?>">
                    <p class = "error-msg"><?php echo $error_log['pwd'];?></p>
                    
                    <input type="submit" class="submit" value="Confirm">

                    <a href="register.php" class="href">Register</a>
                    <br>
                    <a href="index.php" class="href">Home</a>
                </form>
            </div>
            <div class="col-6"></div>
            </div>
        </div>
    </body>
    </html>

