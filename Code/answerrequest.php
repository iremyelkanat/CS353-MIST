<?php
    include ("config.php");
    session_start();

    if (isset($_GET['r_ID'])) {
        $req_id = $_GET['r_ID'];
        $state = $_GET['state'];

        $req_query = "UPDATE takes SET state='$state' WHERE r_ID=" . $req_id . ";";

        $req_query_result = mysqli_query($db, $req_query);
        if (!$req_query_result) {
            printf("Error: %s\n", mysqli_error($db));
            exit();
        }
        if($state === "Approved"){
            echo "<script LANGUAGE='JavaScript'>
                    window.alert('Game is approved successfully! Redirecting...');
                    window.location.href = 'requests.php';
                </script>";
        }else if ($state === "Declined"){
            echo "<script LANGUAGE='JavaScript'>
                    window.alert('Game is declined successfully! Redirecting...');
                    window.location.href = 'requests.php';
                </script>";
        }
    }
?>