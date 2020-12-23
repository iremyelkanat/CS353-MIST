<? ob_start(); ?> 
<?php
    //config inclusion session starts
    include("config.php");
    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST") {

        $email = $password = "";
        $email = trim($_POST["email"]);
        $password = trim($_POST["password"]);
        $email=strtolower($email);
        $password=strtolower($password);

        $login_query = "SELECT * FROM Accountt WHERE email_address = '$email' and password = '$password'";

        $result = mysqli_query($db, $login_query);

        $num_of_rows = mysqli_num_rows($result);

        if ($num_of_rows > 0) {

            session_start();
            $row = mysqli_fetch_assoc($result);
            $a_ID = $row['a_ID'];

            $_SESSION['a_ID'] = $a_ID;

            // Check if User
            $user_query = "SELECT * FROM User WHERE a_ID = '$a_ID'";
            $user_result = mysqli_query($db, $user_query);
            $num_of_rows_user = mysqli_num_rows($user_result);

            // Check if Curator
            $curator_query = "SELECT * FROM Curator WHERE a_ID = '$a_ID'";
            $curator_result = mysqli_query($db, $curator_query);
            $num_of_rows_curator = mysqli_num_rows($curator_result);

            // Check if Developer
            $dev_query = "SELECT * FROM Developer_Company WHERE a_ID = '$a_ID'";
            $dev_result = mysqli_query($db, $dev_query);
            $num_of_rows_dev = mysqli_num_rows($dev_result);

            // Check if Publisher
            $pub_query = "SELECT * FROM Publisher_Company WHERE a_ID = '$a_ID'";
            $pub_result = mysqli_query($db, $pub_query);
            $num_of_rows_pub = mysqli_num_rows($pub_result);

            echo "<script type='text/javascript'>alert('$num_of_rows_curator');</script>";
            echo "<script type='text/javascript'>alert('$num_of_rows_user');</script>";
            echo "<script type='text/javascript'>alert('$num_of_rows_dev');</script>";
            echo "<script type='text/javascript'>alert('$num_of_rows_pub');</script>";

            if ($num_of_rows_curator > 0) {
                $_SESSION['type'] = "curator";
                header("location: curatorhome.php");
            }

            else if ($num_of_rows_user > 0) {
                $_SESSION['type'] = "user";
                header("location: userhome.php");
            }

            else if ($num_of_rows_dev > 0) {
                $_SESSION['type'] = "dev";
                header("location: developerhome.php");
            }

            else if ($num_of_rows_pub > 0) {
                $_SESSION['type'] = "pub";
                header("location: publisherhome.php");
            }

            echo "<script type='text/javascript'>alert('checkpoint 11');</script>";
        }
        else {
            echo "<script type='text/javascript'>alert('Invalid Username or Password.');</script>";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="width=device-width, initial-scale=1.0"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MIST - Sign In</title>
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
        <a href="index.php" class="navbar-brand" style="font-weight: bold; font-size: xx-large; font-family: Avenir">MIST</a>
        <div  class="navbar-nav ml-auto">
            <a class="nav-item nav-link" href="index.php">Return To Home Page</a>
        </div>
    </nav>
    <div style="margin-top: 10%;
                margin-bottom: 10%;
                margin-right: 30%;
                margin-left: 30%;
                border-style: solid;
                border-color: rgba(112,112,112,1);
                border-width: 2px;
                border-radius: 20px">
        <div style="position: center;
                overflow: visible;
                width: 100%;
                alignment: center;
                align-self: center;
                white-space: nowrap;
                text-align: center;
                font-family: Avenir;
                font-style: normal;
                font-weight: normal;
                font-size: 72px;
                color: rgba(112,112,112,1);">
            <span>Sign In</span>
        </div>
       <div style="align-items: center; text-align: center;">
           <form id="login-form" method="post">
               <div class="input-group" style="margin-bottom: 2%; padding-right: 5%; padding-left: 5%; margin-top: 4%">
                   <div class="input-group-prepend">
                       <span class="input-group-text" id="basic-addon1">@</span>
                   </div>
                   <input id="email" type="text" class="form-control" name="email" placeholder="Email">
               </div>
               <div class="input-group" style="margin-bottom: 2%; padding-right: 5%; padding-left: 5%; margin-top: 4%">
                   <div class="input-group-prepend" >
                       <span class="input-group-text" id="basic-addon1">$</span>
                   </div>
                   <input id="password" type="password" class="form-control" name="password" placeholder="Password">
               </div>
               <div class="form-group" style="margin-top: 5%;">
                   <input onclick="checkEmptyAndLogin()" type="button" class="btn btn-primary btn-lg" style="background-color: rgb(86, 188, 22); border-color: rgb(86, 188, 22); border-radius: 20px" value="  Sign In  ">
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
    function checkEmptyAndLogin() {
        let emailVal = document.getElementById("email").value;
        let passwordVal = document.getElementById("password").value;
        if (emailVal === "" || passwordVal === "") {
            alert("Make sure to fill all fields!");
        }
        else {
            let form = document.getElementById("login-form").submit();
        }
    }
</script>
</body>
</html>
<? ob_flush(); ?>