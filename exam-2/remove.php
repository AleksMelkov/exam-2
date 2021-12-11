<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/include/header.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/include/aside.php');
global $DB;
if (!empty($_GET)) {
    $result = $DB::$mysqli->query('DELETE FROM posts WHERE id ='.$_GET['id']);
}
$query = $DB::$mysqli->query('SELECT * FROM posts');
?>
    <main>
        <h1>Просмотр сотрудников</h1>
        <div class="main-content">
            <table>
                <tr>
                    <th>№</th>
                    <th>Заголовок</th>
                    <th>Текст</th>
                    <th>Дата</th>
                    <th>Удалить</th>
                </tr>
                <?while ($row = $query->fetch_assoc()):?>
                    <tr>
                        <td><?=$row['id']?></td>
                        <td><?=$row['title']?></td>
                        <td><?=substr($row['text'], 0, 50)?>...</td>
                        <td><?=$row['date']?></td>
                        <td>
                            <a href="remove.php?id=<?=$row['id']?>">удалить</a>
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
require_once($_SERVER['DOCUMENT_ROOT'] . '/include/footer.php');
