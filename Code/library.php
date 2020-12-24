<?php
    include("config.php");
    session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="width=device-width, initial-scale=1.0" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MIST - Library</title>
    <link rel="stylesheet" type="text/css" id="applicationStylesheet" href="../Assets/css/index.css" />
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
                <a href="store.php" class="nav-item nav-link">Store</a>
                <a class="nav-item nav-link active">Libary</a>
                <a href="mode.php" class="nav-item nav-link">Mode</a>
                <a href="friends.php" class="nav-item nav-link">Friends</a>
            </div>
            <div class="navbar-nav ml-auto">
                <a class="nav-item nav-link" href="logout.php">Logout</a>
            </div>
        </nav>
        <div class="main-div"
            style="display: flex; padding-left: 2%; padding-right: 2%; padding-top: 2%; padding-bottom: 1%">
            <div class="information-header" style="width: 100%">
                <div style="font-family: Avenir; font-size: 48px ; margin-bottom: 2%">Library</div>
                <hr style="margin-right: 20%">
                <div class="games-bought-display">
                <div style=" overflow-x: scroll; white-space: nowrap;">
                    <div style="font-family: Avenir; font-size: 25px ; font-weight: bold; margin-bottom: 2%">Games Bought</div>
                    <?php
                    $games_bought_query = "SELECT v.g_name, v.g_image FROM buys b, Video_Game v WHERE b.g_ID=v.g_ID AND b.a_ID =" . $_SESSION['a_ID'] . ";";
                    $games_bought_result = mysqli_query($db, $games_bought_query);
                    if (!$games_bought_result) {
                        printf("Error: %s\n", mysqli_error($db));
                        exit();
                    }
                    if (mysqli_num_rows($games_bought_result) > 0) {
                        while ($games__bought_row = mysqli_fetch_assoc($games_bought_result)) {
                            $game_id = $games__bought_row['g_ID'];
                            $game_name = $games__bought_row['g_name'];

                            echo "<a href='videogame.php?game_id=". $game_id ."'>
                                <div style='display: inline-block; float:none; position: relative'>
                                    <img src='../Assets/images/package.jpeg'/>
                                    <h3 style='font-weight: lighter; font-family: Avenir; font-size: 24px; color: white ; padding-left: 20px; padding-right: 20px; padding-bottom: 10px; padding-top: 10px; position: absolute; background-color: rgb(90,90,90); border-style: solid; border-radius: 30px; border-color: rgb(90,90,90); bottom: 8px; left: 16px;'>". $game_name ."</h3>
                                    <h3 style='font-weight: lighter; font-family: Avenir; font-size: 24px; color: white ; padding-left: 20px; padding-right: 20px; padding-bottom: 10px; padding-top: 10px; position: absolute; bottom: 8px; right: 16px; background-color: rgb(90,90,90); border-style: solid; border-radius: 30px; border-color: rgb(90,90,90);'> X </h3>
                                </div>
                            </a>";
                        }
                    }
                    else {
                        echo "no results";
                    }
                    ?>
                </div>
            </div>
            <div class="package_subscribed_display">
                <div style=" overflow-x: scroll; white-space: nowrap;">
                    <div style="font-family: Avenir; font-size: 25px; font-weight: bold; margin-bottom: 2%">Current Subscriptions</div>
                    <?php
                        $current_subscriptions_query = "SELECT sp.package_name FROM subscribes s, Subscription_Package sp WHERE sp.package_ID = s.package_ID AND s.a_ID =" . $_SESSION['a_ID'] . ";";
                        $current_subscriptions_result = mysqli_query($db, $current_subscriptions_query);        
                        if (!$current_subscriptions_result) {
                            printf("Error: %s\n", mysqli_error($db));
                            exit();
                        }
                        if (mysqli_num_rows($current_subscriptions_result) > 0) {
                            while ($packages_row = mysqli_fetch_assoc($current_subscriptions_result)) {
                                $package_id = $packages_row['package_ID'];
                                $package_name = $packages_row['package_name'];

                                echo "<a href='subscriptionpackage.php?package_id=". $package_id ."'>
                                <div style='display: inline-block; float:none; position: relative'>
                                    <img src='../Assets/images/package.jpeg'/>
                                    <h3 style='font-weight: lighter; font-family: Avenir; font-size: 24px; color: white ; padding-left: 20px; padding-right: 20px; padding-bottom: 10px; padding-top: 10px; position: absolute; background-color: rgb(90,90,90); border-style: solid; border-radius: 30px; border-color: rgb(90,90,90); bottom: 8px; left: 16px;'>". $package_name ."</h3>
                                    <h3 style='font-weight: lighter; font-family: Avenir; font-size: 24px; color: white ; padding-left: 20px; padding-right: 20px; padding-bottom: 10px; padding-top: 10px; position: absolute; bottom: 8px; right: 16px; background-color: rgb(90,90,90); border-style: solid; border-radius: 30px; border-color: rgb(90,90,90);'> X </h3>
                                </div>
                            </a>";
                            }
                        }
                        else {
                            echo "no results";
                        }
                    ?>
                </div>
            </div>
            <div class="games-from-packages-display">
                <div style=" overflow-x: scroll; white-space: nowrap;">
                <div style="font-family: Avenir; font-size: 25px; font-weight: bold; margin-bottom: 2%">Games From Subscriptions</div>
                    <?php
                    $package_games_query = "SELECT g.g_name, g.g_image FROM contains c, subscribes s, Video_Game g WHERE c.package_ID=s.package_ID AND g.g_ID = c.g_ID AND s.a_ID =" . $_SESSION['a_ID'] . ";";
                    $package_games_result = mysqli_query($db, $package_games_query);
                    if (!$package_games_result) {
                        printf("Error: %s\n", mysqli_error($db));
                        exit();
                    }
                    if (mysqli_num_rows($package_games_result) > 0) {
                        while ($games__bought_row = mysqli_fetch_assoc($package_games_result)) {
                            $game_id = $games__bought_row['g_ID'];
                            $game_name = $games__bought_row['g_name'];

                            echo "<a href='videogame.php?game_id=". $game_id ."'>
                                <div style='display: inline-block; float:none; position: relative'>
                                    <img src='../Assets/images/package.jpeg'/>
                                    <h3 style='font-weight: lighter; font-family: Avenir; font-size: 24px; color: white ; padding-left: 20px; padding-right: 20px; padding-bottom: 10px; padding-top: 10px; position: absolute; background-color: rgb(90,90,90); border-style: solid; border-radius: 30px; border-color: rgb(90,90,90); bottom: 8px; left: 16px;'>". $game_name ."</h3>
                                    <h3 style='font-weight: lighter; font-family: Avenir; font-size: 24px; color: white ; padding-left: 20px; padding-right: 20px; padding-bottom: 10px; padding-top: 10px; position: absolute; bottom: 8px; right: 16px; background-color: rgb(90,90,90); border-style: solid; border-radius: 30px; border-color: rgb(90,90,90);'> X </h3>
                                </div>
                            </a>";
                        }
                    }
                    else {
                        echo "no results";
                    }
                    ?>
                </div>
            </div>
            <div class="games-downloaded-display">
                <div style=" overflow-x: scroll; white-space: nowrap;">
                    <div style="font-family: Avenir; font-size: 25px; font-weight: bold ; margin-bottom: 2%">Games Downloaded</div>
                    <?php
                    $downloaded_games_query = "SELECT g.g_name, g.g_image FROM install i, Video_Game g WHERE i.g_ID = g.g_ID AND i.a_ID =" . $_SESSION['a_ID'] . ";";
                    $downloaded_games_result = mysqli_query($db, $downloaded_games_query);
                    if (!$downloaded_games_result) {
                        printf("Error: %s\n", mysqli_error($db));
                        exit();
                    }
                    if (mysqli_num_rows($downloaded_games_result) > 0) {
                        while ($games_downloaded_row = mysqli_fetch_assoc($downloaded_games_result)) {
                            $game_id = $games_downloaded_row['g_ID'];
                            $game_name = $games_downloaded_row['g_name'];
                            echo "<a href='videogame.php?game_id=". $game_id ."'>
                                <div style='display: inline-block; float:none; position: relative'>
                                    <img src='../Assets/images/package.jpeg'/>
                                    <h3 style='font-weight: lighter; font-family: Avenir; font-size: 24px; color: white ; padding-left: 20px; padding-right: 20px; padding-bottom: 10px; padding-top: 10px; position: absolute; background-color: rgb(90,90,90); border-style: solid; border-radius: 30px; border-color: rgb(90,90,90); bottom: 8px; left: 16px;'>". $game_name ."</h3>
                                    <h3 style='font-weight: lighter; font-family: Avenir; font-size: 24px; color: white ; padding-left: 20px; padding-right: 20px; padding-bottom: 10px; padding-top: 10px; position: absolute; bottom: 8px; right: 16px; background-color: rgb(90,90,90); border-style: solid; border-radius: 30px; border-color: rgb(90,90,90);'> X </h3>
                                </div>
                            </a>";
                        }
                    }
                    else {
                        echo "no results";
                    }
                    ?>
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
                if (fullNameVal === "" || passwordVal === "" || nickNameVal === "" || emailVal === "" |
                    phoneNumberVal === "") {
                    alert("Make sure to fill all fields!");
                } else {
                    let form = document.getElementById("login-form").submit();
                }
            }
            </script>
        </div>
</body>

</html>