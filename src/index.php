<?php
require_once 'config.php';

echo "<h1>PHP + PostgreSQL Connected!</h1>";

$result = pg_query($connect, "SELECT version();");

$row = pg_fetch_assoc($result);

echo "<pre>";
print_r($row);
echo "</pre>";
?>
