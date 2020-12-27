<?php
   include("config.php");
   session_start();
   
   if(empty($_SESSION['a_ID']) || ($_SESSION['type'] !== "user" && $_SESSION['type'] !== "curator" )){
       header("location: index.php");
       die("Redirecting to login.php");
   }


if($_SERVER["REQUEST_METHOD"] == "POST") {

    $modeName = trim($_POST["mode-name"]);
    $modeSize = trim($_POST["mode-size"]);
    $modeDescription = trim($_POST["mode-description"]);
    $game_id = $_GET['game_id'];
    $account_id = $_SESSION['a_ID'];

        $insert_mode_query = "INSERT INTO Mode( m_name, m_description, m_size) VALUES ('$modeName', '$modeSize', '$modeDescription');";
        $insert_mode_result = mysqli_query($db, $insert_mode_query);

        $get_mid_query = "SELECT m_ID FROM Mode WHERE m_name = '$modeName'";
        $get_mid_result = mysqli_query($db, $get_mid_query);
        $row = mysqli_fetch_assoc($get_mid_result);
        $m_ID = $row['m_ID'];

        $insert_form_query = "INSERT INTO for_m VALUES ( '$m_ID', '$game_id');";
        $insert_form_result = mysqli_query($db, $insert_form_query);

        $insert_builds_query = "INSERT INTO builds VALUES ('$m_ID','$account_id');";
        $insert_builds_result = mysqli_query($db, $insert_builds_query);
        if (!$get_mid_result) {
            printf("Error mid: %s\n", mysqli_error($db));
            exit();
        }
        if (!$insert_mode_result) {
            printf("Error: %s\n", mysqli_error($db));
            exit();
        }

        if (!$insert_form_result) {
            printf("Error: 2\n");
            exit();
        }
        if (!$insert_builds_result) {
            printf("Error: 3\n");
            exit();
        }

        echo "<script LANGUAGE='JavaScript'>
                window.alert('Your mode has been added successfully! Redirecting...');
                window.location.href = 'modes.php';
            </script>";
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
                <a class="nav-item nav-link active">Home</a>
                <a href="store.php" class="nav-item nav-link">Store</a>
                <a href="library.php" class="nav-item nav-link">Library</a>
                <a href="modes.php" class="nav-item nav-link">Modes</a>
                <a href="friends.php" class="nav-item nav-link">Friends</a>
            </div>
            <div class="navbar-nav ml-auto">
                <a class="nav-item nav-link" href="logout.php">Logout</a>
            </div>
        </nav>
        <div class="main-div" style="display: grid; padding-left: 2%; padding-right: 2%; padding-top: 2%; padding-bottom: 1%">
            <div style="clear: both;"></div>
         </div>
         <div class="main-part" style="
                  border-style: solid;
                  border-width: 2px;
                  margin-top: 50px;
                  margin-left: 200px;
                  margin-right: 200px;
                  padding: 50px;
                  border-radius: 20px";>
             <div style="width: 100%">
             <div style="font-family: Avenir; font-size: 48px ; margin-bottom: 1%">Create Mode</div>
                 <hr style="margin-top: 25px; margin-bottom: 25px;">
                 <div class="create-mode">
                     <form id="create-mode-form" method="post">
                         <div style="display: flex">
                             <div class="input-group" style="margin-top: 20px; margin-right: 10px">
                                 <input id="mode-name" type="text" class="form-control" name="mode-name" placeholder="Name of the Mode" style=" outline: none; font-size: 20px; border-style: solid; border-radius: 20px">
                             </div>
                             <div class="input-group" style="margin-top: 20px; margin-left: 10px">
                                 <input id="mode-size" type="text" class="form-control" name="mode-size" placeholder="Mode Size" style=" outline: none; font-size: 20px; border-style: solid; border-radius: 20px">
                             </div>
                         </div>
                         <div class="input-group" style="margin-top: 20px">
                            <textarea id="mode-description" rows="4" maxlength="280" class="form-control" name="mode-description" placeholder="Mode Description" style="resize: none; display: block; border-radius: 20px"></textarea>
                         </div>
                         <div class="form-group" style="text-align: center; margin-top: 20px">
                             <input onclick="checkEmptyAndCreateMode()" type="button" class="btn btn-primary btn-lg" style="background-color: rgb(86, 188, 22); border-color: rgb(86, 188, 22); border-radius: 20px" value="    Create Mode    ">
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
         function checkEmptyAndCreateMode() {
             let modeName = document.getElementById("mode-name").value;
             let modeSize = document.getElementById("mode-size").value;
             let modeDescription = document.getElementById("mode-description").value;
             if (modeName === "" || modeSize === "" || modeDescription === "") {
                 alert("Make sure to fill all fields!");
             }
             else {
                 let form = document.getElementById("create-mode-form").submit();
             }
         }
      </script>
   </body>
</html>