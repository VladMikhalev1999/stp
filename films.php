<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8" />
        <title>Фильмы</title>
        <link rel="stylesheet" href="styles.css" />
        <script src="script.js"></script>
    </head>
    
<?php
    $db = oci_connect('MIVR_19', 'SomePassword_123', 'oti.ru:1521/alfa', 'UTF8');
    if (!$db) {
        $e = oci_error();
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }
    $src = null;
    if (isset($_REQUEST["id"])) {
        $id = $_REQUEST["id"]; 
        if ($id == "1") {
            $name = $_REQUEST["name"];
            $src = oci_parse($db, 'INSERT INTO STP_FILMS VALUES (STP_FILM.nextval, \'' . $name . '\')');
        } else if ($id == "2") {
           $name = $_REQUEST['name'];
           $fid = $_REQUEST['fid'];
           $src = oci_parse($db, 'UPDATE STP_FILMS SET NAME = \'' . $name . '\' WHERE ID = ' . $fid);
        } else if ($id == "3") {
           $fid = $_REQUEST['fid'];
           $src = oci_parse($db, 'DELETE FROM STP_FILMS WHERE ID = ' . $fid);
        }
        oci_execute($src);
    }
    $src = oci_parse($db, 'SELECT * FROM "STP_FILMS" ORDER BY ID ASC');
    oci_execute($src);
    oci_fetch_all($src, $res);
    
    $src = oci_parse($db, 'SELECT ID FROM "STP_FILMS" ORDER BY ID ASC');
    oci_execute($src);
    oci_fetch_all($src, $ids);
?>

    <body>
        <h1>Фильмы</h1>
        <table border="1" width="500px" style="float:left; margin-left:10px;">
            <tr><th>Номер</th><th>Название</th></tr>
            <?php 
                for($i = 0; $i < count($res["ID"]); $i++) {
                    echo "<tr>";
                        echo "<td>" . $res["ID"][$i] . "</td>";
                        echo "<td>" . $res["NAME"][$i] . "</td>";
                    echo "</tr>";
                }
            ?>  
        </table>
        <div style="float: left; margin-left:15px;">
            <button id="add" onclick="change_to_input_form('add', 'hidden')">Добавить</button>
            <span id="hidden">
                <input id="txt" type="text" width="100px" name="name" />
                <input type="submit" value="Подтвердить" onclick="append_request(1, 'txt')"/>
                <button id="cancel" onclick="change_to_button('add', 'hidden', 'txt')">Отмена</button>
            </span><br /><br />
            <button id="edit" onclick="change_to_input_form('edit', 'hidden2')">Редактировать</button>
            <span id="hidden2">
                <select id="sel">
                    <?php 
                        for ($i = 0; $i < count($ids["ID"]); $i++) {
                            echo "<option>". $ids["ID"][$i] . "</option>";
                        }
                    ?>
                </select>
                <input id="txt2" type="text" width="100px" name="name" />
                <input type="submit" value="Подтвердить" onclick="rename(2, 'txt2', 'sel')"/>
                <button id="cancel" onclick="change_to_button('edit', 'hidden2', 'txt2')">Отмена</button>
            </span><br /><br />
            <button id="remove" onclick="change_to_input_form('remove', 'hidden3')">Удалить</button>
            <span id="hidden3">
                <select id="sel1">
                    <?php 
                        for ($i = 0; $i < count($ids["ID"]); $i++) {
                            echo "<option>". $ids["ID"][$i] . "</option>";
                        }
                    ?>
                </select>
                <input type="submit" value="Подтвердить" onclick="rename(3, null, 'sel1')"/>
                <button id="cancel" onclick="change_to_button('remove', 'hidden3')">Отмена</button>
            </span><br /><br />
        </div>
    </body>
</html>