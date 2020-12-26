<?php
    include("config.php");
    session_start();
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
    <div class="main-div" style="display: flex; padding-left: 2%; padding-right: 2%; padding-top: 2%; padding-bottom: 1%">
        <div class="information-header" style="width: 100%">
            <div style="font-family: Avenir; font-size: 48px;">Store</div>
            <hr>
            <div style="font-family: Avenir; font-size: 32px; margin-bottom:10px">Subscription Packages</div>
            <div class="sub-package">
                <div style=" overflow-x: scroll; white-space: nowrap;">
                    <?php
                        $packages_query = "SELECT * FROM Subscription_Package;";
                        $packages_query_result = mysqli_query($db, $packages_query);
                        if (!$packages_query_result) {
                            printf("Error: %s\n", mysqli_error($db));
                            exit();
                        }
                        if (mysqli_num_rows($packages_query_result) > 0) {
                            while ($packages_row = mysqli_fetch_assoc($packages_query_result)) {
                                $package_id = $packages_row['package_ID'];
                                $package_name = $packages_row['package_name'];
                                $package_price = $packages_row['price'];

                                echo "<a href='subscriptionpackage.php?package_id=". $package_id ."'>
                                <div style='display: inline-block; float:none; position: relative'>
                                    <img src='../Assets/images/package.jpeg'/>
                                    <h3 style='font-weight: lighter; font-family: Avenir; font-size: 24px; color: white ; padding-left: 20px; padding-right: 20px; padding-bottom: 10px; padding-top: 10px; position: absolute; background-color: rgb(90,90,90); border-style: solid; border-radius: 30px; border-color: rgb(90,90,90); bottom: 8px; left: 16px;'>". $package_name ."</h3>
                                    <h3 style='font-weight: lighter; font-family: Avenir; font-size: 24px; color: white ; padding-left: 20px; padding-right: 20px; padding-bottom: 10px; padding-top: 10px; position: absolute; bottom: 8px; right: 16px; background-color: rgb(90,90,90); border-style: solid; border-radius: 30px; border-color: rgb(90,90,90);'>". $package_price."TL</h3>
                                </div>
                            </a>";
                            }
                        }
                        else {
                            echo "no results";
                        }
                    ?>
                    <a href="subscriptionpackage.php?package_id=1">
                        <div style=" display: inline-block; float:none; position: relative">
                            <img src="../Assets/images/package.jpeg"/>
                            <h3 style="font-weight: lighter; font-family: Avenir; font-size: 24px; color: white ; padding-left: 20px; padding-right: 20px; padding-bottom: 10px; padding-top: 10px; position: absolute; background-color: rgb(90,90,90); border-style: solid; border-radius: 30px; border-color: rgb(90,90,90); bottom: 8px; left: 16px;">Sub Package #1</h3>
                            <h3 style="font-weight: lighter; font-family: Avenir; font-size: 24px; color: white ; padding-left: 20px; padding-right: 20px; padding-bottom: 10px; padding-top: 10px; position: absolute; bottom: 8px; right: 16px; background-color: rgb(90,90,90); border-style: solid; border-radius: 30px; border-color: rgb(90,90,90);">40TL</h3>
                        </div>
                    </a>
                    <div style=" display: inline-block; float:none; position: relative">
                        <img src="../Assets/images/package.jpeg"/>
                        <h3 style="font-weight: lighter; font-family: Avenir; font-size: 24px; color: white ; padding-left: 20px; padding-right: 20px; padding-bottom: 10px; padding-top: 10px; position: absolute; background-color: rgb(90,90,90); border-style: solid; border-radius: 30px; border-color: rgb(90,90,90); bottom: 8px; left: 16px;">Sub Package #2</h3>
                        <h3 style="font-weight: lighter; font-family: Avenir; font-size: 24px; color: white ; padding-left: 20px; padding-right: 20px; padding-bottom: 10px; padding-top: 10px; position: absolute; bottom: 8px; right: 16px; background-color: rgb(90,90,90); border-style: solid; border-radius: 30px; border-color: rgb(90,90,90);">40TL</h3>
                    </div>
                    <div style=" display: inline-block; float:none; position: relative">
                        <img src="../Assets/images/package.jpeg"/>
                        <h3 style="font-weight: lighter; font-family: Avenir; font-size: 24px; color: white ; padding-left: 20px; padding-right: 20px; padding-bottom: 10px; padding-top: 10px; position: absolute; background-color: rgb(90,90,90); border-style: solid; border-radius: 30px; border-color: rgb(90,90,90); bottom: 8px; left: 16px;">Sub Package #3</h3>
                        <h3 style="font-weight: lighter; font-family: Avenir; font-size: 24px; color: white ; padding-left: 20px; padding-right: 20px; padding-bottom: 10px; padding-top: 10px; position: absolute; bottom: 8px; right: 16px; background-color: rgb(90,90,90); border-style: solid; border-radius: 30px; border-color: rgb(90,90,90);">40TL</h3>
                    </div>
                    <div style=" display: inline-block; float:none; position: relative">
                        <img src="../Assets/images/package.jpeg"/>
                        <h3 style="font-weight: lighter; font-family: Avenir; font-size: 24px; color: white ; padding-left: 20px; padding-right: 20px; padding-bottom: 10px; padding-top: 10px; position: absolute; background-color: rgb(90,90,90); border-style: solid; border-radius: 30px; border-color: rgb(90,90,90); bottom: 8px; left: 16px;">Sub Package #4</h3>
                        <h3 style="font-weight: lighter; font-family: Avenir; font-size: 24px; color: white ; padding-left: 20px; padding-right: 20px; padding-bottom: 10px; padding-top: 10px; position: absolute; bottom: 8px; right: 16px; background-color: rgb(90,90,90); border-style: solid; border-radius: 30px; border-color: rgb(90,90,90);">40TL</h3>
                    </div>
                    <div style=" display: inline-block; float:none; position: relative">
                        <img src="../Assets/images/package.jpeg"/>
                        <h3 style="font-weight: lighter; font-family: Avenir; font-size: 24px; color: white ; padding-left: 20px; padding-right: 20px; padding-bottom: 10px; padding-top: 10px; position: absolute; background-color: rgb(90,90,90); border-style: solid; border-radius: 30px; border-color: rgb(90,90,90); bottom: 8px; left: 16px;">Sub Package #5</h3>
                        <h3 style="font-weight: lighter; font-family: Avenir; font-size: 24px; color: white ; padding-left: 20px; padding-right: 20px; padding-bottom: 10px; padding-top: 10px; position: absolute; bottom: 8px; right: 16px; background-color: rgb(90,90,90); border-style: solid; border-radius: 30px; border-color: rgb(90,90,90);">40TL</h3>
                    </div>
                </div>
            </div>
            <div style="font-family: Avenir; font-size: 32px; margin-top: 30px; margin-bottom: 10px">Games</div>
            <div class="games-display">
                <div style=" overflow-x: scroll; white-space: nowrap;">
                    <?php
                    $games_query = "SELECT * FROM Video_Game;";
                    $games_query_result = mysqli_query($db, $games_query);
                    if (!$games_query_result) {
                        printf("Error: %s\n", mysqli_error($db));
                        exit();
                    }
                    if (mysqli_num_rows($games_query_result) > 0) {
                        while ($games_row = mysqli_fetch_assoc($games_query_result)) {
                            $game_id = $games_row['g_ID'];
                            $game_name = $games_row['g_name'];
                            $game_price = $games_row['g_price'];

                            echo "<a href='videogame.php?game_id=". $game_id ."'>
                                <div style='display: inline-block; float:none; position: relative'>
                                    <img src='../Assets/images/package.jpeg'/>
                                    <h3 style='font-weight: lighter; font-family: Avenir; font-size: 24px; color: white ; padding-left: 20px; padding-right: 20px; padding-bottom: 10px; padding-top: 10px; position: absolute; background-color: rgb(90,90,90); border-style: solid; border-radius: 30px; border-color: rgb(90,90,90); bottom: 8px; left: 16px;'>". $game_name ."</h3>
                                    <h3 style='font-weight: lighter; font-family: Avenir; font-size: 24px; color: white ; padding-left: 20px; padding-right: 20px; padding-bottom: 10px; padding-top: 10px; position: absolute; bottom: 8px; right: 16px; background-color: rgb(90,90,90); border-style: solid; border-radius: 30px; border-color: rgb(90,90,90);'>". $game_price."TL</h3>
                                </div>
                            </a>";
                        }
                    }
                    else {
                        echo "no results";
                    }
                    ?>
                    <div style=" display: inline-block; float:none; position: relative">
                        <img src="../Assets/images/package.jpeg"/>
                        <h3 style="font-weight: lighter; font-family: Avenir; font-size: 24px; color: white ; padding-left: 20px; padding-right: 20px; padding-bottom: 10px; padding-top: 10px; position: absolute; background-color: rgb(90,90,90); border-style: solid; border-radius: 30px; border-color: rgb(90,90,90); bottom: 8px; left: 16px;">Game #1</h3>
                        <h3 style="font-weight: lighter; font-family: Avenir; font-size: 24px; color: white ; padding-left: 20px; padding-right: 20px; padding-bottom: 10px; padding-top: 10px; position: absolute; bottom: 8px; right: 16px; background-color: rgb(90,90,90); border-style: solid; border-radius: 30px; border-color: rgb(90,90,90);">40TL</h3>
                    </div>
                    <div style=" display: inline-block; float:none; position: relative">
                        <img src="../Assets/images/package.jpeg"/>
                        <h3 style="font-weight: lighter; font-family: Avenir; font-size: 24px; color: white ; padding-left: 20px; padding-right: 20px; padding-bottom: 10px; padding-top: 10px; position: absolute; background-color: rgb(90,90,90); border-style: solid; border-radius: 30px; border-color: rgb(90,90,90); bottom: 8px; left: 16px;">Game #2</h3>
                        <h3 style="font-weight: lighter; font-family: Avenir; font-size: 24px; color: white ; padding-left: 20px; padding-right: 20px; padding-bottom: 10px; padding-top: 10px; position: absolute; bottom: 8px; right: 16px; background-color: rgb(90,90,90); border-style: solid; border-radius: 30px; border-color: rgb(90,90,90);">40TL</h3>
                    </div>
                    <div style=" display: inline-block; float:none; position: relative">
                        <img src="../Assets/images/package.jpeg"/>
                        <h3 style="font-weight: lighter; font-family: Avenir; font-size: 24px; color: white ; padding-left: 20px; padding-right: 20px; padding-bottom: 10px; padding-top: 10px; position: absolute; background-color: rgb(90,90,90); border-style: solid; border-radius: 30px; border-color: rgb(90,90,90); bottom: 8px; left: 16px;">Game #3</h3>
                        <h3 style="font-weight: lighter; font-family: Avenir; font-size: 24px; color: white ; padding-left: 20px; padding-right: 20px; padding-bottom: 10px; padding-top: 10px; position: absolute; bottom: 8px; right: 16px; background-color: rgb(90,90,90); border-style: solid; border-radius: 30px; border-color: rgb(90,90,90);">40TL</h3>
                    </div>
                    <div style=" display: inline-block; float:none; position: relative">
                        <img src="../Assets/images/package.jpeg"/>
                        <h3 style="font-weight: lighter; font-family: Avenir; font-size: 24px; color: white ; padding-left: 20px; padding-right: 20px; padding-bottom: 10px; padding-top: 10px; position: absolute; background-color: rgb(90,90,90); border-style: solid; border-radius: 30px; border-color: rgb(90,90,90); bottom: 8px; left: 16px;">Game #4</h3>
                        <h3 style="font-weight: lighter; font-family: Avenir; font-size: 24px; color: white ; padding-left: 20px; padding-right: 20px; padding-bottom: 10px; padding-top: 10px; position: absolute; bottom: 8px; right: 16px; background-color: rgb(90,90,90); border-style: solid; border-radius: 30px; border-color: rgb(90,90,90);">40TL</h3>
                    </div>
                    <div style=" display: inline-block; float:none; position: relative">
                        <img src="../Assets/images/package.jpeg"/>
                        <h3 style="font-weight: lighter; font-family: Avenir; font-size: 24px; color: white ; padding-left: 20px; padding-right: 20px; padding-bottom: 10px; padding-top: 10px; position: absolute; background-color: rgb(90,90,90); border-style: solid; border-radius: 30px; border-color: rgb(90,90,90); bottom: 8px; left: 16px;">Game #5</h3>
                        <h3 style="font-weight: lighter; font-family: Avenir; font-size: 24px; color: white ; padding-left: 20px; padding-right: 20px; padding-bottom: 10px; padding-top: 10px; position: absolute; bottom: 8px; right: 16px; background-color: rgb(90,90,90); border-style: solid; border-radius: 30px; border-color: rgb(90,90,90);">40TL</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="
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


