<?php
    include("config.php");
    session_start();

    #//TODO: GAMESTE NASIL YAPTIYSA ÖYLE YAP

    if(empty($_SESSION['a_ID']) || $_SESSION['type'] !== "pub"){
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
            <a href="publisherhome.php" class="nav-item nav-link">Home</a>
            <a href="approvals.php" class="nav-item nav-link">Approvals</a>
            <a class="nav-item nav-link active">Requests</a>
        </div>
        <div  class="navbar-nav ml-auto">
            <a class="nav-item nav-link" href="logout.php">Logout</a>
        </div>
    </nav>
    <div style="font-family: Avenir; font-size: 48px; margin-bottom: 2%; margin-left: 2%; margin-top: 2%;">Requests</div>
    <hr>
    <div class="request-div" style="height: 400px">
        <?php
            $query = "SELECT vg.g_name, vg.g_description, vg.g_image, req.r_ID
                                                FROM about a, takes t, Video_Game vg, Request req
                                                WHERE (t.state <> 'Approved' AND t.state <> 'Declined') AND vg.g_ID=a.g_ID
                                                             AND a.r_ID = req.r_ID AND t.r_ID = req.r_ID
                                                            AND t.a_ID=". $_SESSION['a_ID'] .";";

            $game_data = mysqli_query($db, $query);

            if (!$game_data) {
                printf("Error: %s\n", mysqli_error($db));
                exit();
            }
            if (mysqli_num_rows($game_data) > 0) {
                while ($games_row = mysqli_fetch_assoc($game_data)) {
                    $game_name = $games_row['g_name'];
                    $game_desc = $games_row['g_description'];
                    $game_image = $games_row['g_image'];
                    $req_ID = $games_row['r_ID'];

                    echo "<div style='display: flex;'>
                            <div class='game-image' style='
                                width: 420px; 
                                height: 250px;
                                float: right;
                                display: table;
                                overflow: hidden;
                                text-align: center;
                                font-size: 30px;
                                margin-top: 10px;
                                margin-bottom: 10px;
                                border-style: solid;
                                border-color: rgba(112,112,112,1);
                                border-width: 2px;
                                margin-right: 100px;
                                margin-left: 100px;
                                position: relative; 
                                border-radius: 20px;'>
                                <div style='display: table-cell; vertical-align: middle'> 
                                <img style=' max-height: 100%; max-width: 100%;' src='../Assets/images/game.jpg' alt=''> 
                            </div>
                        </div>
                        <div class='game-description' style='display: table; overflow: hidden; width: 50%; height: 100%;'>
                            <div style='display: table-cell; vertical-align: middle; padding-left: 50px;'>
                                <div>
                                    <span style='font-weight: bold'>Name: </span>
                                    <span>" . $game_name . "</span>
                                </div>
                                <div>
                                    <span style='font-weight: bold'>Description: </span>
                                    <span>" . $game_desc . "</span>
                                </div>
                                <br>
                                <div class='buttons' style='display: flex'>
                                <div>
                                    <a href='answerrequest.php?r_ID=". $req_ID ."&state=Approved'>
                                            <button type='button' class='btn btn-primary' class='btn btn-primary btn-lg' style='margin-right: 25px; font-family: Avenir; width: 100px; background-color: rgba(93, 239, 132, 100); border-color: #ffffff; border-radius: 20px'>
                                                Approve
                                            </button>
                                    </a>
                                </div>
                                <div>
                                    <a href='answerrequest.php?r_ID=". $req_ID ."&state=Declined'>
                                        <button type='button' class='btn btn-primary' class='btn btn-primary btn-lg' style='margin-right: 25px; font-family: Avenir; width: 100px; background-color: rgba(234, 124, 137, 100); border-color: #ffffff; border-radius: 20px; margin-right:10px;'>Decline</button>
                                    </a>
                                </div>
                                </div>
                            </div>
                        </div>";
                }
            }
            else {
                echo "No recent requests found...";
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


