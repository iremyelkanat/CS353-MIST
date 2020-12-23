<?php
    include("config.php");
    session_start();

    if (isset($_GET['package_id'])) {
        $package_id = $_GET['package_id'];

        $package_query = "SELECT * FROM Subscription_Package WHERE package_ID =" . $package_id . ";";

        $package_query_result = mysqli_query($db, $package_query);
        if (!$package_query_result) {
            printf("Error: %s\n", mysqli_error($db));
            exit();
        }
        $package_row = mysqli_fetch_assoc($package_query_result);

        $package_name = $package_row['package_name'];
        $package_duration = $package_row['duration'];
        $package_price = $package_row['price'];
    }

    if (isset($_POST['unsubscribe'])) {
        $delete_query = "DELETE FROM subscribes WHERE a_ID=". $_SESSION['a_ID'] ." AND package_ID=". $package_id .";";

        $delete_query_result = mysqli_query($db, $delete_query);
        if (!$delete_query_result) {
            printf("Error: %s\n", mysqli_error($db));
            exit();
        }

        $update_wallet_query = "UPDATE Wallet w SET w.balance = w.balance + ". $package_price ." WHERE w.a_ID = " . $_SESSION['a_ID'] . ";";

        $update_wallet_result = mysqli_query($db, $update_wallet_query);
        if (!$update_wallet_result) {
            printf("Error: %s\n", mysqli_error($db));
            exit();
        }

        echo "<script LANGUAGE='JavaScript'>
                window.alert('You successfully unsubscribed from the package...');
            </script>";
    }

    elseif (isset($_POST['pay'])) {
        $get_balance_query = "SELECT balance FROM Wallet w WHERE w.a_ID=" . $_SESSION['a_ID'] . ";";
        $get_balance_query_result = mysqli_query($db, $get_balance_query);
        if (!$get_balance_query_result) {
            printf("Error: %s\n", mysqli_error($db));
            exit();
        }
        $get_balance_row = mysqli_fetch_assoc($get_balance_query_result);
        $user_balance = $get_balance_row['balance'];

        if ($user_balance < $package_price) {
            echo "<script type='text/javascript'>alert('Your balance is not sufficient.');</script>";
        }
        else {
            $date = date('Y-m-d');

            $insert_query = "INSERT INTO subscribes VALUES (". $_SESSION['a_ID'] .", ".$package_id.", now());";

            $insert_query_result = mysqli_query($db, $insert_query);
            if (!$insert_query_result) {
                printf("Error: %s\n", mysqli_error($db));
                exit();
            }

            $update_wallet_query = "UPDATE Wallet w SET w.balance = w.balance - ". $package_price ." WHERE w.a_ID = " . $_SESSION['a_ID'] . ";";

            $update_wallet_result = mysqli_query($db, $update_wallet_query);
            if (!$update_wallet_result) {
                printf("Error: %s\n", mysqli_error($db));
                exit();
            }
            echo "<script LANGUAGE='JavaScript'>
                window.alert('You successfully bought the package...');
            </script>";
        }
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
            <?php
            if ($_SESSION['type'] === "user") {
                echo "<a href='userhome.php' class='nav-item nav-link'>Home</a>";
            }
            else {
                echo "<a href='curatorhome.php' class='nav-item nav-link'>Home</a>";
            }
            ?>
            <a class="nav-item nav-link active">Store</a>
            <a href="library.php" class="nav-item nav-link">Libary</a>
            <a href="mode.php" class="nav-item nav-link">Mode</a>
            <a href="friends.php" class="nav-item nav-link">Friends</a>
        </div>
        <div  class="navbar-nav ml-auto">
            <a class="nav-item nav-link" href="logout.php">Logout</a>
        </div>
    </nav>
    <div class="main-div" style="padding-left: 2%; padding-right: 2%; padding-top: 2%; padding-bottom: 1%">
        <div class="information-header" style="width: 100%">
            <div style="display: flex; justify-content: space-between">
                <div style="font-family: Avenir; font-size: 48px;">Subscription Package</div>
                <div style=" width: 420px; text-align: right; margin-top: 10px";>
                    <?php
                        $has_query = "SELECT COUNT(*) as has_count FROM subscribes s WHERE s.a_ID=" . $_SESSION['a_ID'] . " AND s.package_ID = ". $package_id .";";
                        $has_query_result = mysqli_query($db, $has_query);
                        if (!$has_query_result) {
                            printf("Error: %s\n", mysqli_error($db));
                            exit();
                        }
                        $has_row = mysqli_fetch_assoc($has_query_result);
                        $has_count = $has_row['has_count'];

                        if ($has_count > 0) {
                            echo "<form method='post'>";
                            echo "<input type='submit' name='unsubscribe' onclick='' class='btn btn-primary btn-lg' style='font-family: Avenir; width: 100%; background-color: rgb(234, 124, 137); border-color: rgb(234, 124, 137); border-radius: 20px' value='Unsubscribe'>";
                            echo "</form>";
                        }
                        else {
                            echo "<form method='post'>";
                            echo "<input type='submit' name='pay' onclick='' class='btn btn-primary btn-lg' style='font-family: Avenir; width: 100%; background-color: rgb(93, 239, 132); border-color: rgb(93, 239, 132); border-radius: 20px' value='Subscribe for ". $package_price."TL'>";
                            echo "</form>";
                        }
                    ?>
                </div>
            </div>
            <hr style="margin-right: 60%">
        </div>
        <div class="package-details" style="width: 100%; display: flex;">
            <div class="package-details-p1" style="width: 50%">
                <div style=" display: inline-block; float:none; position: relative; vertical-align: middle; margin-top: 10%">
                    <img src="../Assets/images/package.jpeg"/>
                </div>
            </div>
            <div class="package-details-p2" style="width: 50%; font-family: Avenir; font-size: 24px">
                <?php
                    echo "<div class='package-name'; style='margin-top: 20px;'>
                            <span style='font-weight: bold'>Package Name: </span> ". $package_name."
                        </div>
                        <div class='package-duration' style='margin-top: 20px;'>
                            <span style='font-weight: bold'>Duration: </span> " . $package_duration . "
                        </div>
                        <div class='package-include' style='margin-top: 20px;''>
                            <span style='font-weight: bold'>This package includes: </span>
                        </div> ";
                ?>
                <div class="package-contents" style="width: 100%; display: flex; flex-wrap: wrap; padding-left: 0;">
                    <?php
                        $games_query = "SELECT * FROM Video_Game NATURAL JOIN contains WHERE package_ID =" . $package_id . ";";

                        $games_query_result = mysqli_query($db, $games_query);
                        if (!$package_query_result) {
                            printf("Error: %s\n", mysqli_error($db));
                            exit();
                        }
                        while ($game_row = mysqli_fetch_assoc($games_query_result)) {
                            $game_id = $game_row['g_ID'];
                            $game_name = $game_row['g_name'];

                            echo "<div class='package-item' style='margin-top: 20px; list-style: none; flex: 0 0 50%;'>
                                    <img src='../Assets/images/amongus.jpeg' style='width: 50%;'/>
                                    <div style='clear: both;'></div>
                                    " . $game_name . "
                                </div>";
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div style="position: fixed;
                left: 0;
                bottom: 0px;
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
