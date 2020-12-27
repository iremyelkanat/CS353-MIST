<?php
    include ("config.php");
    session_start();

    if (isset($_GET['friend_id'])) {
        $friend_id = $_GET['friend_id'];

        $delete_friend_query = "DELETE FROM friendship WHERE ( starter=" . $friend_id . " AND target=" . $_SESSION['a_ID'] . ") OR ( starter=" . $_SESSION['a_ID'] . " AND target= " . $friend_id . ");";
        $delete_friend_query_result = mysqli_query($db, $delete_friend_query);
        if (!$delete_friend_query_result) {
            printf("Error: %s\n", mysqli_error($db));
            exit();
        }
        echo "<script LANGUAGE='JavaScript'>
                    window.alert('Your friend has been deleted from your list! Redirecting...');
                    window.location.href = 'friends.php';
                </script>";
    }

    if (isset($_GET['curator_id'])) {
        $friend_id = $_GET['curator_id'];

        $delete_friend_query = "DELETE FROM followed_by WHERE (c_ID= " . $friend_id . " AND a_ID= " . $_SESSION['a_ID'] . ");";
        $delete_friend_query_result = mysqli_query($db, $delete_friend_query);
        if (!$delete_friend_query_result) {
            printf("Error: %s\n", mysqli_error($db));
            exit();
        }
        echo "<script LANGUAGE='JavaScript'>
                    window.alert('Previously followed curator has been deleted from your list! Redirecting...');
                    window.location.href = 'friends.php';
                </script>";
    }
?>
