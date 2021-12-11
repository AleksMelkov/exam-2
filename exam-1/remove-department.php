<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/include/header.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/include/aside.php');
global $DB;
if (!empty($_GET)) {
    $check = $DB::$mysqli->query('SELECT w.id FROM workers AS w WHERE w.department_id ='.$_GET['id']);
    if ($check->num_rows > 0) {
        $error = true;
    } else {
        $result = $DB::$mysqli->query('DELETE FROM departments WHERE id ='.$_GET['id']);
    }
}
$query = $DB::$mysqli->query('SELECT * FROM departments');
?>
    <main>
        <h1>Удаление подразделений</h1>
        <div class="main-content">
            <table>
                <tr>
                    <th>№</th>
                    <th>Название</th>
                    <th>Удалить</th>
                </tr>
                <?while ($row = $query->fetch_assoc()):?>
                <tr>
                    <td><?=$row['id']?></td>
                    <td><?=$row['name']?></td>
                    <td>
                        <a href="remove-department.php?id=<?=$row['id']?>">удалить</a>
                    </td>
                </tr>
                <?endwhile;?>
            </table>
            <?if(!empty($_GET)):?>
                <?if($error):?>
                    <p>Нельзя удалить подразделение, для которого зарегистрированы сотрудники</p>
                <?else:?>
                    <div class="form-element">
                        <?if($DB::$mysqli->affected_rows > 0):?>
                            <p>Данные успешно обновлены</p>
                        <?else:?>
                            <p>Что-то пошло не так <?=$DB::$mysqli->error?></p>
                        <?endif;?>
                        <?$DB::$mysqli->close();?>
                    </div>
                <?endif;?>
            <?endif;?>
        </div>
    </main>
<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/include/footer.php');
