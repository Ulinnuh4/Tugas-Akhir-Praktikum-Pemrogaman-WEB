<?php
$localhost = 'localhost';
$user = 'root';
$pw = '';
$db = 'projek';

$connect = mysqli_connect($localhost, $user, $pw, $db);

if(!$connect){
    echo 'gagal';
}
?>