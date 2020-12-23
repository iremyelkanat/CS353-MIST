<?php

include("config.php");
session_start();

if(empty($_SESSION['a_ID']) || $_SESSION['type'] !== "curator"){
    header("location: index.php");
    die("Redirecting to login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="width=device-width, initial-scale=1.0"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MIST - Sign Up</title>
    <link rel="stylesheet" type="text/css" id="applicationStylesheet" href="../Assets/css/index.css"/>
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script id="applicationScript" type="text/javascript" src="index.js"></script>
</head>
<body>
<div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" style="font-weight: bold; font-size: xx-large; font-family: Avenir">MIST</a>
        <div class="navbar-nav">
            <a class="nav-item nav-link active">Home</a>
            <a href="store.php" class="nav-item nav-link">Store</a>
            <a href="library.php" class="nav-item nav-link">Libary</a>
            <a href="mode.php" class="nav-item nav-link">Mode</a>
            <a href="friends.php" class="nav-item nav-link">Friends</a>
        </div>
        <div  class="navbar-nav ml-auto">
            <a class="nav-item nav-link" href="logout.php">Logout</a>
        </div>
    </nav>
    <div class="main-div" style="display: flex; padding-left: 2%; padding-right: 2%; padding-top: 2%; padding-bottom: 1%">
        <div class="information-header" style="width: 70%">
            <div style="font-family: Avenir; font-size: 48px; margin-bottom: 2%">Home</div>
            <hr style="margin-right: 30%">
            <div class="information-detail-p1"; style="font-size: 24px">
                <?php
                $account_query = "SELECT u_name, nick_name, email_address FROM Accountt NATURAL JOIN User WHERE a_ID =" . $_SESSION['a_ID'] . ";";

                $account_query_result = mysqli_query($db, $account_query);
                if (!$account_query_result) {
                    printf("Error: %s\n", mysqli_error($db));
                    exit();
                }
                $account_row = mysqli_fetch_assoc($account_query_result);

                $user_full_name = $account_row['u_name'];
                $user_nick_name = $account_row['nick_name'];
                $account_email = $account_row['email_address'];

                echo "<div> User Name: " . $user_full_name . " </div>";
                echo "<div> Nick Name: " . $user_nick_name . " </div>";
                echo "<div> E-mail: " . $account_email . " </div>";
                ?>
            </div>
            <hr style="margin-right: 30%">
            <div class="information-detail-p2"; style="font-size: 24px">
                <?php
                $buy_query = "SELECT COUNT(*) AS num_of_games FROM buys b WHERE b.a_ID =" . $_SESSION['a_ID'] . ";";
                $install_query = "SELECT COUNT(*) AS num_of_games_downloaded FROM install i WHERE i.a_ID =" . $_SESSION['a_ID'] . ";";
                $friendship_query = "SELECT COUNT(*) AS num_of_friends FROM friendship f WHERE f.starter =" . $_SESSION['a_ID'] . " OR f.target = " . $_SESSION['a_ID'] .";";
                $follower_query = "SELECT COUNT(*) AS num_of_followers FROM followed_by f WHERE f.c_ID =" . $_SESSION['a_ID'] . ";";
                $comment_query = "SELECT COUNT(*) AS num_of_comments FROM comments_on c WHERE c.a_ID =" . $_SESSION['a_ID'] . ";";
                $review_query = "SELECT COUNT(*) AS num_of_reviews FROM review r WHERE r.c_ID =" . $_SESSION['a_ID'] . ";";
                $rate_query = "SELECT COUNT(*) AS num_of_rates_given FROM rates r WHERE r.a_ID =" . $_SESSION['a_ID'] . ";";
                $build_query = "SELECT COUNT(*) AS num_of_mode_published FROM builds b WHERE b.a_ID =" . $_SESSION['a_ID'] . ";";

                // num of games bought
                $buy_query_result = mysqli_query($db, $buy_query);
                if (!$buy_query_result) {
                    printf("Error: %s\n", mysqli_error($db));
                    exit();
                }
                $buy_row = mysqli_fetch_assoc($buy_query_result);
                $user_buy_count = $buy_row['num_of_games'];

                // num of games installed
                $install_query_result = mysqli_query($db, $install_query);
                if (!$install_query_result) {
                    printf("Error: %s\n", mysqli_error($db));
                    exit();
                }
                $install_row = mysqli_fetch_assoc($install_query_result);
                $user_install_count = $install_row['num_of_games_downloaded'];

                // num of friends
                $friendship_query_result = mysqli_query($db, $friendship_query);
                if (!$friendship_query_result) {
                    printf("Error: %s\n", mysqli_error($db));
                    exit();
                }
                $friendship_row = mysqli_fetch_assoc($friendship_query_result);
                $user_friendship_count = $friendship_row['num_of_friends'];

                // num of followers
                $follower_query_result = mysqli_query($db, $follower_query);
                if (!$follower_query_result) {
                    printf("Error: %s\n", mysqli_error($db));
                    exit();
                }
                $follower_row = mysqli_fetch_assoc($follower_query_result);
                $user_follower_count = $follower_row['num_of_followers'];

                // num of comments
                $comment_query_result = mysqli_query($db, $comment_query);
                if (!$comment_query_result) {
                    printf("Error: %s\n", mysqli_error($db));
                    exit();
                }
                $comment_row = mysqli_fetch_assoc($comment_query_result);
                $user_comment_count = $comment_row['num_of_comments'];

                // num of reviews
                $review_query_result = mysqli_query($db, $review_query);
                if (!$review_query_result) {
                    printf("Error: %s\n", mysqli_error($db));
                    exit();
                }
                $review_row = mysqli_fetch_assoc($review_query_result);
                $user_review_count = $review_row['num_of_reviews'];

                // num of rates
                $rate_query_result = mysqli_query($db, $rate_query);
                if (!$rate_query_result) {
                    printf("Error: %s\n", mysqli_error($db));
                    exit();
                }
                $rate_row = mysqli_fetch_assoc($rate_query_result);
                $user_rate_count = $rate_row['num_of_rates_given'];

                // num of builds
                $build_query_result = mysqli_query($db, $build_query);
                if (!$build_query_result) {
                    printf("Error: %s\n", mysqli_error($db));
                    exit();
                }
                $build_row = mysqli_fetch_assoc($build_query_result);
                $build_rate_count = $build_row['num_of_mode_published'];

                echo "<div> # of games bought: " . $user_buy_count . " </div>";
                echo "<div> # of game downloaded: " . $user_install_count . " </div>";
                echo "<div> # of friends: " . $user_friendship_count . " </div>";
                echo "<div> # of followers: " . $user_follower_count . " </div>";
                echo "<div> # of comments left: " . $user_comment_count . " </div>";
                echo "<div> # of reviews left: " . $user_review_count . " </div>";
                echo "<div> # of rates given: " . $user_rate_count . " </div>";
                echo "<div> # of modes published: " . $build_rate_count . " </div>";
                ?>
                <hr style="margin-right: 30%">
            </div>
        </div>
        <div class="wallet-information" style="width: 30%;">
            <div style="font-family: Avenir; font-size: 48px; margin-bottom: 2%; text-align: right">Wallet</div>
            <hr style="margin-left: 5%">
            <div style="width: 420px; height: 250px; float: right; position: relative; text-align: center">
                <img style="; max-height: 100%; max-width: 100%;" src="../Assets/images/wallet.jpeg" alt="">
                <?php
                    $wallet_query = "SELECT w.balance FROM Wallet w WHERE w.a_ID =" . $_SESSION['a_ID'] . ";";
                    $wallet_query_result = mysqli_query($db, $wallet_query);
                    if (!$wallet_query_result) {
                        printf("Error: %s\n", mysqli_error($db));
                        exit();
                    }
                    $wallet_row = mysqli_fetch_assoc($wallet_query_result);
                    $wallet_balance = $wallet_row['balance'];
                    echo "<h3 style='position: absolute; bottom: 8px; right: 16px;'>" . $wallet_balance. "TL</h3>";
                ?>
            </div>
            <div style="clear: both;"></div>
            <div style=" float: right; width: 420px; text-align: right";>
                <input type="button" onclick=""class="btn btn-primary btn-lg" style="width: 100%; background-color: rgb(126, 166, 234); border-color: rgb(126, 166, 234); border-radius: 20px" value="Go Wallet Options">
            </div>
        </div>
    </div>
    <div style="position: fixed;
                left: 0;
                bottom: 5px;
                width: 100%;
                text-align: center;
                font-size: 20px;
                color: rgba(112,112,112,1);">
        <p>A Game Distribution Service by Pluto++</p>
    </div>
</div>
<script type="text/javascript">
    function checkEmptyAndLogin() {
        let fullNameVal = document.getElementById("full-name").value;
        let nickNameVal = document.getElementById("nick-name").value;
        let emailVal = document.getElementById("email").value;
        let passwordVal = document.getElementById("password").value;
        let phoneNumberVal = document.getElementById("phone-number").value;
        if (fullNameVal === "" || passwordVal === "" || nickNameVal === "" || emailVal === "" | phoneNumberVal === "") {
            alert("Make sure to fill all fields!");
        }
        else {
            let form = document.getElementById("login-form").submit();
        }
    }
</script>
</body>
</html>


