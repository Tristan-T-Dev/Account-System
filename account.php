<?php

include 'config.php';
session_start();

$user_id = $_SESSION['id'];

if (!isset($user_id)){
    header('location: login.php');
};
if (isset($_GET['logout'])){
    unset($user_id);
    session_destroy();
    header('location: login.php');
};
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    
<?php
if(isset($message)){
    foreach($message as $msg){
        echo '<div class="message" onclick="this.remove();">'.$msg.'</div>';
    }
}
?>

<header>
    <nav class="user_profile">
        <h1><a href="index.php">W</a></h1>
        <h1 class="breaker"><a href="index.php">BREAKER</a></h1>
        <details>
            <summary>
                <i class="fa-regular fa-user"></i>
            </summary>
            <ul>
                <li><a href="index.php" class="option_btn">HomePage</a></li>
                <li><a href="index.php?logout=<?php echo $user_id; ?>" onclick="return confirm('Confirm Log Out');" class="option_btn">Log Out</a></li>
            </ul>
        </details>
        </nav>
</header>

<main class="account-main">
<section class="account-section">
        <?php
            $select_user = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'") 
            or die ('query failed');
            if(mysqli_num_rows($select_user) > 0){
                $fetch_user = mysqli_fetch_assoc($select_user);
            };   
        ?>
        <div class="box">
            <div class="data-container">
                <div class="head">
                    <h3 class="data">Account Details</h3>
                </div>
                <div class="info">
                    <div class="data_item">
                        <p>Name: <?php echo $fetch_user['name'];?></p>
                    </div>
                    <div class="data_item">
                        <p>Email: <?php echo $fetch_user['email'];?></p>
                    </div>
                    <div class="data_item">
                        <p>Password: *****</p>
                    </div>
                </div>
                <!--
                <div class="heading">
                    <p> Welcome <span><?php echo $fetch_user['name']; ?></span></p>
                </div>
            -->
            </div>
            <div class="back">
            <a href="index.php"><i class="fa-solid fa-arrow-left-long"></i></a>
            </div>
        </div>
    </section>

</main>
</body>
</html>