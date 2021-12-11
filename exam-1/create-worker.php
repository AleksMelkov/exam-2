<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/include/header.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/include/aside.php');
global $DB;
$departmentsQuery = $DB::$mysqli->query('SELECT * FROM departments');

if (!empty($_POST)) {
    $fio = $DB::$mysqli->real_escape_string($_POST['fio']);
    $position = $DB::$mysqli->real_escape_string($_POST['position']);
    $department_id = $DB::$mysqli->real_escape_string($_POST['department']);
    $salary = $DB::$mysqli->real_escape_string($_POST['salary']);
    $result = $DB::$mysqli->query("INSERT INTO workers (fio, position, department_id, salary) VALUES('{$fio}','{$position}','{$department_id}','{$salary}')");
}
?>
    <main>
        <h1>Создание сотрудника</h1>
        <div class="main-content">
            <form action="" method="post">
                <div class="form-element">
                    <label for="fio">ФИО</label>
                    <input type="text" id="fio" name="fio" pattern="^([а-яА-Яa-zA-Z]+\s){1,2}[а-яА-Яa-zA-Z]+$" required>
                </div>
                <div class="form-element">
                    <label for="position">Должность</label>
                    <input type="text" id="position" name="position" required>
                </div>
                <div class="form-element">
                    <label for="department">Отдел</label>
                    <select name="department" id="department">
                        <?while ($department = $departmentsQuery->fetch_array()):?>
                            <option value="<?=$department['id']?>"><?=$department['name']?></option>
                        <?endwhile;?>
                    </select>
                </div>
                <div class="form-element">
                    <label for="salary">Заработная плата</label>
                    <input type="text" id="salary" name="salary" pattern="^\d+$" required>
                </div>
                <div class="form-element">
                    <button>Записать</button>
                </div>
                <?if(isset($result)):?>
                    <div class="form-element">
                        <?if($DB::$mysqli->affected_rows > 0):?>
                            <p>Данные успешно добавлены</p>
                        <?else:?>
                            <p>Что-то пошло не так <?=$DB::$mysqli->error?></p>
                        <?endif;?>
                        <?$DB::$mysqli->close();?>
                    </div>
                <?endif;?>
            </form>
        </div>
    </main>
<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/include/footer.php');
