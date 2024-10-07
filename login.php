<?php 

include 'config.php';
session_start();

if (isset($_POST['submit'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

    $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND
     password = '$pass'") or die('query failed');

    if(mysqli_num_rows($select) > 0){
        $row = mysqli_fetch_assoc($select);
        $_SESSION['id'] = $row['id'];
        header('Location: index.php');
    }else{
        $message[] = 'Incorrect Password or Email';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    if(isset($message)){
        foreach($message as $msg){
            echo '<div class="message" onclick="this.remove();">'.$msg.'</div>';
        }
    }
    ?>
    <div class="form-container">
        <form action="" method="post">
            <h3>Log In</h3>
            <input type="text" name="email" required placeholder="Enter Email" class="box">
            <input type="password" name="password" required placeholder="Enter Password" class="box">
            <input type="submit" name="submit" class="btn" value="Log In Now">
            <p>Don't have an Account? <a href="register.php">Register Now</a></p>
        </form>
    </div>
</body>
</html>