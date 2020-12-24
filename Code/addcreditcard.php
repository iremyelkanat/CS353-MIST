<?php
   include("config.php");
   session_start();
   
   if(empty($_SESSION['a_ID']) || $_SESSION['type'] !== "user"){
       header("location: index.php");
       die("Redirecting to login.php");
   }

    if (isset($_GET['package_id'])) {
        $package_id = $_GET['package_id'];

        $package_query = "SELECT * FROM Subscription_Package WHERE package_ID =" . $package_id . ";";

        $package_query_result = mysqli_query($db, $package_query);
        if (!$package_query_result) {
            printf("Error: %s\n", mysqli_error($db));
            exit();
        }
        $package_row = mysqli_fetch_assoc($package_query_result);

        $package_name = $package_row['package_name'];
        $package_duration = $package_row['duration'];
        $package_price = $package_row['price'];
    }



    if($_SERVER["REQUEST_METHOD"] == "POST") {

        $cardName = trim($_POST["card-name"]);
        $bankNme = trim($_POST["bank-name"]);
        $cardNumber = trim($_POST["card-number"]);
        $date = trim($_POST["date"]);

        /*// phone existence check
        $phone_check_query = "SELECT * FROM Accountt WHERE phone_number = '$phoneNumber'";
        $phone_check_result = mysqli_query($db, $phone_check_query);
        $num_of_rows_phone_check = mysqli_num_rows($phone_check_result);

        // email existence check
        $email_check_query = "SELECT * FROM Accountt WHERE email_address = '$email'";
        $email_check_result = mysqli_query($db, $email_check_query);
        $num_of_rows_email_check = mysqli_num_rows($email_check_result);

        // nick existence check
        $nick_check_query = "SELECT * FROM User WHERE nick_name = '$nickName'";
        $nick_check_result = mysqli_query($db, $nick_check_query);
        $num_of_rows_nick_check = mysqli_num_rows($nick_check_result);

        if ($num_of_rows_phone_check > 0) {
            echo "<script type='text/javascript'>alert('Phone Number Already Exists.');</script>";
        }
        else if ($num_of_rows_email_check > 0) {
            echo "<script type='text/javascript'>alert('Email Already Exists.');</script>";
        }
        else if ($num_of_rows_nick_check > 0) {
            echo "<script type='text/javascript'>alert('Nick Name Already Exists.');</script>";
        }
        */
            $insert_card_query = "INSERT INTO Credit_Card(card_ID, bank, name, exp_date) VALUES ('$cardNumber', '$bankNme', '$cardName', '$date');";
            $insert_card_result = mysqli_query($db, $insert_card_query);

            $insert_include_query = "INSERT INTO include VALUES ('$cardNumber', 0, ". $_SESSION['a_ID'].");";
            $insert_include_result = mysqli_query($db, $insert_include_query);

            if (!$insert_card_result) {
                printf("Error: %s\n", mysqli_error($db));
                printf("Error: 1");
                exit();
            }

            if (!$insert_include_result) {
                printf("Error: 2\n");
                exit();
            }

            echo "<script LANGUAGE='JavaScript'>
                    window.alert('Your card has been added successfully! Redirecing...');
                    window.location.href = 'userhome.php';
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                <div style="font-size: 24px; height: 50px; line-height: 50px; font-family: Avenir"> OR </div>
                <div style="  margin-left: 200px;  float: right; width: 420px; text-align: right" ;>
                    <div class="btn btn-primary btn-lg" style="width: 100%; 
                  background-color: rgb(256, 256, 256); 
                  border-color: rgba(112,112,112,0.3);
                  border-radius: 20px">
                        <a href="transfermoney.php" style="text-decoration:none;color:black " ;><span>Transfer Money</span></a>
                    </div>
                </div>
            </div>
         </div>
         <div class="main-part" style="
                    border-style: solid;
                     border-width: 2px;
                  margin-top: 50px;
                  margin-left: 200px;
                  margin-right: 200px;
                  padding: 50px;
                  border-radius: 30px";>
             <div style="width: 100%; font-family: Avenir">
                 <div style="font-size: 32px;">
                     Current Credit Cards
                 </div>
                 <?php
                     $card_query = "SELECT c.card_ID, c.name FROM Wallet w, include i, Credit_Card c WHERE i.w_ID = w.w_ID AND c.card_ID = i.card_ID AND w.a_ID = " . $_SESSION['a_ID'] . ";";
                     $card_result = mysqli_query($db, $card_query);

                     if (!$card_result) {
                         printf("Error: %s\n", mysqli_error($db));
                         exit();
                     }
                     if (mysqli_num_rows($card_result) > 0) {
                         while ($cards_row = mysqli_fetch_assoc($card_result)) {
                             $cardName = $cards_row['name'];
                             $cardId = $cards_row['card_ID'];

                             echo "<div class='credit-card-info' style='
                                    border-style: solid;
                                    border-width: 1px;
                                    margin-top: 20px;
                                    padding: 10px;
                                    font-size: 20px;
                                    border-color: rgba(112,112,112,0.3);
                                    border-radius: 25px; display: flex;
                                    padding-left: 40px'>
                                    <div style=''>
                                    $cardName
                                    </div>
                                    <div style='position: absolute; left: 600px'>
                                    $cardId
                                    </div>
                                    <div style='position: absolute; right: 300px'>
                                    <a href='deletecard.php?card_id=" . $cardId. "' style='color: inherit'>
                                    <i class='fa fa-trash'></i>
                                    </a>
                                    </div>
                                </div>";

                             }
                     }
                     else {
                         echo "no results";
                     }
                 ?>
                 <hr style="margin-top: 25px; margin-bottom: 25px;">
                 <div class="create-card">
                     <form id="create-card-form" method="post">
                         <div class="input-group" style="">
                             <input id="card-name" type="text" class="form-control" name="card-name" placeholder="Name of the Card" style=" outline: none; font-size: 20px; border-style: solid; border-radius: 20px">
                         </div>
                         <div class="input-group" style="margin-top: 20px">
                             <input id="bank-name" type="text" class="form-control" name="bank-name" placeholder="Bank Name" style=" outline: none; font-size: 20px; border-style: solid; border-radius: 20px">
                         </div>
                         <div style="display: flex">
                             <div class="input-group" style="margin-top: 20px; margin-right: 10px">
                                 <input id="card-number" type="text" class="form-control" name="card-number" placeholder="Card Number" style=" outline: none; font-size: 20px; border-style: solid; border-radius: 20px">
                             </div>
                             <div class="input-group" style="margin-top: 20px; margin-left: 10px">
                                 <input id="date" type="date" class="form-control" name="date" placeholder="Expiration Date" style=" outline: none; font-size: 20px; border-style: solid; border-radius: 20px">
                             </div>
                         </div>
                         <div class="form-group" style="text-align: center; margin-top: 50px">
                             <input onclick="checkEmptyAndCreateCard()" type="button" class="btn btn-primary btn-lg" style="background-color: rgb(86, 188, 22); border-color: rgb(86, 188, 22); border-radius: 20px" value="     Add New Card      ">
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
         function checkEmptyAndCreateCard() {
             let cardNameVal = document.getElementById("card-name").value;
             let bankNameVal = document.getElementById("bank-name").value;
             let cardNumberVal = document.getElementById("card-number").value;
             let dateVal = document.getElementById("date").value;
             if (cardNameVal === "" || bankNameVal === "" || cardNumberVal === "" || dateVal === "") {
                 alert("Make sure to fill all fields!");
             }
             else if (dateVal < Date.now()) {
                 alert("Msg!");
             }
             else {
                 alert("full");
                 let form = document.getElementById("create-card-form").submit();
             }
         }
      </script>
   </body>
</html>