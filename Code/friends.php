<?php
    include("config.php");
    session_start();
?>

<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $search_val = trim($_POST["search-val"]);
    echo "<script LANGUAGE='JavaScript'>
    window.location.href = 'searchfriends.php?searchVal=". $search_val ."';
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
            }
            else {
                echo "<a href='curatorhome.php' class='nav-item nav-link'>Home</a>";
            }
            ?>
                <a href="store.php" class="nav-item nav-link">Store</a>
                <a href="library.php" class="nav-item nav-link">Library</a>
                <a href="modes.php" class="nav-item nav-link">Modes</a>
                <a class="nav-item nav-link active">Friends</a>
            </div>
            <div class="navbar-nav ml-auto">
                <a class="nav-item nav-link" href="logout.php">Logout</a>
            </div>
        </nav>

        <div class="main-div"
            style=" padding-left: 2%; padding-right: 2%; padding-top: 2%; padding-bottom: 1%">
            <div style="display: table-cell; vertical-align: middle; 
                     border-radius: 20px; 
                    border-color: rgba(112,112,112,1);
                     border-width: 2px;
                     margin-right: 100px;
                     margin-left: 100px;
                     text-align: center;">
                 <div class="search-value">
                     <form id="search-form" method="post">
                         <div style="display: flex">
                             <div class="input-group" style="margin-top: 20px; margin-left: 1000px; margin-right: 30px; text-align: center">
                                 <input id="search-val" type="text" class="form-control" name="search-val" placeholder="Add User By Name" style=" outline: none; font-size: 20px; border-radius: 20px">
                             </div>
                             <div class="form-group" style="margin-top: 20px; margin-right: 30px; text-align: center">
                             <input onclick="checkEmptyAndSearch()" type="button" class="btn btn-primary btn-lg" style="background-color: gray; font-size: 20px; border-color: gray; border-radius: 20px" value="    Search    ">
                         </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="information-header" style="width: 30%">
                <div style="font-family: Avenir; font-size: 48px ; margin-bottom: 1%">Friends</div>
                <hr style="margin-right: 10%">
                <div class="curators-display">
                    <div style=" width = 40%;">
                        <?php
                            $friends_query = "SELECT u2.nick_name, u2.a_ID FROM friendship f, User u1, User u2 WHERE ( u1.a_ID =" . $_SESSION['a_ID'] . " AND u2.a_ID <> " . $_SESSION['a_ID'] . " AND f.target = u1.a_ID AND f.starter = u2.a_ID) OR (f.target = u2.a_ID AND f.starter = u1.a_ID AND u1.a_ID = " . $_SESSION['a_ID'] . " AND u2.a_ID <>" . $_SESSION['a_ID'] . " );";
                            
                            $friends_result = mysqli_query($db, $friends_query);
                            if (!$friends_result) {
                                printf("Errorrr: %s\n", mysqli_error($db));
                                exit();
                            }
                            if (mysqli_num_rows($friends_result) > 0) {
                                while ($friends_row = mysqli_fetch_assoc($friends_result)) {
                                    $friend_id = $friends_row['a_ID'];
                                    $friend_name = $friends_row['nick_name'];

                                    echo "<div class='credit-card-info' style='
                                            border-style: solid;
                                            border-width: 1px;
                                            margin-top: 20px;
                                            padding: 10px;
                                            font-size: 20px;
                                            border-color: rgba(112,112,112,0.3);
                                            border-radius: 25px; display: flex;
                                            padding-left: 40px'>
                                            <div style='margin-left: 10px'>
                                                $friend_name
                                            </div>
                                            <div style='position: absolute; right: 1100px'>
                                                <a href='deletefriend.php?friend_id=" . $friend_id. "' style='color: inherit'>
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
                    </div>
                </div>
                </div>
                <hr style="margin-right: 2%">


                <div class="information-header" style="width: 30%">
                    <div style="font-family: Avenir; font-size: 48px ; margin-bottom: 1%">Followed Curators</div>
                    <hr style="margin-right: 10%">
                    <div class="friends-display">
                    <div style=" width = 40%;">
                        <?php
                            $friends_query = "SELECT u.nick_name, u.a_ID FROM followed_by f, User u WHERE f.c_ID = u.a_ID AND f.a_ID = " . $_SESSION[a_ID] . ";";
                            $friends_result = mysqli_query($db, $friends_query);
                            if (!$friends_result) {
                                printf("Errorrr: %s\n", mysqli_error($db));
                                exit();
                            }
                            if (mysqli_num_rows($friends_result) > 0) {
                                while ($friends_row = mysqli_fetch_assoc($friends_result)) {
                                    $friend_id = $friends_row['a_ID'];
                                    $friend_name = $friends_row['nick_name'];

                                    echo "<div class='credit-card-info' style='
                                            border-style: solid;
                                            border-width: 1px;
                                            margin-top: 20px;
                                            padding: 10px;
                                            font-size: 20px;
                                            border-color: rgba(112,112,112,0.3);
                                            border-radius: 25px; display: flex;
                                            padding-left: 40px'>
                                            <div style='margin-left: 10px'>
                                                $friend_name
                                            </div>
                                            <div style='position: absolute; right: 1100px'>
                                                <a href='deletefriend.php?curator_id=" . $friend_id. "' style='color: inherit'>
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
                    </div>
                </div>
                <hr style="margin-right: 2%">
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
    
        <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered" role="main" style="height: 400px; width: 800px;">
            <div class="modal-content" style="height: 650px; width: 800px; background-color: transparent; border: none; padding: 20px">
                <div class="modal-body" style="background-color: transparent; padding: 20px">
                    <div style="background-color: white; height: 650px; width: 600px; border-radius: 30px; border-color: rgba(112,112,112,1); border-style: solid; padding: 40px">
                        <div style="text-align: center; font-size: 32px; margin-top: 10px; margin-bottom: 20px">
                            Search User by Nick-name
                        </div>
                        <div style="align-items: center;">
                            <form id="search-user-form" method="post">
                                <div style="display: flex; font-size: 20px;">
                                    <div class="input-group" style="margin-bottom: 2%; margin-top: 4%; font-size: 20px;">
                                        <input id="search-value" type="text" class="form-control" name="game-name" placeholder="Game Name" style=" outline: none; font-size: 20px; border-style: solid; border-radius: 20px">
                                    </div>
                                    <div style="padding: 20px"></div>
                                </div>
                                <div class="form-group" style="margin-top: 5%; text-align: right">
                                    <input onclick="checkEmptyAndSearch()" type="button" class="btn btn-primary btn-lg" style="background-color: rgb(86, 188, 22); border-color: rgb(86, 188, 22); border-radius: 20px" value="  Search  ">
                                <?php
                                ?>
                                
                                </div>
                                <br><br>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script type="text/javascript">
    function checkEmptyAndSearch() {
        let searchVal = document.getElementById("search-val").value;
        if (searchVal === "" ) {
            alert("Make sure to fill the search field!");
        } else {
            let form = document.getElementById("search-form").submit();
                
        }
    }
    </script>
</body>

</html>