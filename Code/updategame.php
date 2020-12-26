<?php
include ("config.php");
session_start();

if (isset($_GET['g_ID'])) {

    $_SESSION['g_ID'] = $_GET['g_ID'];
}

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $gameVersion = trim($_POST["game-version"]);
    $gameDescription = trim($_POST["game-description"]);

    $set_version_query = "UPDATE Video_Game SET g_version = ".$gameVersion." WHERE g_ID = ".$_SESSION['g_ID'].";";
    $set_version_result = mysqli_query($db, $set_version_query);

    if (!$set_version_result) {
        printf("Error1: %s\n", mysqli_error($db));
        exit();
    }

    $update_game_query = "INSERT INTO updates VALUES (".$_SESSION['a_ID'].", ".$_SESSION['g_ID']." , now(), '$gameVersion', '$gameDescription');";
    $update_game_result = mysqli_query($db, $update_game_query);

    if (!$update_game_result) {
        printf("Error2: %s\n", mysqli_error($db));
        exit();
    }

    echo "<script LANGUAGE='JavaScript'>
                    window.alert('Your game has been updated successfully! Redirecing...');
                    window.location.href = 'games.php';
                </script>";
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
<body style="font-family: Avenir">
<div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a href="index.php" class="navbar-brand" style="font-weight: bold; font-size: xx-large; font-family: Avenir">MIST</a>
        <div  class="navbar-nav ml-auto">
            <a class="nav-item nav-link" href="index.php">Return To Home Page</a>
        </div>
    </nav>
    <div style="margin: auto; margin-top: 200px; background-color: white; height: 400px; width: 600px; border-radius: 30px; border-color: rgba(112,112,112,1); border-style: solid;">
        <div style="text-align: center; font-size: 32px; margin-top: 10px;">
            Update Game
        </div>
        <br>
        <?php
        $get_game_query = "SELECT * FROM Video_Game WHERE g_ID =" . $_GET['g_ID'] . ";";

        $get_game_query_result = mysqli_query($db, $get_game_query);
        if (!$get_game_query_result) {
            printf("Error: %s\n", mysqli_error($db));
            exit();
        }

        $game_row = mysqli_fetch_assoc($get_game_query_result);

        $g_name = $game_row['g_name'];
        echo "<div style='font-size: 20px; padding-right: 5%; padding-left: 5%'>   
                       For the game: <span style='font-weight: bold'> ". $g_name ."</span>
                    </div>";
        ?>
        <br>
        <div style="align-items: center; text-align: center;">
            <form id="update-game-form" method="post">
                <div class="input-group" style="margin-bottom: 2%; padding-right: 5%; padding-left: 5%;">
                    <input id="game-version" type="text" class="form-control" name="game-version" placeholder="New Game Version" style="border-radius: 20px">
                </div>
                <div class="input-group" style=" margin-bottom: 2%; padding-right: 5%; padding-left: 5%; margin-top: 4%">
                    <textarea id="game-description" rows="4" maxlength="280" class="form-control" name="game-description" placeholder="Description" style="resize: none; display: block; border-radius: 20px"></textarea>
                </div>
                <div class="form-group" style="margin-top: 5%;">
                    <input onclick="checkEmptyAndUpdate()" type="button btn-lg" class="btn btn-primary btn-md" style=" background-color: rgb(86, 188, 22); border-color: rgb(86, 188, 22); border-radius: 20px" value="  Update ">
                </div>
            </form>
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
    function checkEmptyAndUpdate() {
        let gameVersionVal = document.getElementById("game-version").value;
        let gameDescriptionVal = document.getElementById("game-description").value;
        if (gameVersionVal === "" || gameDescriptionVal === "") {
            alert("Make sure to fill all fields!");
        }
        else {
            let form = document.getElementById("update-game-form").submit();
        }
    }
</script>
</body>
</html>


