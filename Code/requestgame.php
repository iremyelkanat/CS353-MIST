<?php
include ("config.php");
session_start();

if (isset($_GET['g_ID'])) {

    $_SESSION['g_ID'] = $_GET['g_ID'];

    /*$get_game_query = "SELECT * FROM Video_Game WHERE g_ID =" . $g_id . ";";

    $get_game_query_result = mysqli_query($db, $get_game_query);
    if (!$get_game_query_result) {
        printf("Error: %s\n", mysqli_error($db));
        exit();
    }

    $game_row = mysqli_fetch_assoc($get_game_query_result);

    $g_name = $game_row['g_name'];*/
}


if($_SERVER["REQUEST_METHOD"] == "POST") {

    $companyId = trim($_POST["companies"]);

    $get_prev_req_query = "SELECT r_ID FROM about a WHERE a.g_ID = ". $_SESSION['g_ID'] .";";
    $get_prev_req_query_result = mysqli_query($db, $get_prev_req_query);

    if (!$get_prev_req_query_result) {
        printf("Error1: %s\n", mysqli_error($db));
        exit();
    }

    $prev_req_row = mysqli_fetch_assoc($get_prev_req_query_result);

    if (mysqli_num_rows($get_prev_req_query_result) > 0) {
        $prev_req = $prev_req_row['r_ID'];

        $delete_prev_req_query = "DELETE FROM Request WHERE r_ID = ". $prev_req .";";
        $delete_prev_req_query_result = mysqli_query($db, $delete_prev_req_query);

        if (!$delete_prev_req_query_result) {
            printf("Error1: %s\n", mysqli_error($db));
            exit();
        }
    }

    $insert_request_query = "INSERT INTO Request() VALUES ();";
    $insert_request_result = mysqli_query($db, $insert_request_query);

    if (!$insert_request_result) {
        printf("Error1: %s\n", mysqli_error($db));
        exit();
    }


    $get_rid_query = "SELECT MAX(r_ID) AS r_ID FROM Request ;";
    $get_rid_result = mysqli_query($db, $get_rid_query);

    if (!$get_rid_result) {
        printf("Error2: %s\n", mysqli_error($db));
        exit();
    }

    $rid_row = mysqli_fetch_assoc($get_rid_result);
    $r_ID = $rid_row['r_ID'];


    $insert_asks_query = "INSERT INTO asks(r_ID, a_ID) VALUES (". $r_ID ." ,". $_SESSION['a_ID'] .");";
    $insert_asks_result = mysqli_query($db, $insert_asks_query);

    if (!$insert_asks_result) {
        printf("Error3: %s\n", mysqli_error($db));
        exit();
    }


    $insert_takes_query = "INSERT INTO takes VALUES (". $r_ID ." ,". $companyId .", '');";
    $insert_takes_result = mysqli_query($db, $insert_takes_query);

    if (!$insert_takes_result) {
        printf("Error4: %s\n", mysqli_error($db));
        exit();
    }

    global $g_ID_to_req;

    $insert_about_query = "INSERT INTO about VALUES (". $r_ID .", ". $_SESSION['g_ID'] .");";
    $insert_about_result = mysqli_query($db, $insert_about_query);

    if (!$insert_about_result) {
        printf("Error5: %s\n", mysqli_error($db));
        exit();
    }

    echo "<script LANGUAGE='JavaScript'>
                    window.alert('Your request has been sent successfully! Redirecing...');
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
<body style="font-family: Avenir !important;">
<div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" style="font-weight: bold; font-size: xx-large; font-family: Avenir">MIST</a>
        <div class="navbar-nav">
            <a href="developerhome.php" class="nav-item nav-link">Home</a>
            <a class="nav-item nav-link active">Games</a>
        </div>
        <div  class="navbar-nav ml-auto">
            <a class="nav-item nav-link" href="logout.php">Logout</a>
        </div>
    </nav>
<div class="main-div" style="padding-top: 200px">
    <div style="margin: auto; background-color: white; height: 350px; width: 600px; border-radius: 30px; border-color: rgba(112,112,112,1); border-style: solid; padding: 20px">
        <div style="text-align: center; font-size: 32px; margin-top: 10px; margin-bottom: 20px">
            Send Request
        </div>
        <?php
        $get_game_query = "SELECT * FROM Video_Game WHERE g_ID =" . $_GET['g_ID'] . ";";

        $get_game_query_result = mysqli_query($db, $get_game_query);
        if (!$get_game_query_result) {
            printf("Error: %s\n", mysqli_error($db));
            exit();
        }

        $game_row = mysqli_fetch_assoc($get_game_query_result);

        $g_name = $game_row['g_name'];
        echo "<div style='font-size: 20px'>   
                       For the game: <span style='font-weight: bold'> ". $g_name ."</span>
                    </div>";
        ?>
        <br>
        <div style="align-items: center;">
            <form id="request-game-form" method="post" action="requestgame.php">
                <label for="companies" style="width: 100%; font-size: 25px;">Choose a Publisher Company:</label>
                <div style="border-style: solid; border-radius: 10px; border-color: slategrey; border-width: 1px; padding: 3px;">
                    <select name="companies" id="companies" style="width: 100%; font-size: 20px; outline: none;">
                        <option value="default" selected disabled>Select a Publisher Company</option>
                        <?php
                        $companies_query = "SELECT c.a_ID, c.c_name FROM Company c, Publisher_Company pc WHERE c.a_ID = pc.a_ID;";
                        $companies_query_result = mysqli_query($db, $companies_query);
                        if (!$companies_query_result) {
                            printf("Error: %s\n", mysqli_error($db));
                            exit();
                        }

                        if (mysqli_num_rows($companies_query_result) > 0) {
                            while ($companies_row = mysqli_fetch_assoc($companies_query_result)) {

                                $c_id = $companies_row['a_ID'];
                                $c_name = $companies_row['c_name'];

                                echo "<option value=". $c_id .">". $c_name ."</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group" style="margin-top: 5%; text-align: right">
                    <input onclick="checkEmptyAndSendRequest()" type="button" class="btn btn-primary btn-lg" style="background-color: rgb(86, 188, 22); border-color: rgb(86, 188, 22); border-radius: 20px" value="  Send  ">
                </div>
                <br><br>
            </form>
        </div>
    </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<script type="text/javascript">
    function checkEmptyAndSendRequest() {
        // alert("lele");
        let companyIdVal = document.getElementById("companies").value;
        // alert(companyIdVal);

        if (companyIdVal === "" || companyIdVal === "default") {
            alert("Make sure to fill all fields!");
        }
        else {
            let form = document.getElementById("request-game-form").submit();
        }
    }
</script>
</body>
</html>

