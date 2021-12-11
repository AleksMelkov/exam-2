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
    $result = $DB::$mysqli->query("UPDATE posts SET title='{$title}', text='{$text}', date='{$date}' WHERE id=".$_GET['id']);
}
if (!empty($_GET)) {
    $post = $DB::$mysqli->query('SELECT * FROM posts WHERE id='.$_GET['id']);
    $post = $post->fetch_assoc();
}
$query = $DB::$mysqli->query('SELECT * FROM posts');
?>
    <main>
        <h1>Редактирование новости</h1>
        <div class="main-content">
            <?if(empty($_GET)):?>
                <table>
                    <tr>
                        <th>№</th>
                        <th>Заголовок</th>
                        <th>Текст</th>
                        <th>Дата</th>
                    </tr>
                    <?while ($row = $query->fetch_assoc()):?>
                        <tr>
                            <td><?=$row['id']?></td>
                            <td>
                                <a href="edit.php?id=<?=$row['id']?>"><?=$row['title']?></a>
                            </td>
                            <td><?=substr($row['text'], 0, 50)?>...</td>
                            <td><?=$row['date']?></td>
                        </tr>
                    <?endwhile;?>
                </table>
            <?else:?>
                <form action="edit.php?id=<?=$_GET['id']?>" method="post">
                    <div class="form-element">
                        <label for="title">Заголовок</label>
                        <input type="text" id="title" name="title" value="<?=$post['title']?>" required>
                    </div>
                    <div class="form-element">
                        <label for="text">Текст</label>
                        <textarea id="text" name="text" required><?=$post['text']?></textarea>
                    </div>
                    <div class="form-element">
                        <label for="date">Дата</label>
                        <input type="datetime-local" id="date" name="date"  value="<?=date("Y-m-d\TH:i:s", strtotime($post['date']))?>" required>
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
            <?endif;?>
        </div>
    </main>
<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/include/footer.php');
