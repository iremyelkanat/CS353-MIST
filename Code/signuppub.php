<?php
//config inclusion session starts
include("config.php");
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $companyName = trim($_POST["company-name"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $phoneNumber = trim($_POST["phone-number"]);

    // phone existence check
    $phone_check_query = "SELECT * FROM Accountt WHERE phone_number = '$phoneNumber'";
    $phone_check_result = mysqli_query($db, $phone_check_query);
    $num_of_rows_phone_check = mysqli_num_rows($phone_check_result);

    // email existence check
    $email_check_query = "SELECT * FROM Accountt WHERE email_address = '$email'";
    $email_check_result = mysqli_query($db, $email_check_query);
    $num_of_rows_email_check = mysqli_num_rows($email_check_result);

    // company existence check
    $company_check_query = "SELECT * FROM Company WHERE c_name = '$companyName'";
    $company_check_result = mysqli_query($db, $company_check_query);
    $num_of_rows_company_check = mysqli_num_rows($company_check_result);

    if ($num_of_rows_phone_check > 0) {
        echo "<script type='text/javascript'>alert('Phone Number Already Exists.');</script>";
    }
    else if ($num_of_rows_email_check > 0) {
        echo "<script type='text/javascript'>alert('Email Already Exists.');</script>";
    }
    else if ($num_of_rows_company_check > 0) {
        echo "<script type='text/javascript'>alert('Company Name Already Exists.');</script>";
    }
    else {
        $insert_account_query = "INSERT INTO Accountt(email_address, phone_number, password) VALUES ('$email', '$phoneNumber', '$password')";
        $insert_account_result = mysqli_query($db, $insert_account_query);

        $get_aid_query = "SELECT a_ID FROM Accountt WHERE email_address = '$email'";
        $get_aid_result = mysqli_query($db, $get_aid_query);
        $row = mysqli_fetch_assoc($get_aid_result);
        $a_ID = $row['a_ID'];

        $insert_company_query = "INSERT INTO Company VALUES ('$a_ID', '$companyName');";
        $insert_company_result = mysqli_query($db, $insert_company_query);

        $insert_pub_company_query = "INSERT INTO Publisher_Company VALUES ('$a_ID');";
        $insert_pub_company_result = mysqli_query($db, $insert_pub_company_query);

        echo "<script LANGUAGE='JavaScript'>
                window.alert('Your account has been created successfully! Redirecing to index page...');
                window.location.href = 'index.php';
            </script>";
        //header("location: index.php");
    }
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
        <a href="index.php" class="navbar-brand" style="font-weight: bold; font-size: xx-large; font-family: Avenir">MIST</a>
        <div  class="navbar-nav ml-auto">
            <a class="nav-item nav-link" href="index.php">Return To Home Page</a>
        </div>
    </nav>
    <div style="margin-top: 5%;
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
            <span>Sign Up</span>
        </div>
        <div className="user-types" style="display: flex; justify-content: space-around; padding-top: 4%">
            <div style="
                border-style: solid;
                text-align: center;
                font-size: 20px;
                font-family: Avenir;
                padding-top: 1%;
                padding-bottom: 1%;
                padding-right: 2%;
                padding-left: 2%;
                border-color: rgba(112,112,112,1);
                border-width: 2px;
                border-radius: 15px">
                <a href="signupuser.php" style="text-decoration:none;color:inherit">
                    <span>User</span>
                </a>
            </div>
            <div style="
                border-style: solid;
                text-align: center;
                font-family: Avenir;
                font-size: 20px;
                padding-top: 1%;
                padding-bottom: 1%;
                padding-right: 2%;
                padding-left: 2%;
                border-color: rgba(112,112,112,1);
                border-width: 2px;
                border-radius: 15px">
                <a href="signupcurator.php" style="text-decoration:none;color:inherit">
                    <span>Curator</span>
                </a>
            </div>
            <div style="
                border-style: solid;
                text-align: center;
                font-family: Avenir;
                font-size: 20px;
                padding-top: 1%;
                padding-bottom: 1%;
                padding-right: 2%;
                padding-left: 2%;
                border-color: rgba(112,112,112,1);
                border-width: 2px;
                border-radius: 15px">
                <a href="signupdev.php" style="text-decoration:none;color:inherit">
                    <span>Dev. Co.</span>
                </a>
            </div>
            <div style="
                border-style: solid;
                text-align: center;
                font-family: Avenir;
                font-size: 20px;
                padding-top: 1%;
                padding-bottom: 1%;
                padding-right: 2%;
                padding-left: 2%;
                color: white;
                border-color: rgb(86, 188, 22);
                background-color: rgb(86, 188, 22);
                border-width: 2px;
                border-radius: 15px">
                Pub. Co.
            </div>
        </div>
        <div style="align-items: center; text-align: center;">
            <form id="login-form" method="post">
                <div class="input-group" style="margin-bottom: 2%; padding-right: 5%; padding-left: 5%; margin-top: 4%">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">@</span>
                    </div>
                    <input id="company-name" type="text" class="form-control" name="company-name" placeholder="Company Name">
                </div>
                <div class="input-group" style="margin-bottom: 2%; padding-right: 5%; padding-left: 5%; margin-top: 4%">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">@</span>
                    </div>
                    <input id="email" type="text" class="form-control" name="email" placeholder="Email">
                </div>
                <div class="input-group" style="margin-bottom: 2%; padding-right: 5%; padding-left: 5%; margin-top: 4%">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">@</span>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" placeholder="Password">
                </div>
                <div class="input-group" style="margin-bottom: 2%; padding-right: 5%; padding-left: 5%; margin-top: 4%">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">@</span>
                    </div>
                    <input id="phone-number" type="text" class="form-control" name="phone-number" placeholder="Phone Number">
                </div>
                <div class="form-group" style="margin-top: 5%;">
                    <input onclick="checkEmptyAndLogin()" type="button" class="btn btn-primary btn-lg" style="background-color: rgb(86, 188, 22); border-color: rgb(86, 188, 22); border-radius: 20px" value="  Sign Up  ">
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