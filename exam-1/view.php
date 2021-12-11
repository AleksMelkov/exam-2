<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/include/header.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/include/aside.php');
global $DB;
$query = $DB::$mysqli->query('SELECT w.id AS id, w.fio AS fio, w.position AS position, d.name AS name, w.salary AS salary FROM workers AS w, departments AS d WHERE w.department_id = d.id');
?>
    <main>
        <h1>Просмотр сотрудников</h1>
        <div class="main-content">
            <table>
                <tr>
                    <th>№</th>
                    <th>ФИО</th>
                    <th>Должность</th>
                    <th>Отдел</th>
                    <th>ЗП</th>
                </tr>
                <?while ($row = $query->fetch_assoc()):?>
                <tr>
                    <td><?=$row['id']?></td>
                    <td><?=$row['fio']?></td>
                    <td><?=$row['position']?></td>
                    <td><?=$row['name']?></td>
                    <td><?=$row['salary']?></td>
                </tr>
                <?endwhile;?>
            </table>
        </div>
    </main>
<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/include/footer.php');
