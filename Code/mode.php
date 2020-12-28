<?php
include("config.php");
session_start();

if (isset($_GET['mode_ID'])) {
    $mode_id = $_GET['mode_ID'];

    $mode_query = "SELECT  u.u_name, u.a_ID, vg.g_name, m.m_name, m.m_description, m.m_size FROM User u, Video_Game vg, Mode m, for_m f, builds b WHERE  f.g_ID = vg.g_ID AND u.a_ID = b.a_ID AND b.m_ID =" . $mode_id. " AND f.m_ID =" . $mode_id. " AND m.m_ID =" . $mode_id.  ";";
    $mode_query_result = mysqli_query($db, $mode_query);
    if (!$mode_query_result) {
        printf("Error: %s\n", mysqli_error($db));
        exit();
    }
    $mode_row = mysqli_fetch_assoc($mode_query_result);

    $mode_name = $mode_row['m_name'];
    $mode_description = $mode_row['m_description'];
    $mode_size = $mode_row['m_size'];
    $mode_creator = $mode_row['u_name'];
    $mode_game = $mode_row['g_name'];
    $creator_id = $mode_row['a_ID'];
}

if (isset($_POST['uninstall'])) {
    $delete_query = "DELETE FROM downloads WHERE a_ID=" . $_SESSION['a_ID'] . " AND m_ID=" . $mode_id . ";";

    $delete_query_result = mysqli_query($db, $delete_query);
    if (!$delete_query_result) {
        printf("Error: %s\n", mysqli_error($db));
        exit();
    }

    echo "<script LANGUAGE='JavaScript'>
                window.alert('You successfully uninstalled the Mode...');
            </script>";
} 
elseif (isset($_POST['download'])) {

    $insert_query = "INSERT INTO downloads VALUES (". $mode_id .", " . $_SESSION['a_ID'] . ");";
    $insert_query_result = mysqli_query($db, $insert_query);
    if (!$insert_query_result) {
            printf("Error: %s\n", mysqli_error($db));
            exit();
        }
        echo "<script LANGUAGE='JavaScript'>
                window.alert('You successfully downloaded the mode...');
            </script>";
}
elseif (isset($_POST['delete'])) {

    $delete_query = "DELETE FROM Mode WHERE m_id =" . $mode_id . ";";
    $delete_query_result = mysqli_query($db, $delete_query);
    if (!$delete_query_result) {
            printf("Error: %s\n", mysqli_error($db));
            exit();
        }
        echo "<script LANGUAGE='JavaScript'>
                window.alert('You successfully deleted the mode...');
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
                <?php
                if ($_SESSION['type'] === "user") {
                    echo "<a href='userhome.php' class='nav-item nav-link'>Home</a>";
                } else {
                    echo "<a href='curatorhome.php' class='nav-item nav-link'>Home</a>";
                }
                ?>
                <a href="store.php" class="nav-item nav-link">Store</a>
                <a href="library.php" class="nav-item nav-link">Library</a>
                <a href="modes.php" class="nav-item nav-link">Modes</a>
                <a href="friends.php" class="nav-item nav-link">Friends</a>
            </div>
            <div class="navbar-nav ml-auto">
                <a class="nav-item nav-link" href="logout.php">Logout</a>
            </div>
        </nav>
        <div class="main-div" style="padding-left: 2%; padding-right: 2%; padding-top: 2%; padding-bottom: 1%">
            <div class="information-header" style="width: 100%">
                <div style="display: flex; justify-content: space-between">
                    <div style="font-family: Avenir; font-size: 48px;">Mode</div>
                    <div style=" width: 420px; text-align: right; margin-top: 10px" ;>
                        <?php
                        $has_query = "SELECT COUNT(*) as has_count FROM downloads b WHERE b.a_ID=" . $_SESSION['a_ID'] . " AND b.m_id = " . $mode_id . ";";
                        $has_query_result = mysqli_query($db, $has_query);


                        if (!$has_query_result) {
                            printf("Error: %s\n", mysqli_error($db));

                            exit();
                        }
                        $has_row = mysqli_fetch_assoc($has_query_result);
                        $has_count = $has_row['has_count'];
                        $down = $has_count;
                        if ($has_count > 0) {
                            echo "<form method='post'>";
                            echo "<input type='submit' name='uninstall' onclick='' class='btn btn-primary btn-lg' 
                            style='font-family: Avenir;
                             width: 100%; 
                             background-color: rgb(234, 124, 137); 
                             border-color: rgb(234, 124, 137); 
                             border-radius: 20px' value='Uninstall'>";
                            echo "</form>";
                        } else {
                            echo "<form method='post'>";
                            echo "<input type='submit' name='download' onclick='' class='btn btn-primary btn-lg' 
                            style='font-family: Avenir; 
                            width: 100%; 
                            background-color: rgb(93, 239, 132); 
                            border-color: rgb(93, 239, 132); 
                            border-radius: 20px' 
                            value='Download'>";
                            echo "</form>";
                        }


                        if( $creator_id === $_SESSION['a_ID']) { 

                            echo "<form method='post'>";
                            echo "<input type='submit' name='delete' onclick='' class='btn btn-primary btn-lg' 
                            style='font-family: Avenir; 
                            width: 100%; 
                            background-color: rgb(234, 124, 137); 
                            border-color: rgb(93, 239, 132); 
                            border-radius: 20px' 
                            value='Delete'>";
                            echo "</form>";

                        }


                        ?>
                    </div>
                </div>
                <hr style="margin-right: 60%">
            </div>
            <div class="package-details" style="width: 100%; display: flex;">
                <div class="package-details-p1" style="width: 50%">
                    <div style=" display: inline-block; float:none; position: relative; vertical-align: middle; margin-top: 10%">
                        <img src="../Assets/images/package.jpeg" />
                    </div>
                </div>
                <div class="game-details-p2" style="width: 50%; font-family: Avenir; font-size: 24px">
                    <?php
                    echo "<div class='game-name'; style='margin-top: 20px;'>
                            <span style='font-weight: bold'>Mode Name: </span> " . $mode_name . "
                        </div>
                        <div class='game-description'; style='margin-top: 20px;'>
                            <span style='font-weight: bold'>Mode Built for: </span> " . $mode_game . "
                        </div>
                        <div class='game-description'; style='margin-top: 20px;'>
                            <span style='font-weight: bold'>Mode Built By: </span> " . $mode_creator . "
                        </div>
                        
                        <div class='game-genre'; style='margin-top: 20px;'>
                            <span style='font-weight: bold'>Mode Description: </span> " . $mode_description . "
                        </div>
                        <div class='package-duration' style='margin-top: 20px;'>
                            <span style='font-weight: bold'>Mode Size: </span> " . $mode_size . "
                        </div>
                        ";
                    ?>
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
        </script>
</body>

</html>

