<?php
include("config.php");
session_start();

if (isset($_GET['searchVal'])) {
    $search_val = $_GET['searchVal'];

}

if (isset($_GET['friend_id'])) {
    $id = $_GET['friend_id'];
    $insert_friend_query = "INSERT INTO friendship VALUES ( " . $_SESSION['a_ID'] ."  , ". $id . " );";
    $insert_friend_result = mysqli_query($db, $insert_friend_query);
    if (!$insert_friend_result) {
        printf("Error: %s\n", mysqli_error($db));
        exit();
    }
    echo "<script LANGUAGE='JavaScript'>
    window.alert('You added a friend successfully! Redirecting...');
    window.location.href = 'friends.php?searchVal=". $search_val ."';
</script>";
}

if (isset($_GET['follower_id'])) {
    $id = $_GET['follower_id'];
    $insert_friend_query = "INSERT INTO followed_by VALUES ( ". $id . " ,  " . $_SESSION['a_ID'] .");";
    $insert_friend_result = mysqli_query($db, $insert_friend_query);
    if (!$insert_friend_result) {
        printf("Error: %s\n", mysqli_error($db));
        exit();
    }
    echo "<script LANGUAGE='JavaScript'>
    window.alert('You followed a curator successfully! Redirecting...');
    window.location.href = 'friends.php?searchVal=". $search_val ."';
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
                <?php
                if ($_SESSION['type'] === "user") {
                    echo "<a href='userhome.php' class='nav-item nav-link'>Home</a>";
                } else {
                    echo "<a href='curatorhome.php' class='nav-item nav-link'>Home</a>";
                }
                ?>
                <a href="library.php" class="nav-item nav-link">Store</a>
                <a href="library.php" class="nav-item nav-link">Libary</a>
                <a href="modes.php" class="nav-item nav-link">Modes</a>
                <a href="friends.php" class="nav-item nav-link">Friends</a>
            </div>
            <div class="navbar-nav ml-auto">
                <a class="nav-item nav-link" href="logout.php">Logout</a>
            </div>
        </nav>
        <div class="main-div"
            style=" padding-left: 2%; padding-right: 2%; padding-top: 2%; padding-bottom: 1%">
            <div class="information-header" style="width: 100%">
                <div style="font-family: Avenir; font-size: 48px ; margin-bottom: 2%">Users to Add as Friend</div>
                <hr style="margin-right: 20%">
                <div class="games-bought-display" style="width: 30%">
                <div style=" width: 100%">
                    <?php
                    $user_query = "SELECT * FROM User u WHERE u.nick_name LIKE '%" . $search_val . "%' 
                    #AND  u.nick_name
                    #NOT IN (SELECT u2.nick_name FROM (friendship f, User u1, User u2) INNER JOIN u.nick_name WHERE
                     #( u1.a_ID =" . $_SESSION['a_ID'] ." AND u2.a_ID <> " . $_SESSION['a_ID'] . 
                     #" AND f.target = u1.a_ID AND f.starter = u2.a_ID) OR (f.target = u2.a_ID AND f.starter = u1.a_ID AND u1.a_ID = " . $_SESSION['a_ID'] . " AND u2.a_ID <>" . $_SESSION['a_ID'] . 
                     ";";
                    $user_query_result = mysqli_query($db, $user_query);
                    if (!$user_query_result) {
                        printf("Error: %s\n", mysqli_error($db));
                        exit();
                    }
                                    
                    if (mysqli_num_rows($user_query_result) > 0) {
                        while ($game_row = mysqli_fetch_assoc($user_query_result)) {
                            $a_id = $game_row['a_ID'];
                            $nick = $game_row['nick_name'];

                            echo "<a href='searchfriends.php?friend_id=". $a_id ."&searchVal=". $search_val ."'>
                            <div class='credit-card-info' style='
                                            border-style: solid;
                                            border-width: 1px;
                                            margin-top: 20px;
                                            padding: 10px;
                                            font-size: 20px;
                                            border-color: rgba(112,112,112,0.3);
                                            border-radius: 25px; display: flex;
                                            padding-left: 40px'>
                                            <div style='margin-left: 10px'>
                                                $nick
                                            </div>
                                            </div>
                            </a>";
                        }
                    }
                    else {
                        echo "no results";
                    }
                    ?>
                </div>
            </div>
            <div class="package_subscribed_display">
                <div style=" width: 100%">
                <div style="font-family: Avenir; font-size: 48px ; margin-bottom: 2%">Curators To Follow</div>
                <hr style="margin-right: 20%">
                <div class="games-bought-display" style="width: 100%">
                <div style=" width: 30%;">
                    <?php
                    $user_query = "SELECT u.nick_name, u.a_ID FROM Curator c, User u WHERE c.a_ID = u.a_ID AND u.nick_name LIKE '%" . $search_val . "%';";
                    $user_query_result = mysqli_query($db, $user_query);
                    if (!$user_query_result) {
                        printf("Error: %s\n", mysqli_error($db));
                        exit();
                    }
                                    
                    if (mysqli_num_rows($user_query_result) > 0) {
                        while ($game_row = mysqli_fetch_assoc($user_query_result)) {
                            $a_id = $game_row['a_ID'];
                            $nick = $game_row['nick_name'];

                            echo "<a href='searchfriends.php?follower_id=". $a_id ."'>
                            <div class='credit-card-info' style='
                                            border-style: solid;
                                            border-width: 1px;
                                            margin-top: 20px;
                                            padding: 10px;
                                            font-size: 20px;
                                            border-color: rgba(112,112,112,0.3);
                                            border-radius: 25px; display: flex;
                                            padding-left: 40px'>
                                            <div style='margin-left: 10px'>
                                                $nick
                                            </div>
                            </a>";
                        }
                    }
                    else {
                        echo "no results";
                    }
                    ?>
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

            function addFriend() {
                let giv_int = document.getElementById("rate_given_text").value;
                if (!giv_int && giv_int > 5) {
                    alert("Make sure to fill all fields!");
                } else if (giv_int > 5) {
                    alert("Rate should not be higher than 5");
                } else {
                    let form = document.getElementById("create-rate-form").submit();
                }
            }
        </script>
</body>

</html>