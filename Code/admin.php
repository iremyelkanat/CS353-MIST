<?php
    include("config.php");
    session_start();
    if($_SERVER["REQUEST_METHOD"] == "POST") {

        $subsName = trim($_POST["subs-name"]);
        $subsPrice = trim($_POST["subs-price"]);
        $date = trim($_POST["date"]);

        $create_subs_query = "INSERT INTO Subscription_Package(package_name, price, duration) VALUES ('" . $subsName . "', " . $subsPrice . ", " . $date .");";

        $result = mysqli_query($db, $create_subs_query);

        if (!$result) {
            printf("Error: %s\n", mysqli_error($db));
            exit();
        }

        $get_id_query = "SELECT MAX(package_ID) as maxID FROM Subscription_Package;";
        $get_id_result = mysqli_query($db, $get_id_query);
        if (!$get_id_result) {
            printf("Error: %s\n", mysqli_error($db));
            exit();
        }

        $row = mysqli_fetch_assoc($get_id_result);
        $s_ID = $row['maxID'];

        $games = $_POST['games'];

        foreach($games as $game){
            $add_game_query = "INSERT INTO contains VALUES(" . $s_ID . ", " . $game . ")";
            $add_game_check_result = mysqli_query($db, $add_game_query);
            if (!$get_id_result) {
                printf("Error: %s\n", mysqli_error($db));
                exit();
            }
        }
        echo "<script type='text/javascript'>alert('Subscription package successfully added!');</script>";
    }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="width=device-width, initial-scale=1.0"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MIST - Publisher</title>
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
            <a class="nav-item nav-link active">Admin</a>
        </div>
        <div  class="navbar-nav ml-auto">
            <a class="nav-item nav-link" href="index.php">Return</a>
        </div>
    </nav>
    <div style="font-family: Avenir; font-size: 48px; margin-bottom: 2%; margin-left: 2%; margin-top: 2%;">Add Subscription Package</div>
    <hr>
    <div class="main-div" style="width: 70%; margin: auto;">
        <div class="create-subs">
            <form id="create-subs-form" method="post">
                <div class="input-group">
                    <input id="subs-name" type="text" class="form-control" name="subs-name" placeholder="Name of the Package" style=" outline: none; font-size: 20px; border-style: solid; border-radius: 20px">
                </div>
                <div class="input-group" style="margin-top: 20px">
                    <input id="subs-price" type="number" class="form-control" name="subs-price" placeholder="Price of the Package" style=" outline: none; font-size: 20px; border-style: solid; border-radius: 20px">
                </div>
                <div class="input-group" style="margin-top: 20px;">
                    <input id="date" type="date" class="form-control" name="date" placeholder="Expiration Date" style=" outline: none; font-size: 20px; border-style: solid; border-radius: 20px">
                </div>
                <?php
                     $games_query = "SELECT g_name, g_ID, g_price FROM Published_Games;";
                     $games_res = mysqli_query($db, $games_query);

                     if (!$games_res) {
                         printf("Error: %s\n", mysqli_error($db));
                         exit();
                     }
                     if (mysqli_num_rows($games_res) > 0) {
                         while ($games_row = mysqli_fetch_assoc($games_res)) {
                             $gameName = $games_row['g_name'];
                             $gameId = $games_row['g_ID'];
                             $price = $games_row['g_price'];

                             echo "<div class='input-group' style='
                                    border-style: solid;
                                    border-width: 1px;
                                    margin-top: 20px;
                                    padding: 10px;
                                    font-size: 20px;
                                    border-color: rgba(112,112,112,0.3);
                                    border-radius: 25px; display: flex;
                                    padding-left: 40px'>
                                    <div>
                                        <input type='checkbox' value='" . $gameId . "' name='games[]'>
                                    </div>
                                    <div style='margin-left: 10px'>
                                        " . $gameName . "
                                    </div>
                                    <div style='position: absolute; right: 300px;'>
                                        " . $price . " TL
                                    </div>
                                </div>";

                             }
                     }
                     else {
                         echo "no results";
                     }
                 ?>
                <br>
                <div class="form-group" style="text-align: center; margin-top: 20px">
                    <input onclick="checkEmptyAndCreate()" type="button" class="btn btn-primary btn-lg" style="background-color: rgb(86, 188, 22); border-color: rgb(86, 188, 22); border-radius: 20px" value="     Add New Package      ">
                </div>
            </form>
        </div>
    </div>
    <div style="font-family: Avenir; font-size: 48px; margin-bottom: 2%; margin-left: 2%; margin-top: 5%;">Report 1</div>
    <hr>
    <div class="main-div" style="width: 70%; margin: auto;">
        <div style=" overflow-x: scroll; white-space: nowrap; width: 100%; height: 450px;">
            <?php
                $newDate = strtotime('-15 days', date("Y-m-d", time()));
                $games_query = "SELECT *, COUNT(*) as count_game FROM Published_Games vg, buys b  WHERE b.date >" . $newDate . " AND b.g_ID = vg.g_ID GROUP BY b.g_ID ORDER BY count_game ASC ;";
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
                        echo $g_ID;
                        echo "<div style='display: inline-block; float:none; position: relative'>
                            <img src='../Assets/images/package.jpeg'/>
                            <h3 style='font-weight: lighter; font-family: Avenir; font-size: 24px; color: white ; padding-left: 20px; padding-right: 20px; padding-bottom: 10px; padding-top: 10px; position: absolute; background-color: rgb(90,90,90); border-style: solid; border-radius: 30px; border-color: rgb(90,90,90); bottom: 8px; left: 16px;'>" . $game_name . "</h3>
                        </div>";
                    }
                } else {
                    echo "No recent reports found.";
                }
            ?>
        </div>
    </div>
    <div style="font-family: Avenir; font-size: 48px; margin-bottom: 2%; margin-left: 2%; margin-top: 5%;">Report 2</div>
    <hr>
    <!-- Rate'i tüm oyunların average rate'inden büyük olan ve son 5 gün içinde satın alınmış olan top 5 oyun -->
    <div class="main-div" style="width: 70%; margin: auto;">
        <div style=" overflow-x: scroll; white-space: nowrap; width: 100%; height: 450px;">
            <?php
                $newDate = strtotime('-5 days', date("Y-m-d", time()));
                $games_query = "SELECT *, COUNT(*) AS count_game 
                                FROM (
                                    SELECT *, AVG(r1.value) AS average_rate
                                    FROM rates r1
                                    GROUP BY r1.g_ID
                                    ) AS avg_value_table,
                                    (
                                    SELECT *, AVG(r2.value) as r2_a
                                    FROM rates r2
                                    GROUP BY r2.g_ID
                                    ) AS r2_table,
                                Published_Games vg, buys b 
                                WHERE r2_table.g_ID = vg.g_ID
                                AND b.date > " . $newDate . " AND b.g_ID = vg.g_ID 
                                GROUP BY r2_table.g_ID 
                                HAVING AVG(avg_value_table.average_rate) < r2_table.r2_a
                                ORDER BY count_game ASC LIMIT 5;";
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
                        echo $g_ID;
                        echo "<div style='display: inline-block; float:none; position: relative'>
                            <img src='../Assets/images/package.jpeg'/>
                            <h3 style='font-weight: lighter; font-family: Avenir; font-size: 24px; color: white ; padding-left: 20px; padding-right: 20px; padding-bottom: 10px; padding-top: 10px; position: absolute; background-color: rgb(90,90,90); border-style: solid; border-radius: 30px; border-color: rgb(90,90,90); bottom: 8px; left: 16px;'>" . $game_name . "</h3>
                        </div>";
                    }
                } else {
                    echo "No recent reports found.";
                }
            ?>
        </div>
    </div>
    <div style="margin-top: 50px;
                width: 100%;
                text-align: center;
                font-size: 20px;
                color: rgba(112,112,112,1);">
        <p>A Game Distribution Service by Pluto++</p>
    </div>
</div>
<script type="text/javascript">
    function checkEmptyAndCreate() {
        let nameVal = document.getElementById("subs-name").value;
        let priceVal = document.getElementById("subs-price").value;
        let dateVal = document.getElementById("date").value;
        if (nameVal === "" || priceVal === "" || priceVal === undefined || dateVal === "") {
            alert("Make sure to fill all fields!");
        }
        else if(priceVal <= 0){
            alert("Make sure to give a price more than 0!");
        }
        else {
            let form = document.getElementById("create-subs-form").submit();
        }
    }
</script>
</body>
</html>
