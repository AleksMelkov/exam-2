<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/include/header.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/include/aside.php');
global $DB;
if (!empty($_POST)) {
    $title = $DB::$mysqli->real_escape_string($_POST['title']);
    $text = $DB::$mysqli->real_escape_string($_POST['text']);
    $date = $DB::$mysqli->real_escape_string($_POST['date']);
    $dateOb = new DateTime($date);
    $date = $dateOb->format('Y-m-d H:i:s');
    $result = $DB::$mysqli->query("INSERT INTO posts (title, text, date) VALUES('{$title}','{$text}','{$date}')");
}
?>
    <main>
        <h1>Добавление новости</h1>
        <div class="main-content">
            <form action="" method="post">
                <div class="form-element">
                    <label for="title">Заголовок</label>
                    <input type="text" id="title" name="title" required>
                </div>
                <div class="form-element">
                    <label for="text">Текст</label>
                    <textarea id="text" name="text" required></textarea>
                </div>
                <div class="form-element">
                    <label for="date">Дата</label>
                    <input type="datetime-local" id="date" name="date" required>
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
require_once($_SERVER['DOCUMENT_ROOT'] . '/include/footer.php');
