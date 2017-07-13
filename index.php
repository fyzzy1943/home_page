<?php

$db = new SQLite3('cemetery.db');
$db->exec('CREATE TABLE IF NOT EXISTS list(id INTEGER PRIMARY KEY AUTOINCREMENT,name STRING,url STRING)');

//$db->exec("INSERT INTO list VALUES (null, 'helo', 'This is a test')");

if (isset($_SERVER['REQUEST_METHOD']) && !strcasecmp($_SERVER['REQUEST_METHOD'],'POST')) {
    $db->exec("INSERT INTO list VALUES (null, '$_POST[name]', '$_POST[url]')");
}

$result = $db->query('SELECT * FROM list');
//if ($result->numColumns() && $result->columnType(0) != SQLITE3_NULL) :

?>


<table>
<tr><th>id</th><th>name</th><th>url</th></tr>
<?php while ($row = $result->fetchArray(SQLITE3_ASSOC)) : ?>
    
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['name'] ?></td>
        <td><a href="http://<?= $row['url'] ?>"><?= $row['url'] ?></a></td>
    </tr>
    
<?php endwhile; ?>
</table>

<form action="index.php" method="POST">
    Name:<input type="text" name="name">
    Url:<input type="text" name="url">
    <input type="submit" value="Submit">
</form>

<?php

phpinfo();