<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/include/header.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/include/aside.php');
global $DB;
if (!empty($_GET)) {
    $result = $DB::$mysqli->query('DELETE FROM workers WHERE id ='.$_GET['id']);
}
$query = $DB::$mysqli->query('SELECT w.id AS id, w.fio AS fio, w.position AS position, d.name AS name, w.salary AS salary FROM workers AS w, departments AS d WHERE w.department_id = d.id');
?>
    <main>
        <h1>Удаление сотрудников</h1>
        <div class="main-content">
            <table>
                <tr>
                    <th>№</th>
                    <th>ФИО</th>
                    <th>Должность</th>
                    <th>Отдел</th>
                    <th>ЗП</th>
                    <th>Удалить</th>
                </tr>
                <?while ($row = $query->fetch_assoc()):?>
                    <tr>
                        <td><?=$row['id']?></td>
                        <td><?=$row['fio']?></td>
                        <td><?=$row['position']?></td>
                        <td><?=$row['name']?></td>
                        <td><?=$row['salary']?></td>
                        <td>
                            <a href="remove-worker.php?id=<?=$row['id']?>">удалить</a>
                        </td>
                    </tr>
                <?endwhile;?>
            </table>
            <?if(!empty($_GET)):?>
                <div class="form-element">
                    <?if($DB::$mysqli->affected_rows > 0):?>
                        <p>Данные успешно обновлены</p>
                    <?else:?>
                        <p>Что-то пошло не так <?=$DB::$mysqli->error?></p>
                    <?endif;?>
                    <?$DB::$mysqli->close();?>
                </div>
            <?endif;?>
        </div>
    </main>
<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/include/footer.php');
