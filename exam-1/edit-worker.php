<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/include/header.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/include/aside.php');
global $DB;
if (!empty($_POST)) {
    $fio = $DB::$mysqli->real_escape_string($_POST['fio']);
    $position = $DB::$mysqli->real_escape_string($_POST['position']);
    $department_id = $DB::$mysqli->real_escape_string($_POST['department']);
    $salary = $DB::$mysqli->real_escape_string($_POST['salary']);
    $result = $DB::$mysqli->query("UPDATE workers SET fio='{$fio}', position='{$position}', department_id='{$department_id}', salary='{$salary}' WHERE id =".$_GET['id']);
}
if (!empty($_GET)) {
    $worker = $DB::$mysqli->query('SELECT * FROM workers WHERE id='.$_GET['id']);
    $worker = $worker->fetch_assoc();
    $departmentsQuery = $DB::$mysqli->query('SELECT * FROM departments');
}
$workers = $DB::$mysqli->query('SELECT w.id AS id, w.fio AS fio, w.position AS position, d.name AS name, w.salary AS salary FROM workers AS w, departments AS d WHERE w.department_id = d.id');
?>
    <main>
        <h1>Редактирование сотрудников</h1>
        <div class="main-content">
            <?if(empty($_GET)):?>
                <table>
                    <tr>
                        <th>ФИО</th>
                        <th>Должность</th>
                        <th>Отдел</th>
                        <th>ЗП</th>
                    </tr>
                    <?while ($row = $workers->fetch_assoc()):?>
                        <tr>
                            <td><a href="edit-worker.php?id=<?=$row['id']?>"><?=$row['fio']?></a></td>
                            <td><?=$row['position']?></td>
                            <td><?=$row['name']?></td>
                            <td><?=$row['salary']?></td>
                        </tr>
                    <?endwhile;?>
                </table>
            <?else:?>
                <form action="edit-worker.php?id=<?=$worker['id']?>" method="post">
                    <div class="form-element">
                        <label for="fio">ФИО</label>
                        <input type="text" id="fio" name="fio" value="<?=$worker['fio']?>" pattern="^([а-яА-Яa-zA-Z]+\s){1,2}[а-яА-Яa-zA-Z]+$" required>
                    </div>
                    <div class="form-element">
                        <label for="position">Должность</label>
                        <input type="text" id="position" name="position" value="<?=$worker['position']?>" required>
                    </div>
                    <div class="form-element">
                        <label for="department">Отдел</label>
                        <select name="department" id="department">
                            <?while ($department = $departmentsQuery->fetch_array()):?>
                                <option value="<?=$department['id']?>" <?if($department['id'] == $worker['department_id']) {echo 'selected';}?>>
                                    <?=$department['name']?>
                                </option>
                            <?endwhile;?>
                        </select>
                    </div>
                    <div class="form-element">
                        <label for="salary">Заработная плата</label>
                        <input type="text" id="salary" name="salary" value="<?=$worker['salary']?>" pattern="^\d+$" required>
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
require_once($_SERVER['DOCUMENT_ROOT'].'/include/footer.php');
