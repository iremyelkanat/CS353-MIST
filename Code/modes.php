<?php
    include("config.php");
    session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="width=device-width, initial-scale=1.0" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MIST - Modes</title>
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
                <a href="library.php" class="nav-item nav-link ">Library</a>
                <a class="nav-item nav-link active">Modes</a>
                <a href="friends.php" class="nav-item nav-link">Friends</a>
            </div>
            <div class="navbar-nav ml-auto">
                <a class="nav-item nav-link" href="logout.php">Logout</a>
            </div>
        </nav>
        <div class="main-div"
            style="display: flex; padding-left: 2%; padding-right: 2%; padding-top: 2%; padding-bottom: 1%">
            <div class="information-header" style="width: 100%">
                <div style="font-family: Avenir; font-size: 48px ; margin-bottom: 2%">Modes</div>
                <hr style="margin-right: 20%">
                <div class="mods-to-download-display">
                <div style=" overflow-x: scroll; white-space: nowrap;">
                    <div style="font-family: Avenir; font-size: 25px ; font-weight: bold; margin-bottom: 2%">Games to Build Mode For</div>
                    <?php
                    $mods_tobuild_query = "SELECT v.g_name, v.g_image, v.g_ID FROM install b, Video_Game v WHERE b.g_ID=v.g_ID AND b.a_ID =" . $_SESSION['a_ID'] . ";";
                    $mods_tobuild_result = mysqli_query($db, $mods_tobuild_query);
                    if (!$mods_tobuild_result) {
                        printf("Error: %s\n", mysqli_error($db));
                        exit();
                    }
                    if (mysqli_num_rows($mods_tobuild_result) > 0) {
                        while ($games__bought_row = mysqli_fetch_assoc($mods_tobuild_result)) {
                            $game_id = $games__bought_row['g_ID'];
                            $game_name = $games__bought_row['g_name'];

                            echo "<a href='videogame.php?game_id=". $game_id ."'>
                                <div style='display: inline-block; float:none; position: relative'>
                                    <img src='../Assets/images/package.jpeg'/>
                                    <h3 style='font-weight: lighter; font-family: Avenir; font-size: 24px; color: white ; padding-left: 20px; padding-right: 20px; padding-bottom: 10px; padding-top: 10px; position: absolute; background-color: rgb(90,90,90); border-style: solid; border-radius: 30px; border-color: rgb(90,90,90); bottom: 8px; left: 16px;'>". $game_name ."</h3>
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
            <div class="mods_downloaded_display">
                <div style=" overflow-x: scroll; white-space: nowrap;">
                    <div style="font-family: Avenir; font-size: 25px; font-weight: bold; margin-bottom: 2%">Modes Downloaded</div>
                    <?php
                        $mods_downloaded_query = "SELECT d.m_ID, m.m_name FROM downloads d, Mode m WHERE m.m_ID = d.m_ID AND d.a_ID =" . $_SESSION['a_ID'] . ";";
                        $mods_downloaded_result = mysqli_query($db, $mods_downloaded_query);        
                        if (!$mods_downloaded_result) {
                            printf("Error: %s\n", mysqli_error($db));
                            exit();
                        }
                        if (mysqli_num_rows($mods_downloaded_result) > 0) {
                            while ($modes_row = mysqli_fetch_assoc($mods_downloaded_result)) {
                                $mode_id = $modes_row['m_ID'];
                                $mode_name = $modes_row['m_name'];

                                echo "<a href='mode.php?package_id=". $mode_id ."'>
                                <div style='display: inline-block; float:none; position: relative'>
                                    <img src='../Assets/images/package.jpeg'/>
                                    <h3 style='font-weight: lighter; font-family: Avenir; font-size: 24px; color: white ; padding-left: 20px; padding-right: 20px; padding-bottom: 10px; padding-top: 10px; position: absolute; background-color: rgb(90,90,90); border-style: solid; border-radius: 30px; border-color: rgb(90,90,90); bottom: 8px; left: 16px;'>". $package_name ."</h3>
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
            <div class="modes-built-display">
                <div style=" overflow-x: scroll; white-space: nowrap;">
                <div style="font-family: Avenir; font-size: 25px; font-weight: bold; margin-bottom: 2%">Modes Built</div>
                    <?php
                    $modes_built_query = "SELECT m.m_ID, m.m_name FROM builds b, Mode m WHERE m.m_ID = b.m_ID AND b.a_ID =" . $_SESSION['a_ID'] . ";";
                    $modes_built_result = mysqli_query($db, $modes_built_query);
                    if (!$modes_built_result) {
                        printf("Error: %s\n", mysqli_error($db));
                        exit();
                    }
                    if (mysqli_num_rows($modes_built_result) > 0) {
                        while ($modes_built_row = mysqli_fetch_assoc($modes_built_result)) {
                            $mode_id = $modes_built_row['m_ID'];
                            $mode_name = $modes_built_row['m_name'];

                            echo "<a href='mode.php?game_id=". $mode_id ."'>
                                <div style='display: inline-block; float:none; position: relative'>
                                    <img src='../Assets/images/package.jpeg'/>
                                    <h3 style='font-weight: lighter; font-family: Avenir; font-size: 24px; color: white ; padding-left: 20px; padding-right: 20px; padding-bottom: 10px; padding-top: 10px; position: absolute; background-color: rgb(90,90,90); border-style: solid; border-radius: 30px; border-color: rgb(90,90,90); bottom: 8px; left: 16px;'>". $game_name ."</h3>
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
                if (fullNameVal === "" || passwordVal === "" || nickNameVal === "" || emailVal === "" |
                    phoneNumberVal === "") {
                    alert("Make sure to fill all fields!");
                } else {
                    let form = document.getElementById("login-form").submit();
                }
            }
            </script>
        </div>
</body>

</html>