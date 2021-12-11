<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/include/header.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/include/aside.php');
global $DB;
if (!empty($_POST)) {
    $name = $DB::$mysqli->real_escape_string($_POST['name']);
    $result = $DB::$mysqli->query("UPDATE departments SET name='{$name}' WHERE id=".$_GET['id']);
}
if (!empty($_GET)) {
    $department = $DB::$mysqli->query('SELECT * FROM departments WHERE id='.$_GET['id']);
    $department = $department->fetch_assoc();
}
$query = $DB::$mysqli->query('SELECT * FROM departments');
?>
    <main>
        <h1>Редактирование подразделений</h1>
        <div class="main-content">
            <?if(empty($_GET)):?>
                <table>
                    <tr>
                        <th>#</th>
                        <th>Название</th>
                    </tr>
                    <?while ($row = $query->fetch_assoc()):?>
                        <tr>
                            <td><?=$row['id']?></td>
                            <td><a href="edit-department.php?id=<?=$row['id']?>"><?=$row['name']?></a></td>
                        </tr>
                    <?endwhile;?>
                </table>
            <?else:?>
            <form action="edit-department.php?id=<?=$department['id']?>" method="post">
                <div class="form-element">
                    <label for="name">Название</label>
                    <input type="text" id="name" name="name" value="<?=$department['name']?>" required>
                </div>
                <div class="form-element">
                    <button>Записать</button>
                </div>
                <?if(!empty($_POST)):?>
                    <div class="form-element">
                        <?if($DB::$mysqli->affected_rows > 0):?>
                            <p>Данные успешно обновлены</p>
                        <?else:?>
                            <p>Что-то пошло не так <?=$DB::$mysqli->error?></p>
                        <?endif;?>
                        <?$DB::$mysqli->close();?>
                    </div>
                <?endif;?>
            </form>
            <?endif;?>
        </div>
    </main>
<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/include/footer.php');
