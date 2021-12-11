<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/include/header.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/include/aside.php');
global $DB;

if (!empty($_POST)) {
    $name = $DB::$mysqli->real_escape_string($_POST['name']);
    $result = $DB::$mysqli->query("INSERT INTO departments (name) VALUES('{$name}')");
}
?>
    <main>
        <h1>Создание подразделений</h1>
        <div class="main-content">
            <form action="" method="post">
                <div class="form-element">
                    <label for="name">Название</label>
                    <input type="text" id="name" name="name" required>
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
