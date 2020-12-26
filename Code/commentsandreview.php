<?php
include("config.php");
session_start();

if (isset($_GET['game_id'])) {
    $a_id = $_SESSION["a_ID"];
    $game_id = $_GET['game_id'];
    echo $game_id;

    $game_query = "SELECT * FROM Video_Game Where g_id = " . $game_id . ";";
    $game_query_result = mysqli_query($db, $game_query);
    if (!$game_query_result) {
        printf("Error: %s\n", mysqli_error($db));
        exit();
    }
    $game_row = mysqli_fetch_assoc($game_query_result);

    $g_id = $game_row['g_ID'];
    $g_name = $game_row['g_name'];
    $g_version = $game_row['g_version'];
    $g_description = $game_row['g_description'];
    $g_image = $game_row['g_image'];
    $g_price = $game_row['g_price'];
    $genre = $game_row['genre'];
    $g_requirements = $game_row['g_requirements'];
}
if (isset($_POST['given_text'])) {
    $given_text = trim($_POST["given_text"]);
    $a_id = $_SESSION["a_ID"];
    $game_id = $_GET['game_id'];
    $date = date("Y/m/d");
    $insert_com_query = "INSERT INTO comments_on(a_ID, g_ID, date, text) VALUES ($a_id  , $game_id, $date, '$given_text' );";
    $insert_com_result = mysqli_query($db, $insert_com_query);
    if (!$insert_com_result) {
        printf("Error: %s\n", mysqli_error($db));
        printf("Error: 1");
        exit();
    }
    echo "<script LANGUAGE='JavaScript'>
                    window.alert('Your comment has been added successfully');
                </script>";
}
if (isset($_POST['rew_given_text'])) {
    $rew_given_text = trim($_POST["rew_given_text"]);
    $a_id = $_SESSION["a_ID"];
    $game_id = $_GET['game_id'];
    $date = date("Y/m/d");
    $insert_com_query = "INSERT INTO review(c_ID, g_ID,  text,date) VALUES ($a_id  , $game_id,'$rew_given_text', $date  );";
    $insert_com_result = mysqli_query($db, $insert_com_query);
    if (!$insert_com_result) {
        printf("Error: %s\n", mysqli_error($db));
        printf("Error: 1");
        exit();
    }
    echo "<script LANGUAGE='JavaScript'>
                    window.alert('Your review has been added successfully');
                </script>";
}
if (isset($_POST['rate_given_text'])) {
    $rew_given_text = trim($_POST["rate_given_text"]);
    $a_id = $_SESSION["a_ID"];
    $game_id = $_GET['game_id'];
    $date = date("Y/m/d");
    $insert_com_query = "INSERT INTO rates(a_ID, g_ID, value) VALUES ($a_id  , $game_id, $rew_given_text );";
    $insert_com_result = mysqli_query($db, $insert_com_query);
    if (!$insert_com_result) {
        printf("Error: %s\n", mysqli_error($db));
        printf("Error: 1");
        exit();
    }
    echo "<script LANGUAGE='JavaScript'>
                    window.alert('You Rated The Game');
                </script>";
}

