<?php
$db = mysqli_connect('localhost', 'root', '', 'stp');
    mysqli_set_charset($db, 'utf8');
    if (!$db) {
        $e = mysqli_error();
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }
    $src = null;
    if (isset($_REQUEST["id"])) {
        $id = $_REQUEST["id"]; 
        if ($id == "1") {
            $name = $_REQUEST["name"];
            $src = mysqli_query($db, 'INSERT INTO STP_BOOKINGS (NAME) VALUES (' . $name . ')');
        } else if ($id == "2") {
           $name = $_REQUEST['name'];
           $fid = $_REQUEST['fid'];
           $src = mysqli_query($db, 'UPDATE STP_BOOKINGS SET NAME = ' . $name . ' WHERE ID = ' . $fid);
        } else if ($id == "3") {
           $fid = $_REQUEST['fid'];
           $src = mysqli_query($db, 'DELETE FROM STP_BOOKINGS WHERE ID = ' . $fid);
        }
    }
    $src = mysqli_query($db, 'SELECT * FROM STP_BOOKINGS ORDER BY ID ASC');
    $res = mysqli_fetch_all($src, MYSQLI_ASSOC);
    echo json_encode($res);
   
?>