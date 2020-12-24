<?php
include("config.php");
session_start();

if (empty($_SESSION['a_ID']) || $_SESSION['type'] !== "user") {
    header("location: index.php");
    die("Redirecting to login.php");
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
                <a href="library.php" class="nav-item nav-link">Libary</a>
                <a href="mode.php" class="nav-item nav-link">Mode</a>
                <a href="friends.php" class="nav-item nav-link">Friends</a>
            </div>
            <div class="navbar-nav ml-auto">
                <a class="nav-item nav-link" href="logout.php">Logout</a>
            </div>
        </nav>
        <div class="main-div" style="display: grid; padding-left: 2%; padding-right: 2%; padding-top: 2%; padding-bottom: 1%">
            <div style="clear: both;"></div>
            <div style="justify-content:space-around; display: flex; margin:auto ">
                <div style=" margin-right: 200px ;float: left; width: 420px; text-align: left" ;>
                    <div class="btn btn-primary btn-lg" style="width: 100%; 
                  background-color: rgb(126, 166, 234); 
                  border-color: rgb(126, 166, 234); 
                  border-radius: 20px">
                        <a href="addcreditcard.php" style="text-decoration:none;color:inherit " ;><span>Add Credit Card</span></a>
                    </div>
                </div>
                <span> OR </span>
                <div style="  margin-left: 200px;  float: right; width: 420px; text-align: right" ;>
                    <div class="btn btn-primary btn-lg" style="width: 100%; 
                  background-color: rgb(256, 256, 256); 
                  border-color: rgb(126, 166, 234); 
                  border-radius: 20px">
                        <a href="addcreditcard.php" style="text-decoration:none;color:black " ;><span>Transfere Money</span></a>
                    </div>
                </div>
            </div>
            
            <div style="display: grid;width:  420px; height: 250px; float: right; position: relative; text-align: center">
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
                } else {
                    let form = document.getElementById("login-form").submit();
                }
            }
        </script>
</body>

</html>