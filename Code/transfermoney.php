<?php
   include("config.php");
   session_start();

   if(empty($_SESSION['a_ID'] ) || ( ($_SESSION['type'] !== "user" ) && ($_SESSION['type'] !== "curator"))){
    header("location: index.php");
       die("Redirecting to login.php");
   }

    if($_SERVER["REQUEST_METHOD"] == "POST") {

        $amount = trim($_POST["amount"]);
        $cardId = trim($_POST["card-id"]);

        $update_wallet_query = "UPDATE Wallet w SET w.balance = (w.balance + $amount) WHERE w.a_ID = " . $_SESSION['a_ID'] . ";";
        $update_wallet_result = mysqli_query($db, $update_wallet_query);

        if (!$update_wallet_result) {
            printf("Error: %s\n", mysqli_error($db));
            exit();
        }
        if($_SESSION['type'] === "user"){
            echo "<script LANGUAGE='JavaScript'>
                window.alert('Your wallet has been updated successfully! Redirecing...');
                window.location.href = 'userhome.php';
            </script>";
        }
        else{
            echo "<script LANGUAGE='JavaScript'>
                window.alert('Your wallet has been updated successfully! Redirecing...');
                window.location.href = 'curatorhome.php';
            </script>";
        }
        
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
                  background-color: rgb(256, 256, 256);
                  border-color: rgba(112,112,112,0.3);
                  border-radius: 20px">
                        <a href="addcreditcard.php" style="text-decoration:none;color:black " ;><span>Add Credit Card</span></a>
                    </div>
                </div>
                <div style="font-size: 24px; height: 50px; line-height: 50px; font-family: Avenir"> OR </div>
                <div style="  margin-left: 200px;  float: right; width: 420px; text-align: right" ;>
                    <div class="btn btn-primary btn-lg" style="width: 100%;
                    background-color: rgb(126, 166, 234);
                  border-color: rgb(126, 166, 234);
                  border-radius: 20px">
                        <a href="transfermoney.php" style="text-decoration:none;color:inherit " ;><span>Transfer Money</span></a>
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
                 <form id="transfer-money-form" method="post">
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
                                    <div style='height: 30px; line-height: 30px'>
                                        <input type='radio' id='". $cardId ."' name='card-id' value='". $cardId ."'>
                                    </div>
                                    <div style='margin-left: 10px'>
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
                         <div class="input-group" style="">
                             <input id="amount" type="number" class="form-control" name="amount" min=0 placeholder="Amount" style=" outline: none; font-size: 20px; border-style: solid; border-radius: 20px">
                             <div style='position: absolute; right: 50px; font-size: 20px; height: 45px; line-height: 45px'>
                                     ₺
                             </div>
                         </div>
                         <div class="form-group" style="text-align: center; margin-top: 50px">
                             <input onclick="checkEmptyAndUpdateBalance()" type="button" class="btn btn-primary btn-lg" 
                             style="background-color: rgb(86, 188, 22); border-color: rgb(86, 188, 22); border-radius: 20px" value="     Transfer      ">
                         </div>
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
         function checkEmptyAndUpdateBalance() {
             let amountVal = document.getElementById("amount").value;
             let cardIdVals = document.getElementsByName("card-id");

             let cardIdVal = "";

             for (var i = 0, length = cardIdVals.length; i < length; i++) {
                 if (cardIdVals[i].checked) {
                     // do whatever you want with the checked radio
                     cardIdVal = cardIdVals[i].value;
                     // only one radio can be logically checked, don't check the rest
                     break;
                 }
             }
             if (amountVal === "" || cardIdVal === "") {
                 alert("Make sure to fill all fields!");
             }
             else {
                 let form = document.getElementById("transfer-money-form").submit();
             }
         }
      </script>
   </body>
</html>