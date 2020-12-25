<?php
    include ("config.php");
    session_start();

    if (isset($_GET['g_ID'])) {
        $game_id = $_GET['g_ID'];
        $_SESSION["g_ID"] = $game_id;
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $price = trim($_POST["amount"]);
        $g_ID = $_SESSION["g_ID"];
        $a_ID = $_SESSION["a_ID"];

        $game_query = "UPDATE Video_Game SET g_price=". $price ." WHERE g_ID=". $g_ID .";";

        $game_query_result = mysqli_query($db, $game_query);
        if (!$game_query_result) {
            printf("Error: %s\n", mysqli_error($db));
            exit();
        }
        
        $publish_query = "INSERT INTO publish VALUES(". $g_ID . "," . $a_ID . ", now());";

        $publish_query_result = mysqli_query($db, $publish_query);
        if(!$publish_query_result){
            printf("Error: %s\n", mysqli_error($db));
            exit();
        }
        echo "<script LANGUAGE='JavaScript'>
                    window.alert('Game is published successfully! Redirecting...');
                    window.location.href = 'approvals.php';
            </script>";
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
            <a href="publisherhome.php" class="nav-item nav-link">Home</a>
            <a class="nav-item nav-link active">Approvals</a>
            <a href="requests.php" class="nav-item nav-link">Requests</a>
        </div>
        <div  class="navbar-nav ml-auto">
            <a class="nav-item nav-link" href="logout.php">Logout</a>
        </div>
    </nav>
    <div class="main-part" style="
                    border-style: solid;
                     border-width: 2px;
                  margin-top: 50px;
                  margin-left: 200px;
                  margin-right: 200px;
                  padding: 50px;
                  border-radius: 20px";>
             <div style="width: 100%">
                 <hr style="margin-top: 25px; margin-bottom: 25px;">
                 <div class="publish-game">
                     <form id="publish-game-form" method="post">
                         <div style="display: flex">
                             <div class="input-group" style="margin-top: 20px; margin-right: 10px">
                                 <input id="amount" type="number" class="form-control" name="amount" placeholder="Game Price" style=" outline: none; font-size: 20px; border-style: solid; border-radius: 20px">
                             </div>
                         </div>
                         <div class="form-group" style="text-align: center; margin-top: 20px">
                             <input onclick="checkEmptyAndPublish()" type="button" class="btn btn-primary btn-lg" style="background-color: rgb(86, 188, 22); border-color: rgb(86, 188, 22); border-radius: 20px" value="     Publish      ">
                         </div>
                     </form>
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
    function checkEmptyAndPublish() {
        let fullAmount = document.getElementById("amount").value;
        if (fullAmount <= 0) {
            alert("Make sure that your given amount is more than 0!");
        }
        else {
            let form = document.getElementById("publish-game-form").submit();
        }
    }
</script>
</body>
</html>