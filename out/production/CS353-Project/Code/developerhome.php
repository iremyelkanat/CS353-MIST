<?php
    include("config.php");
    session_start();

    if(empty($_SESSION['a_ID']) || $_SESSION['type'] != "dev"){
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
            <a class="nav-item nav-link active">Home</a>
            <a href="games.php" class="nav-item nav-link">Games</a>
        </div>
        <div  class="navbar-nav ml-auto">
            <a class="nav-item nav-link" href="logout.php">Logout</a>
        </div>
    </nav>
    <div class="main-div" style="display: flex; padding-left: 2%; padding-right: 2%; padding-top: 2%; padding-bottom: 1%">
        <div class="information-header" style="width: 100%">
            <div style="font-family: Avenir; font-size: 48px; margin-bottom: 2%">Home</div>
            <hr>
            <div class="information-detail-p1"; style="font-size: 24px">
                <?php
                $account_query = "SELECT c_name, email_address FROM Accountt NATURAL JOIN Developer_Company NATURAL JOIN Company WHERE a_ID =" . $_SESSION['a_ID'] . ";";

                $account_query_result = mysqli_query($db, $account_query);
                if (!$account_query_result) {
                    printf("Error: %s\n", mysqli_error($db));
                    exit();
                }
                $account_row = mysqli_fetch_assoc($account_query_result);

                $company_name = $account_row['c_name'];
                $account_email = $account_row['email_address'];
                echo "<div> Company Name: " . $company_name . " </div>";
                echo "<div> E-mail: " . $account_email . " </div>";
                ?>
            </div>
            <hr>
            <div class="information-detail-p2"; style="font-size: 24px">
                <?php
                    $approved_query = "SELECT COUNT(*) AS num_of_games_approved FROM asks a, takes t WHERE a.r_ID = t.r_ID AND t.state='Approved' AND a.a_ID =" . $_SESSION['a_ID'] . ";";
                    $declined_query = "SELECT COUNT(*) AS num_of_games_declined FROM asks a, takes t WHERE a.r_ID = t.r_ID AND t.state='Declined' AND a.a_ID =" . $_SESSION['a_ID'] . ";";
                    $online_query = "SELECT COUNT(*) AS num_of_requests_online FROM asks a, takes t WHERE a.r_ID = t.r_ID AND (t.state<>'Approved' AND t.state<>'Declined') AND a.a_ID =" . $_SESSION['a_ID'] . ";";

                    // num of games approved
                    $approved_query_result = mysqli_query($db, $approved_query);
                    if (!$approved_query_result) {
                        printf("Error: %s\n", mysqli_error($db));
                        exit();
                    }
                    $approved_row = mysqli_fetch_assoc($approved_query_result);
                    $approved_count = $approved_row['num_of_games_approved'];

                    // num of games declined
                    $declined_query_result = mysqli_query($db, $declined_query);
                    if (!$declined_query_result) {
                        printf("Error: %s\n", mysqli_error($db));
                        exit();
                    }
                    $declined_row = mysqli_fetch_assoc($declined_query_result);
                    $declined_count = $declined_row['num_of_games_declined'];

                    // num of games online
                    $online_query_result = mysqli_query($db, $online_query);
                    if (!$online_query_result) {
                        printf("Error: %s\n", mysqli_error($db));
                        exit();
                    }
                    $online_row = mysqli_fetch_assoc($online_query_result);
                    $online_count = $online_row['num_of_requests_online'];

                    echo "<div> # of games approved: " . $approved_count . " </div>";
                    echo "<div> # of games declined: " . $declined_count . " </div>";
                    echo "<div> # of requests online: " . $online_count . " </div>";
                ?>
                <hr>
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


