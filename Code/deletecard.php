<?php
    include ("config.php");
    session_start();

    if (isset($_GET['card_id'])) {
        $card_id = $_GET['card_id'];

        $delete_card_query = "DELETE FROM Credit_Card WHERE card_ID =" . $card_id . ";";

        $delete_card_query_result = mysqli_query($db, $delete_card_query);
        if (!$delete_card_query_result) {
            printf("Error: %s\n", mysqli_error($db));
            exit();
        }
        echo "<script LANGUAGE='JavaScript'>
                    window.alert('Your card has been deleted successfully! Redirecing...');
                    window.location.href = 'addcreditcard.php';
                </script>";
    }


?>