if (isset($_POST['rew_Delete'])) {
    $a_id = $_SESSION["a_ID"];
    $game_id = $_GET['game_id'];
    $delete_query = "DELETE FROM review WHERE c_ID=" . $a_id . " AND g_ID=" . $game_id . ";";

    $delete_query_result = mysqli_query($db, $delete_query);
    if (!$delete_query_result) {
        printf("Error: %s\n", mysqli_error($db));
        exit();
    }



    echo "<script LANGUAGE='JavaScript'>
                window.alert('You successfully delete your review...');
            </script>";
}
if (isset($_POST['Delete'])) {
    $a_id = $_SESSION["a_ID"];
    $game_id = $_GET['game_id'];
    $delete_query = "DELETE FROM comments_on WHERE a_ID=" . $a_id . " AND g_ID=" . $game_id . ";";

    $delete_query_result = mysqli_query($db, $delete_query);
    if (!$delete_query_result) {
        printf("Error: %s\n", mysqli_error($db));
        exit();
    }



    echo "<script LANGUAGE='JavaScript'>
                window.alert('You successfully delete your comment...');
            </script>";
}
if (isset($_POST['return'])) {
    $delete_query = "DELETE FROM buys WHERE a_ID=" . $_SESSION['a_ID'] . " AND g_ID=" . $g_id . ";";

    $delete_query_result = mysqli_query($db, $delete_query);
    if (!$delete_query_result) {
        printf("Error: %s\n", mysqli_error($db));
        exit();
    }

    $update_wallet_query = "UPDATE Wallet w SET w.balance = w.balance + " . $g_price . " WHERE w.a_ID = " . $_SESSION['a_ID'] . ";";
    $update_wallet_result = mysqli_query($db, $update_wallet_query);
    if (!$update_wallet_result) {
        printf("Error: %s\n", mysqli_error($db));
        exit();
    }
    $a_id = $_SESSION["a_ID"];
    $game_id = $_GET['game_id'];
    $delete_query = "DELETE FROM comments_on WHERE a_ID=" . $a_id . " AND g_ID=" . $game_id . ";";

    $delete_query_result = mysqli_query($db, $delete_query);
    if (!$delete_query_result) {
        printf("Error: %s\n", mysqli_error($db));
        exit();
    }
    $delete_query = "DELETE FROM review WHERE c_ID=" . $a_id . " AND g_ID=" . $game_id . ";";

    $delete_query_result = mysqli_query($db, $delete_query);
    if (!$delete_query_result) {
        printf("Error: %s\n", mysqli_error($db));
        exit();
    }

    echo "<script LANGUAGE='JavaScript'>
                window.alert('You successfully returned from the Video Game...');
            </script>";
} elseif (isset($_POST['buy'])) {
    $get_balance_query = "SELECT balance FROM Wallet w WHERE w.a_ID=" . $_SESSION['a_ID'] . ";";
    $get_balance_query_result = mysqli_query($db, $get_balance_query);
    if (!$get_balance_query_result) {
        printf("Error: %s\n", mysqli_error($db));
        exit();
    }

    $get_balance_row = mysqli_fetch_assoc($get_balance_query_result);
    $user_balance = $get_balance_row['balance'];
    if ($user_balance < $g_price) {
        echo "<script type='text/javascript'>alert('Your balance is not sufficient.');</script>";
    } else {


        $insert_query = "INSERT INTO buys VALUES (" . $_SESSION['a_ID'] . ", " . $g_id . ", now());";
        $insert_query_result = mysqli_query($db, $insert_query);
        if (!$insert_query_result) {
            printf("Error: %s\n", mysqli_error($db));
            exit();
        }

        $update_wallet_query = "UPDATE Wallet w SET w.balance = w.balance - " . $g_price . " WHERE w.a_ID = " . $_SESSION['a_ID'] . ";";
        $update_wallet_result = mysqli_query($db, $update_wallet_query);
        if (!$update_wallet_result) {
            printf("Error: %s\n", mysqli_error($db));
            exit();
        }
        echo "<script LANGUAGE='JavaScript'>
                window.alert('You successfully bought the video game...');
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
                <a class="nav-item nav-link active">Store</a>
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
                    <div style="font-family: Avenir; font-size: 48px;">Video Game</div>
                    <div style=" width: 420px; text-align: right; margin-top: 10px" ;>
                        <?php
                        $has_query = "SELECT COUNT(*) as has_count FROM buys b WHERE b.a_ID=" . $_SESSION['a_ID'] . " AND b.g_id = " . $g_id . ";";
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
                            echo "<input type='submit' name='return' onclick='' class='btn btn-primary btn-lg' 
                            style='font-family: Avenir;
                             width: 100%; 
                             background-color: rgb(234, 124, 137); 
                             border-color: rgb(234, 124, 137); 
                             border-radius: 20px' value='Return'>";
                            echo "</form>";
                        } else {
                            echo "<form method='post'>";
                            echo "<input type='submit' name='buy' onclick='' class='btn btn-primary btn-lg' 
                            style='font-family: Avenir; 
                            width: 100%; background-color: rgb(93, 239, 132); 
                            border-color: rgb(93, 239, 132); 
                            border-radius: 20px' value='Buy " . $g_price . "TL'>";
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
                     $has_query = "SELECT SUM(r.value) as has_count , COUNT(r.value) as com FROM rates r WHERE  r.g_ID = " . $g_id . ";";
                     $has_query_result = mysqli_query($db, $has_query);

                     if (!$has_query_result) {
                         printf("Error: %s\n", mysqli_error($db));

                         exit();
                     }
                     $has_row = mysqli_fetch_assoc($has_query_result);
                     $has_count = $has_row['has_count'];
                     $com = $has_row['com'];
                     if($com == 0){
                        $com = 1;
                     }
                     else{
                        $com = $has_row['com'];
                     }
                     $has_count = $has_count / $com;
                     $has_query = "SELECT COUNT(*) as has_count FROM install i WHERE  i.g_id = " . $g_id . ";";
                        $has_query_result = mysqli_query($db, $has_query);

                        if (!$has_query_result) {
                            printf("Error: %s\n", mysqli_error($db));

                            exit();
                        }
                        $has_row = mysqli_fetch_assoc($has_query_result);
                        $down = $has_row['has_count'];
                
                    echo "<div class='game-name'; style='margin-top: 20px;'>
                            <span style='font-weight: bold'>Game Name: </span> " . $g_name . "
                        </div>
                        <div class='game-description'; style='margin-top: 20px;'>
                            <span style='font-weight: bold'>Game Description: </span> " . $g_description . "
                        </div>
                        <div class='game-genre'; style='margin-top: 20px;'>
                            <span style='font-weight: bold'>Genre: </span> " . $genre . "
                        </div>
                        <div class='package-duration' style='margin-top: 20px;'>
                            <span style='font-weight: bold'>Downloaded: </span> " . $down . "
                        </div>
                        <div class='package-duration' style='margin-top: 20px;'>
                            <span style='font-weight: bold'>Rate: </span> ".$has_count."
                             
                        </div>";
                        $a_id = $_SESSION["a_ID"];
                        $has_query = "SELECT COUNT(*) AS has_count FROM rates r WHERE r.a_ID = ". $a_id ." AND r.g_ID = " . $g_id . ";";
                     $has_query_result = mysqli_query($db, $has_query);

                     if (!$has_query_result) {
                         printf("Error: %s\n", mysqli_error($db));

                         exit();
                     }
                     $has_row = mysqli_fetch_assoc($has_query_result);
                     $co_rate = $has_row['has_count'];
                     $has_query = "SELECT COUNT(*) AS has_count FROM buys b WHERE b.a_ID = " . $a_id . " AND b.g_ID = " . $g_id . ";";
                     $has_query_result = mysqli_query($db, $has_query);
 
                     if (!$has_query_result) {
                         printf("Error: %s\n", mysqli_error($db));
 
                         exit();
                     }
                     $has_row = mysqli_fetch_assoc($has_query_result);
                     $is_buy = $has_row['has_count'];
                     if ( $is_buy > 0 && $co_rate < 1) {
                            echo "<form id='create-rate-form' method='post'>
                            <div class='input-group' >
                        <input id='rate_given_text' type='number' class='form-control' name='rate_given_text' placeholder='Rate' style='  margin-right: 80%;outline: none; font-size: 20px; border-style: solid; border-radius: 20px'>
                    </div>
                    <div class='form-group' style='text-align: left; margin-top: 10px'>
                        <input onclick='checkEmptyAndCreateRate()' type='button' class='btn btn-primary btn-lg' style='background-color: rgb(86, 188, 22); border-color: rgb(86, 188, 22); border-radius: 20px' value='     Rate     '>
                    </div>
                </form>
                            
                            ";
                        }
                        
                    ?>
                </div>
            </div>
            <div style="justify-content:space-around; display: flex; margin:auto; margin-top: 20px;">
                <div style=" margin-right: 200px ;float: left; width: 420px; text-align: left" ;>
                    <div class="btn btn-primary btn-lg" style="width: 100%; 
                  background-color: rgb(256, 256, 256); 
                  border-color: rgba(112,112,112,0.3);
                  border-radius: 20px">
                        <?php
                        echo " <a href='videogame.php?game_id=" . $game_id . "'>
                        <div style='text-decoration:none;color: black '>
                        <span>Abouts</span>
                        </div>

                  
                  </a>";
                        ?>
                    </div>
                </div>
                <div style="  margin-left: 200px;  float: right; width: 420px; text-align: right" ;>
                    <div class="btn btn-primary btn-lg" style="width: 100%; 
                  background-color: rgb(126, 166, 234); 
                  border-color: rgb(126, 166, 234);
                  border-radius: 20px">
                        <?php
                        echo " <a href='commentsandreview.php?game_id=" . $game_id . "'>
                        <div style='text-decoration:none;color: white '>
                        <span>Comments & Reviews</span>
                        </div>

                  
                  </a>";
                        ?>
                    </div>
                </div>
                <div style="  margin-left: 200px;  float: right; width: 420px; text-align: right" ;>
                    <div class="btn btn-primary btn-lg" style="width: 100%; 
                  background-color: rgb(256, 256, 256); 
                  border-color: rgba(112,112,112,0.3);
                  border-radius: 20px">
                        <?php
                        echo " <a href='modsvideo.php?game_id=" . $game_id . "'>
                        <div style='text-decoration:none;color:black '>
                        <span>Mods</span>
                        </div>

                  
                  </a>";
                        ?>
                    </div>
                </div>

            </div>
            <div style="font-family: Avenir; font-size: 24px; margin-top: 10px">Reviews</div>
            <hr style="margin-top: 25px; margin-bottom: 10px;margin-top: 10px;">
            <?php
            $game_id = $_GET['game_id'];
            $a_id = $_SESSION["a_ID"];
            $comments_query = "SELECT * FROM Curator c, buys b WHERE c.a_ID = " . $a_id . " AND b.a_ID = " . $a_id . " AND b.g_ID = " . $game_id . " ;";


            $comments_query_results = mysqli_query($db, $comments_query);
            if (!$comments_query_results) {
                printf("Error: %s\n", mysqli_error($db));

                exit();
            }
            $comment_row = mysqli_fetch_assoc($comments_query_results);
            $pass = $comment_row['a_ID'];
            $comments_query = "SELECT COUNT(*) AS c_review FROM  review r WHERE r.c_ID = " . $a_id . "  AND r.g_ID = " . $game_id . " ;";


            $comments_query_results = mysqli_query($db, $comments_query);
            if (!$comments_query_results) {
                printf("Error: %s\n", mysqli_error($db));

                exit();
            }
            $comment_row = mysqli_fetch_assoc($comments_query_results);
            $count_re = $comment_row['c_review'];
            if ($a_id == $pass && $count_re < 1) {
                echo "
            <div class='create-column' >
            <form id='create-review-form' method='post'  >
                <div class='input-group' style =' width:1000px '>
                    <input id='rew_given_text' type='text' class='form-control' name='rew_given_text' placeholder='Leave Review' style=' width: 10px;  outline: none; font-size: 20px; border-style: solid; border-radius: 20px'>
                    
                    
                    <div class='form-group' style='text-align: left; margin-left: 10px;margin-top: 0.1px'>
                    <input onclick='checkEmptyAndCreateReview()' type='button' class='btn btn-primary btn-lg' style='background-color: rgb(86, 188, 22); border-color: rgb(86, 188, 22); border-radius: 20px' value='     Leave Review     '>
                </div>
                </div>
                
            </form>
            </div>

            ";
            }
            echo "<hr style='margin-top: 10px; margin-bottom: 20px;margin-top: 10px;'>";
            $review_query = "SELECT * FROM review r, User u WHERE r.c_ID = u.a_ID AND r.g_ID= " . $game_id . ";";

            $review_query_results = mysqli_query($db, $review_query);
            if (!$review_query_results) {
                printf("Error: %s\n", mysqli_error($db));

                exit();
            }
            if (mysqli_num_rows($review_query_results) > 0) {
                while ($comment_row = mysqli_fetch_assoc($review_query_results)) {
                    $com_a_id = $comment_row['a_ID'];
                    $usr_name = $comment_row['u_name'];
                    $com_g_name = $comment_row['g_ID'];
                    $com_date = $comment_row['date'];
                    $com_text = $comment_row['text'];
                    if ($a_id == $com_a_id) {
                        
                        echo "<div style =' display: flex'>
                        <div >
                        <div class='game-date'; style='margin-top: 20px; margin-bottom:20px;'>
                                 <span style='font-weight: bold'>By: </span> " . $usr_name . "
                                 </div>
                                 <div class='comments_out'; style='margin-top: 20px;'>
                                 <span style='font-weight: bold'> Review: </span> " . $com_text . " </div>
                                 <div class='game-date'; style='margin-top: 20px;'>
                                 <span style='font-weight: bold'>Date: </span> " . $com_date . "
                                 </div>
                        </div>
                        
                                 <form method='post'> 
                            <input type='submit' 
                                     name='rew_Delete' onclick='' class='btn btn-primary btn-lg' 
                                     style='font-family: Avenir; 
                                     width: 100px; background-color: rgb(234, 124, 137); 
                                     border-color: rgb(234, 124, 137); 
                                     border-radius: 20px' value='Delete'>
                        </form>
                        
                        </div>
                        ";
                        
                    echo "<hr style='margin-top: 25px; margin-bottom: 50px;margin-top: 20px;'>";
                    }
                else{
                    echo "<div class='game-date'; style='margin-top: 20px; margin-bottom:20px;'>
                    <span style='font-weight: bold'>By: </span> " . $usr_name . "
                    </div>
                    <div class='comments_out'; style='margin-top: 20px;'>
                    <span style='font-weight: bold'> Review: </span> " . $com_text . " </div>
                    <div class='game-date'; style='margin-top: 20px;'>
                    <span style='font-weight: bold'>Date: </span> " . $com_date . "
                    </div> ";
       echo "<hr style='margin-top: 25px; margin-bottom: 50px;margin-top: 20px;'>";
                }
                    
                }
            }
            ?>

            <div style="font-family: Avenir; font-size: 24px; margin-top: 10px">Comments</div>
            <?php
            $game_id = $_GET['game_id'];
            $a_id = $_SESSION["a_ID"];
            $comments_query = "SELECT * FROM buys b WHERE b.a_ID = " . $a_id . " AND b.g_id = " . $game_id . ";";

            $comments_query_results = mysqli_query($db, $comments_query);
            if (!$comments_query_results) {
                printf("Error: %s\n", mysqli_error($db));

                exit();
            }
            $comment_row = mysqli_fetch_assoc($comments_query_results);
            $pass = $comment_row['a_ID'];

            $comments_query = "SELECT COUNT(*) AS c_review FROM  comments_on c WHERE c.a_ID = " . $a_id . "  AND c.g_ID = " . $game_id . " ;";


            $comments_query_results = mysqli_query($db, $comments_query);
            if (!$comments_query_results) {
                printf("Error: %s\n", mysqli_error($db));

                exit();
            }
            $comment_row = mysqli_fetch_assoc($comments_query_results);
            $count_re = $comment_row['c_review'];

            if ($a_id == $pass && $count_re < 1) {
                echo "<hr style='margin-top: 10px; margin-bottom: 10px;'>";
            echo "<div class='create-column'>
            <form id='create-comment-form' method='post'>
                <div class='input-group' style =' width:1000px '>
                    <input id='given_text' type='text' class='form-control' name='given_text' placeholder='Leave Comment' style=' outline: none; font-size: 20px; border-style: solid; border-radius: 20px'>
                    <div class='form-group' style='text-align: left; left; margin-left: 10px;margin-top: 0.1px'>
                    <input onclick='checkEmptyAndCreateComment()' type='button' class='btn btn-primary btn-lg' style='background-color: rgb(86, 188, 22); border-color: rgb(86, 188, 22); border-radius: 20px' value='     Leave Comment     '>
                </div>
                    </div>
                    
            </form>
            </div>

            ";
            }
            

            $comments_query = "SELECT * FROM comments_on c, User u WHERE c.a_ID = u.a_ID AND c.g_ID= " . $game_id . ";";
            $comments_query_results = mysqli_query($db, $comments_query);
            if (!$comments_query_results) {
                printf("Error: %s\n", mysqli_error($db));

                exit();
            }
            echo "<hr style='margin-top: 10px; margin-bottom: 20px;margin-top: 10px;'>";

            if (mysqli_num_rows($comments_query_results) > 0) {
                while ($comment_row = mysqli_fetch_assoc($comments_query_results)) {
                    $com_a_id = $comment_row['a_ID'];
                    $usr_name = $comment_row['u_name'];
                    $com_g_name = $comment_row['g_ID'];
                    $com_date = $comment_row['date'];
                    $com_text = $comment_row['text'];
                    if ($a_id == $com_a_id) {
                        echo "<div style =' display: flex'>
                        <div >
                        <div class='game-date'; style='margin-top: 20px; margin-bottom:20px;'>
                                 <span style='font-weight: bold'>By: </span> " . $usr_name . "
                                 </div>
                                 <div class='comments_out'; style='margin-top: 20px;'>
                                 <span style='font-weight: bold'> Comment: </span> " . $com_text . " </div>
                                 <div class='game-date'; style='margin-top: 20px;'>
                                 <span style='font-weight: bold'>Date: </span> " . $com_date . "
                                 </div>
                        </div>
                        
                                 <form method='post'> 
                            <input type='submit' 
                                     name='Delete' onclick='' class='btn btn-primary btn-lg' 
                                     style='font-family: Avenir; 
                                     width: 100px; background-color: rgb(234, 124, 137); 
                                     border-color: rgb(234, 124, 137); 
                                     border-radius: 20px' value='Delete'>
                        </form>
                        
                        </div>
                        ";
                
                    }
                    
                else{
                    echo "<div class='game-date'; style='margin-top: 20px; margin-bottom:20px;'>
                    <span style='font-weight: bold'>By: </span> " . $usr_name . "
                    </div>
                    <div class='comments_out'; style='margin-top: 20px;'>
                    <span style='font-weight: bold'> Comments: </span> " . $com_text . " </div>
                    <div class='game-date'; style='margin-top: 20px;'>
                    <span style='font-weight: bold'>Date: </span> " . $com_date . "
                    </div> ";
            echo "<hr style='margin-top: 25px; margin-bottom: 50px;margin-top: 20px;'>";
        
                }
                    }
            }



            ?>
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

            function checkEmptyAndCreateComment() {
                let giv_text = document.getElementById("given_text").value;
                if (giv_text === "") {
                    alert("Make sure to fill all fields!");
                } else {
                    let form = document.getElementById("create-comment-form").submit();
                }
            }

            function checkEmptyAndCreateReview() {
                let giv_text = document.getElementById("rew_given_text").value;
                if (giv_text === "") {
                    alert("Make sure to fill all fields!");
                } else {
                    let form = document.getElementById("create-review-form").submit();
                }
            }
            function checkEmptyAndCreateRate() {
                let giv_int = document.getElementById("rate_given_text").value;
                if (!giv_int && giv_int > 5) {
                    alert("Make sure to fill all fields!");
                }
                 else if (giv_int > 5) {
                    alert("Rate should not be higher than 5");
                } else {
                    let form = document.getElementById("create-rate-form").submit();
                }
            }
            
        </script>
</body>

</html>