<?php
$sql = file_get_contents("install.sql");
$pdo = new PDO("mysql:host=localhost", "root", "");
$pdo->exec($sql);
echo "<a href='../index.php'>Zur Anwendung</a>";
