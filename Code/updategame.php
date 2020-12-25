<?php
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
        <a href="index.php" class="navbar-brand" style="font-weight: bold; font-size: xx-large; font-family: Avenir">MIST</a>
        <div  class="navbar-nav ml-auto">
            <a class="nav-item nav-link" href="index.php">Return To Home Page</a>
        </div>
    </nav>
    <div class="m" role="main" style="height: 400px; width: 800px;">
        <div class="n" style="height: 400px; width: 800px; background-color: transparent; border: none">
            <div class="k" style="background-color: transparent">
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
        let companyNameVal = document.getElementById("company-name").value;
        let emailVal = document.getElementById("email").value;
        let passwordVal = document.getElementById("password").value;
        let phoneNumberVal = document.getElementById("phone-number").value;
        if (companyNameVal === "" || passwordVal === "" || emailVal === "" | phoneNumberVal === "") {
            alert("Make sure to fill all fields!");
        }
        else {
            let form = document.getElementById("login-form").submit();
        }
    }
</script>
</body>
</html>


