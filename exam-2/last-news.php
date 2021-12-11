<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/include/header.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/include/aside.php');
global $DB;

$query = $DB::$mysqli->query('SELECT * FROM posts AS p ORDER BY p.date DESC LIMIT 5');
?>
    <main>
        <h1>Последние новости</h1>
        <div class="main-content">
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
                    <td><?=$row['title']?></td>
                    <td><?=substr($row['text'], 0, 50)?>...</td>
                    <td><?=$row['date']?></td>
                </tr>
                <?endwhile;?>
            </table>
        </div>
    </main>
<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/include/footer.php');
