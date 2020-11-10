<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8" />
        <title>Билеты</title>
        <link rel="stylesheet" href="styles.css" />
        <script src="script.js"></script>
    </head>
    
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
            $src = mysqli_query($db, 'INSERT INTO STP_TICKETS (NAME) VALUES (' . $name . ')');
        } else if ($id == "2") {
           $name = $_REQUEST['name'];
           $fid = $_REQUEST['fid'];
           $src = mysqli_query($db, 'UPDATE STP_TICKETS SET NAME = ' . $name . ' WHERE ID = ' . $fid);
        } else if ($id == "3") {
           $fid = $_REQUEST['fid'];
           $src = mysqli_query($db, 'DELETE FROM STP_TICKETS WHERE ID = ' . $fid);
        }
    }
    $src = mysqli_query($db, 'SELECT * FROM STP_TICKETS ORDER BY ID ASC');
    $res = mysqli_fetch_all($src, MYSQLI_ASSOC);
    $src = mysqli_query($db, 'SELECT ID FROM STP_TICKETS ORDER BY ID ASC');
    $ids = mysqli_fetch_all($src, MYSQLI_ASSOC);
?>

    <body>
        <h1>Билеты</h1>
        <table id="tbl_films" border="1" width="500px" style="float:left; margin-left:10px;">
            <tr><th>Номер</th><th>Название</th></tr>
            <?php 
                for($i = 0; $i < count($res); $i++) {
                    echo "<tr>";
                        echo "<td>" . $res[$i]["ID"] . "</td>";
                        echo "<td>" . $res[$i]["NAME"] . "</td>";
                    echo "</tr>";
                }
            ?>  
        </table>
        <div style="float: left; margin-left:15px;">
            <button id="add" onclick="change_to_input_form('add', 'hidden')">Добавить</button>
            <span id="hidden">
                <input id="txt" type="text" width="100px" name="name" />
                <input type="submit" value="Подтвердить" onclick="ajax(1, 'txt', null, 'get_tickets.php')" />
                <button id="cancel" onclick="change_to_button('add', 'hidden', 'txt')">Отмена</button>
            </span><br /><br />
            <button id="edit" onclick="change_to_input_form('edit', 'hidden2')">Редактировать</button>
            <span id="hidden2">
                <select id="sel">
                    <?php 
                        for ($i = 0; $i < count($ids); $i++) {
                            echo "<option>". $ids[$i]["ID"] . "</option>";
                        }
                    ?>
                </select>
                <input id="txt2" type="text" width="100px" name="name" />
                <input type="submit" value="Подтвердить" onclick="ajax(2, 'txt2', 'sel', 'get_tickets.php')"/>
                <button id="cancel" onclick="change_to_button('edit', 'hidden2', 'txt2')">Отмена</button>
            </span><br /><br />
            <button id="remove" onclick="change_to_input_form('remove', 'hidden3')">Удалить</button>
            <span id="hidden3">
                <select id="sel1">
                    <?php 
                        for ($i = 0; $i < count($ids); $i++) {
                            echo "<option>". $ids[$i]["ID"] . "</option>";
                        }
                    ?>
                </select>
                <input type="submit" value="Подтвердить" onclick="ajax(3, null, 'sel1', 'get_tickets.php')"/>
                <button id="cancel" onclick="change_to_button('remove', 'hidden3')">Отмена</button>
            </span><br /><br />
        </div>
    </body>
</html>