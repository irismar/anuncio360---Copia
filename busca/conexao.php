<?php
//Credenciais de acesso ao BD
define('HOST', 'mysql873.umbler.com');
define('USER', '360');
define('PASS', 'irisMAR100');
define('DBNAME', '360');

$conn = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME . ';', USER, PASS);
