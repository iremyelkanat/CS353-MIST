<?php
include("config.php");
session_start();

if(empty($_SESSION['a_ID']) || $_SESSION['type'] !== "dev"){
    header("location: index.php");
    die("Redirecting to login.php");
}

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $gameName = trim($_POST["game-name"]);
    $gameVersion = trim($_POST["game-version-create"]);
    $gameGenre = trim($_POST["genres"]);
    $gameDescription = trim($_POST["game-description-create"]);
    $gameRequirements= trim($_POST["game-requirements"]);


    $create_game_query = "INSERT INTO Video_Game(g_name, g_version, g_description, g_image, genre, g_requirements) VALUES ('$gameName', '$gameVersion', '$gameDescription', '', '$gameGenre', '$gameRequirements');";
    $create_game_result = mysqli_query($db, $create_game_query);

    if (!$create_game_result) {
        printf("Error: %s\n", mysqli_error($db));
        exit();
    }


    $get_gameid_query = "SELECT g_ID FROM Video_Game vg WHERE vg.g_name = '$gameName';";
    $get_gameid_query_result = mysqli_query($db, $get_gameid_query);

    if (!$get_gameid_query_result) {
        printf("Error: %s\n", mysqli_error($db));
        exit();
    }

    $row = mysqli_fetch_assoc($get_gameid_query_result);
    $g_ID = $row['g_ID'];


    $get_gameid_query = "INSERT INTO develops VALUES (" . $_SESSION['a_ID'] . ", " . $g_ID . ");";
    $get_gameid_query_result = mysqli_query($db, $get_gameid_query);

    if (!$get_gameid_query_result) {
        printf("Error: %s\n", mysqli_error($db));
        exit();
    }

    echo "<script LANGUAGE='JavaScript'>
                window.alert('Your game has been created successfully! Redirecing...');
                window.location.href = 'developerhome.php';
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
    <div class="main-div" style="padding-left: 2%; padding-right: 2%; padding-top: 2%; padding-bottom: 1%">
        <div class="information-header" style="width: 100%">
            <div style="font-family: Avenir; font-size: 48px;  margin-bottom: 2%">Games</div>
            <hr>
        </div>
        <div class="games-body" style="margin-right: 30%; ">
            <div class="create-game-row" style="display: flex; height: 300px">
                <div class="create-game-image" onclick="checkEmptyAndLogin()" style="width: 50%; height: 100%;
                    display: table;
                    overflow: hidden;
                    text-align: center;
                    font-size: 30px;
                     margin-bottom: 10px;
                     border-style: solid;
                     border-color: rgba(112,112,112,1);
                     border-width: 2px;
                     margin-right: 100px;
                     margin-left: 100px;
                     border-radius: 20px;">
                    <div style="display: table-cell; vertical-align: middle">
                        <button type="button" class="btn btn-primary" class='btn btn-primary btn-lg' style='font-family: Avenir; width: 100%; height: 100%; background-color: transparent; border-color: transparent; border-radius: 20px'; data-toggle="modal" data-target="#exampleModalCenter3">
                            <div style="font-size: 80px; color: rgba(112,112,112,1)">
                                +
                            </div>
                        </button>
                    </div>
                </div>
                <div class="create-game-description" style="display: table; overflow: hidden; width: 50%; height: 100%;">
                    <div style="display: table-cell; vertical-align: middle; padding-left: 50px;">
                        <span style="font-weight: bold">Description: </span>
                        <span>Create a new game.</span>
                    </div>
                </div>
            </div>
            <div style="margin: 50px"></div>
            <div></div>
            <!-- Published Games -->
            <div class="published-games">
                <?php
                $get_developed_games_query = "SELECT vg.g_name, vg.g_description, vg.g_image, COUNT(i.a_ID), AVG(r.value)
                                                FROM develops d, about a, takes t, Video_Game vg, install i, rates r, asks ask,
                                                         Request req
                                                WHERE t.state = 'Approved' AND vg.g_ID=a.g_ID AND a.r_ID = req.r_ID AND  
                                                            t.r_ID = req.r_ID AND ask.r_ID = t.r_ID AND ask.a_ID=d.a_ID AND
                                                           d.a_ID=". $_SESSION['a_ID'] ." AND d.g_ID = vg.g_ID AND i.g_ID = d.g_ID 
                                                           AND r.g_ID = d.g_ID
                                                GROUP BY r.g_ID;";
                $get_developed_games_query_result = mysqli_query($db, $get_developed_games_query);

                if (!$get_developed_games_query_result) {
                    printf("Error: %s\n", mysqli_error($db));
                    exit();
                }
                //printf("lele" +$get_developed_games_query_result);
                if (mysqli_num_rows($get_developed_games_query_result) > 0) {
                    while ($developed_games_row = mysqli_fetch_assoc($get_developed_games_query_result)) {
                        $g_ID = $developed_games_row['g_ID'];
                        $g_name = $developed_games_row['g_name'];
                        $g_description = $developed_games_row['g_description'];

                        echo "<div class='games-row2' style='display: flex; height: 300px; margin-top: 25px'>
                <div class='game-image' style='width: 50%; height: 100%;
                    display: table;
                    overflow: hidden;
                    text-align: center;
                    font-size: 30px;
                     margin-bottom: 10px;
                     border-style: solid;
                     border-color: rgba(112,112,112,1);
                     border-width: 2px;
                     margin-right: 100px;
                     margin-left: 100px;
                     border-radius: 20px;'>
                    <div style='display: table-cell; vertical-align: middle'> + </div>
                </div>
                <div class='game-description' style='display: table; overflow: hidden; width: 50%; height: 100%;'>
                    <div style='display: table-cell; vertical-align: middle; padding-left: 50px;'>
                        <div>
                            <span style='font-weight: bold'>Name: </span>
                            <span>". $g_name ."</span>
                        </div>
                        <div>
                            <span style='font-weight: bold'>Description: </span>
                            <span>". $g_description ."</span>
                        </div>
                        <div>
                            <span style='font-weight: bold'>Downloaded: </span>
                            <span>-</span>
                        </div>
                        <br>
                        <div>
                            <a href='updategame.php'>
                            <button type='button' disabled class='btn btn-primary' class='btn btn-primary btn-lg' style='font-family: Avenir; width: 50%; background-color: rgb(86, 188, 22); border-color: rgb(86, 188, 22); border-radius: 20px'>
                                Update
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>";


                    }

                }
                else {
                    echo "no results for published";
                }
                ?>
            </div>
            <!-- Developed and pending -->
            <div class="pending-games">
                <?php
                $get_developed_games_query = "SELECT vg.g_name, vg.g_description, vg.g_image
                                                FROM develops d, about a, takes t, Video_Game vg, asks ask, Request req
                                                WHERE (t.state <> 'Approved' AND t.state <> 'Declined') AND vg.g_ID=a.g_ID
                                                             AND a.r_ID = req.r_ID AND t.r_ID = req.r_ID AND ask.r_ID = t.r_ID
                                                             AND ask.a_ID=d.a_ID AND d.a_ID=". $_SESSION['a_ID'] ." AND d.g_ID = vg.g_ID;";
                $get_developed_games_query_result = mysqli_query($db, $get_developed_games_query);

                if (!$get_developed_games_query_result) {
                    printf("Error: %s\n", mysqli_error($db));
                    exit();
                }
                //printf("lele" +$get_developed_games_query_result);
                if (mysqli_num_rows($get_developed_games_query_result) > 0) {
                    while ($developed_games_row = mysqli_fetch_assoc($get_developed_games_query_result)) {
                        $g_ID = $developed_games_row['g_ID'];
                        $g_name = $developed_games_row['g_name'];
                        $g_description = $developed_games_row['g_description'];

                        echo "<div class='games-row2' style='display: flex; height: 300px; margin-top: 25px'>
                <div class='game-image' style='width: 50%; height: 100%;
                    display: table;
                    overflow: hidden;
                    text-align: center;
                    font-size: 30px;
                     margin-bottom: 10px;
                     border-style: solid;
                     border-color: rgba(112,112,112,1);
                     border-width: 2px;
                     margin-right: 100px;
                     margin-left: 100px;
                     border-radius: 20px;'>
                    <div style='display: table-cell; vertical-align: middle'> + </div>
                </div>
                <div class='game-description' style='display: table; overflow: hidden; width: 50%; height: 100%;'>
                    <div style='display: table-cell; vertical-align: middle; padding-left: 50px;'>
                        <div>
                            <span style='font-weight: bold'>Name: </span>
                            <span>". $g_name ."</span>
                        </div>
                        <div>
                            <span style='font-weight: bold'>Description: </span>
                            <span>". $g_description ."</span>
                        </div>
                        <div>
                            <span style='font-weight: bold'>Downloaded: </span>
                            <span>-</span>
                        </div>
                        <br>
                        <div>
                            <button type='button' disabled class='btn btn-primary' class='btn btn-primary btn-lg' style='font-family: Avenir; width: 50%; background-color: rgb(126, 166, 234); border-color: rgb(126, 166, 234); border-radius: 20px' data-toggle='modal' data-target='#exampleModalCenter3'>
                                Pending
                                </button>
                        </div>
                    </div>
                </div>
            </div>";


                    }

                }
                else {
                    echo "no results";
                }
                ?>
            </div>
            <!-- Developed and not requested -->
            <div class="not-requested">
                <?php
                $get_developed_games_query = "SELECT vg.g_name, vg.g_description, vg.g_image, vg.g_ID
                                            FROM develops d, Video_Game vg
                                            WHERE d.g_ID = vg.g_ID AND d.a_ID = ". $_SESSION['a_ID'] ." AND vg.g_ID NOT IN (SELECT ab.g_ID FROM asks a, Request r, about ab WHERE a.r_ID = r.r_ID AND r.r_ID = ab.r_ID);";
                $get_developed_games_query_result = mysqli_query($db, $get_developed_games_query);

                if (!$get_developed_games_query_result) {
                    printf("Error: %s\n", mysqli_error($db));
                    exit();
                }
                //printf("lele" +$get_developed_games_query_result);
                if (mysqli_num_rows($get_developed_games_query_result) > 0) {
                    while ($developed_games_row = mysqli_fetch_assoc($get_developed_games_query_result)) {
                        $g_ID = $developed_games_row['g_ID'];
                        $g_name = $developed_games_row['g_name'];
                        $g_description = $developed_games_row['g_description'];

                        echo "<div class='games-row2' style='display: flex; height: 300px; margin-top: 25px'>
                <div class='game-image' style='width: 50%; height: 100%;
                    display: table;
                    overflow: hidden;
                    text-align: center;
                    font-size: 30px;
                     margin-bottom: 10px;
                     border-style: solid;
                     border-color: rgba(112,112,112,1);
                     border-width: 2px;
                     margin-right: 100px;
                     margin-left: 100px;
                     border-radius: 20px;'>
                    <div style='display: table-cell; vertical-align: middle'> + </div>
                </div>
                <div class='game-description' style='display: table; overflow: hidden; width: 50%; height: 100%;'>
                    <div style='display: table-cell; vertical-align: middle; padding-left: 50px;'>
                        <div>
                            <span style='font-weight: bold'>Name: </span>
                            <span>". $g_name ."</span>
                        </div>
                        <div>
                            <span style='font-weight: bold'>Description: </span>
                            <span>". $g_description ."</span>
                        </div>
                        <div>
                            <span style='font-weight: bold'>Downloaded: </span>
                            <span>-</span>
                        </div>
                        <br>
                        <div>
                        <input id='request-game-id' class='request-game-id' type='hidden' value='". $g_ID. "'>
                            <a href='requestgame.php?g_ID=".$g_ID ."'>
                                <button type='button' class='btn btn-primary' class='btn btn-primary btn-lg' style='font-family: Avenir; width: 50%; background-color: rgb(126, 166, 234); border-color: rgb(126, 166, 234); border-radius: 20px'>
                                    Request
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>";


                    }

                }
                else {
                    echo "no results";
                }
                ?>
            </div>
            <!-- Declined Games -->
            <div class="declined-games">
                <?php
                    $get_declined_games_query = "SELECT vg.g_name, vg.g_description, vg.g_image
                                         FROM develops d, about a, takes t, Video_Game vg, asks ask, Request req
                                         WHERE (t.state = 'Declined') AND vg.g_ID=a.g_ID
                                         AND a.r_ID = req.r_ID AND t.r_ID = req.r_ID AND ask.r_ID = t.r_ID
                                         AND ask.a_ID=d.a_ID AND d.a_ID=". $_SESSION['a_ID'] ." AND d.g_ID = vg.g_ID;";
                $get_declined_games_query_result = mysqli_query($db, $get_declined_games_query);

                    if (!$get_declined_games_query_result) {
                        printf("Error: %s\n", mysqli_error($db));
                        exit();
                    }
                if (mysqli_num_rows($get_declined_games_query_result) > 0) {
                    while ($declined_games_row = mysqli_fetch_assoc($get_declined_games_query_result)) {
                        $g_name = $declined_games_row['g_name'];
                        $g_description = $declined_games_row['g_description'];

                        echo "<div class='games-row2' style='display: flex; height: 300px; margin-top: 25px'>
                <div class='game-image' style='width: 50%; height: 100%;
                    display: table;
                    overflow: hidden;
                    text-align: center;
                    font-size: 30px;
                     margin-bottom: 10px;
                     border-style: solid;
                     border-color: rgba(112,112,112,1);
                     border-width: 2px;
                     margin-right: 100px;
                     margin-left: 100px;
                     border-radius: 20px;'>
                    <div style='display: table-cell; vertical-align: middle'> + </div>
                </div>
                <div class='game-description' style='display: table; overflow: hidden; width: 50%; height: 100%;'>
                    <div style='display: table-cell; vertical-align: middle; padding-left: 50px;'>
                        <div>
                            <span style='font-weight: bold'>Name: </span>
                            <span>". $g_name ."</span>
                        </div>
                        <div>
                            <span style='font-weight: bold'>Description: </span>
                            <span>". $g_description ."</span>
                        </div>
                        <div>
                            <span style='font-weight: bold'>Downloaded: </span>
                            <span>-</span>
                        </div>
                        <br>
                        <div>
                            <button type='button' class='btn btn-primary' class='btn btn-primary btn-lg' style='font-family: Avenir; width: 50%; background-color: rgb(234, 124, 137);; border-color: rgb(234, 124, 137);; border-radius: 20px' data-toggle='modal' data-target='#exampleModalCenter2'>
                                Declined
                                </button>
                        </div>
                    </div>
                </div>
            </div>";
                    }

                }
                else {
                    echo "no results for declined";
                }
                ?>
            </div>
            <div class="games-row" style="display: flex; height: 300px">
                <div class="game-image" style="width: 50%; height: 100%;
                    display: table;
                    overflow: hidden;
                    text-align: center;
                    font-size: 30px;
                     margin-bottom: 10px;
                     border-style: solid;
                     border-color: rgba(112,112,112,1);
                     border-width: 2px;
                     margin-right: 100px;
                     margin-left: 100px;
                     border-radius: 20px;">
                    <div style="display: table-cell; vertical-align: middle"> + </div>
                </div>
                <div class="game-description" style="display: table; overflow: hidden; width: 50%; height: 100%;">
                    <div style="display: table-cell; vertical-align: middle; padding-left: 50px;">
                        <div>
                            <span style="font-weight: bold">Name: </span>
                            <span>Whoever Us</span>
                        </div>
                        <div>
                            <span style="font-weight: bold">Description: </span>
                            <span> HERE IS LONG DESC HERE IS LONG DESCHERE IS LONG DESCHERE IS LONG DESCHERE IS LONG DESCHERE IS LONG DESCHERE IS LONG DESCHERE IS LONG DESCHERE IS LONG DESCHERE IS LONG DESCHERE IS LONG DESCHERE IS LONG DESC </span>
                        </div>
                        <div>
                            <span style="font-weight: bold">Downloaded: </span>
                            <span>25K</span>
                        </div>
                        <div>
                            <span style="font-weight: bold">Rate: </span>
                            <span>3 / 5</span>
                        </div>
                        <br>
                        <div>
                            <button type="button" class="btn btn-primary" class='btn btn-primary btn-lg' style='font-family: Avenir; width: 50%; background-color: rgb(234, 124, 137); border-color: rgb(234, 124, 137); border-radius: 20px' data-toggle="modal" data-target="#exampleModalCenter3">
                                Update
                            </button>
                        </div>
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

    <!-- Update Game -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered" role="main" style="height: 400px; width: 800px;">
            <div class="modal-content" style="height: 400px; width: 800px; background-color: transparent; border: none">
                <div class="modal-body" style="background-color: transparent">
                    <div style="background-color: white; height: 350px; width: 600px; border-radius: 30px; border-color: rgba(112,112,112,1); border-style: solid;">
                        <div style="text-align: center; font-size: 32px; margin-top: 10px;">
                            Update Game
                        </div>
                        <div style="align-items: center; text-align: center;">
                            <form id="update-game-form" method="post">
                                <div class="input-group" style="margin-bottom: 2%; padding-right: 5%; padding-left: 5%; margin-top: 4%">
                                    <input id="game-version" type="text" class="form-control" name="game-version" placeholder="New Game Version">
                                </div>
                                <div class="input-group" style=" margin-bottom: 2%; padding-right: 5%; padding-left: 5%; margin-top: 4%">
                                    <textarea id="game-description" rows="4" maxlength="280" class="form-control" name="game-description" placeholder="Description" style="resize: none; display: block"></textarea>
                                </div>
                                <div class="form-group" style="margin-top: 5%;">
                                    <input onclick="checkEmptyAndLogin()" type="button" class="btn btn-primary btn-md" style="background-color: rgb(86, 188, 22); border-color: rgb(86, 188, 22); border-radius: 20px" value="  Update ">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Send Request -->
    <div class="modal fade" id="request-game" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="main" style="height: 300px; width: 800px;">
            <div class="modal-content" style="height: 300px; width: 800px; background-color: transparent; border: none; padding: 20px">
                <div class="modal-body" style="background-color: transparent; padding: 20px">
                    <?php echo $developed_games_row['g_ID'];?>
                    <div style="background-color: white; height: 300px; width: 600px; border-radius: 30px; border-color: rgba(112,112,112,1); border-style: solid; padding: 20px">
                        <div style="text-align: center; font-size: 32px; margin-top: 10px; margin-bottom: 20px">
                            Send Request
                        </div>
                        <div style="align-items: center;">
                            <form id="request-game-form" method="post" action="requestgame.php">
                                <label for="companies" style="width: 100%; font-size: 25px;">Choose a Publisher Company:</label>
                                <div style="border-style: solid; border-radius: 10px; border-color: slategrey; border-width: 1px; padding: 3px;">
                                    <select name="companies" id="companies" style="width: 100%; font-size: 20px; outline: none;">
                                        <?php
                                        $companies_query = "SELECT c.a_ID, c.c_name FROM Company c, Publisher_Company pc WHERE c.a_ID = pc.a_ID;";
                                        $companies_query_result = mysqli_query($db, $companies_query);
                                        if (!$companies_query_result) {
                                            printf("Error: %s\n", mysqli_error($db));
                                            exit();
                                        }
                                        printf(mysqli_num_rows($companies_query_result));
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
        </div>
    </div>

    <!-- Create Game Modal -->
    <div class="modal fade" id="exampleModalCenter3" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered" role="main" style="height: 400px; width: 800px;">
            <div class="modal-content" style="height: 650px; width: 800px; background-color: transparent; border: none; padding: 20px">
                <div class="modal-body" style="background-color: transparent; padding: 20px">
                    <div style="background-color: white; height: 650px; width: 600px; border-radius: 30px; border-color: rgba(112,112,112,1); border-style: solid; padding: 40px">
                        <div style="text-align: center; font-size: 32px; margin-top: 10px; margin-bottom: 20px">
                            Create Game
                        </div>
                        <div style="align-items: center;">
                            <form id="create-game-form" method="post">
                                <div style="display: flex; font-size: 20px;">
                                    <div class="input-group" style="margin-bottom: 2%; margin-top: 4%; font-size: 20px;">
                                        <input id="game-name" type="text" class="form-control" name="game-name" placeholder="Game Name" style=" outline: none; font-size: 20px; border-style: solid; border-radius: 20px">
                                    </div>
                                    <div style="padding: 20px"></div>
                                    <div class="input-group" style=" margin-bottom: 2%; margin-top: 4%; font-size: 20px; font-size: 20px;" >
                                        <input id="game-version-create" type="text" class="form-control" name="game-version-create" placeholder="Game Version" style=" outline: none; font-size: 20px; border-style: solid; border-radius: 20px">
                                    </div>
                                </div>
                                <div class="input-group" style="margin-top: 10px; margin-bottom: 20px; border-style: solid; border-radius: 20px; border-color: slategrey; border-width: 1px; padding: 5px;">
                                    <select name="genres" id="genres" style="width: 100%; font-size: 20px; outline: none;" >
                                        <option value="Genre" selected disabled>Select a Genre</option>
                                        <option value="Horror">Horror</option>
                                        <option value="Action">Action</option>
                                        <option value="Adventure">Adventure</option>
                                        <option value="RPG">RPG</option>
                                    </select>
                                </div>
                                <div class="input-group" style=" margin-bottom: 10px; margin-top: 20px">
                                    <textarea id="game-description-create" rows="4" maxlength="280" class="form-control" name="game-description-create" placeholder="Game Description" style=" outline: none; resize: none; display: block; font-size: 20px; border-style: solid; border-radius: 20px"></textarea>
                                </div>
                                <div class="input-group" style=" margin-bottom: 10px; margin-top: 20px">
                                    <textarea id="game-requirements" rows="4" maxlength="280" class="form-control" name="game-requirements" placeholder="Game Requirements" style=" outline: none; resize: none; display: block; font-size: 20px; border-style: solid; border-radius: 20px"></textarea>
                                </div>
                                <div class="form-group" style="margin-top: 5%; text-align: right">
                                    <input onclick="checkEmptyAndCreate()" type="button" class="btn btn-primary btn-lg" style="background-color: rgb(86, 188, 22); border-color: rgb(86, 188, 22); border-radius: 20px" value="  Create  ">
                                </div>
                                <br><br>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<script type="text/javascript">
    $('.trash').click(function(){
        //get cover id
        var id=$(this).data('id');
        //set href for cancel button
        $('#modallCancel').attr('href','delete-cover.php?id='+id);
    })
</script>
<script type="text/javascript">
    function checkEmptyAndCreate() {
        let gameNameVal = document.getElementById("game-name").value;
        let gameVersionVal = document.getElementById("game-version-create").value;
        let genreVal = document.getElementById("genres").value;
        let gameDescriptionVal = document.getElementById("game-description-create").value;
        let gameRequirementsVal = document.getElementById("game-requirements").value;


        /*alert("name" + gameNameVal);
        alert("ver" + gameVersionVal);
        alert("genre" + genreVal);
        alert("desc" + gameDescriptionVal);
        alert("req" + gameRequirementsVal); */

        if (gameNameVal === "" || gameVersionVal === "" || gameDescriptionVal === "" || gameRequirementsVal === "" || genreVal === "") {
            alert("Make sure to fill all fields!");
        }
        else {
            let form = document.getElementById("create-game-form").submit();
        }
    }
</script>
<script type="text/javascript">
    function checkEmptyAndSendRequest() {
        let gameIDVal = document.getElementById("request-game-id").value;

    }
</script>
</body>
</html>




