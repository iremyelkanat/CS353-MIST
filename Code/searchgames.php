<?php
include("config.php");
session_start();

if (isset($_GET['searchVal'])) {
    $search_val = $_GET['searchVal'];

}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="width=device-width, initial-scale=1.0" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MIST - Sign Up</title>
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
                } else {
                    echo "<a href='curatorhome.php' class='nav-item nav-link'>Home</a>";
                }
                ?>
                <a href="store.php" class="nav-item nav-link">Store</a>
                <a href="library.php" class="nav-item nav-link">Library</a>
                <a href="modes.php" class="nav-item nav-link">Modes</a>
                <a href="friends.php" class="nav-item nav-link">Friends</a>
            </div>
            <div class="navbar-nav ml-auto">
                <a class="nav-item nav-link" href="logout.php">Logout</a>
            </div>
        </nav>
        <div class="main-div"
            style="display: flex; padding-left: 2%; padding-right: 2%; padding-top: 2%; padding-bottom: 1%">
            <div class="information-header" style="width: 100%">
                <div style="font-family: Avenir; font-size: 48px ; margin-bottom: 2%">STORE</div>
                <hr style="margin-right: 20%">
                <div class="games-bought-display">
                <div style=" overflow-x: scroll; white-space: nowrap;">
                    <?php
                    $games_bought_query = "SELECT * FROM Published_Games vg WHERE vg.g_name LIKE '%" . $search_val . "%';";

                    $games_bought_result = mysqli_query($db, $games_bought_query);
                    if (!$games_bought_result) {
                        printf("Error: %s\n", mysqli_error($db));
                        exit();
                    }
                    echo "<div class='game-requirement'; style='margin-top: 10px; font-size: 30px; margin-bottom:20px'>
                    <span style=' font-size: 30px'>Search results with key key: </span>  " . $search_val . "
                    </div>";
                    if (mysqli_num_rows($games_bought_result) > 0) {
                        while ($games__bought_row = mysqli_fetch_assoc($games_bought_result)) {
                            $game_id = $games__bought_row['g_ID'];
                            $game_name = $games__bought_row['g_name'];

                            echo "<a href='videogame.php?game_id=". $game_id ."'>
                                <div style='display: inline-block; float:none; position: relative'>
                                    <img src='../Assets/images/package.jpeg'/>
                                    <h3 style='font-weight: lighter; font-family: Avenir; font-size: 24px; color: white ; padding-left: 20px; padding-right: 20px; padding-bottom: 10px; padding-top: 10px; position: absolute; background-color: rgb(90,90,90); border-style: solid; border-radius: 30px; border-color: rgb(90,90,90); bottom: 8px; left: 16px;'>". $game_name ."</h3>
                                </div>
                            </a>";
                        }
                    }
                    else {
                        echo "no results";
                    }
                    ?>
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
        <script type="text/javascript">
            function checkEmptyAndLogin() {
                let fullNameVal = document.getElementById("full-name").value;
                let nickNameVal = document.getElementById("nick-name").value;
                let emailVal = document.getElementById("email").value;
                let passwordVal = document.getElementById("password").value;
                let phoneNumberVal = document.getElementById("phone-number").value;
                if (fullNameVal === "" || passwordVal === "" || nickNameVal === "" || emailVal === "" | phoneNumberVal === "") {
                    alert("Make sure to fill all fields!");
                } else {
                    let form = document.getElementById("login-form").submit();
                }
            }

            function addFriend() {
                let giv_int = document.getElementById("rate_given_text").value;
                if (!giv_int && giv_int > 5) {
                    alert("Make sure to fill all fields!");
                } else if (giv_int > 5) {
                    alert("Rate should not be higher than 5");
                } else {
                    let form = document.getElementById("create-rate-form").submit();
                }
            }
        </script>
</body>

</html>