<?php
    include_once(dirname(dirname(__FILE__)) . '/Config.php');
    $data=DB::query("SELECT keyword FROM record WHERE keyword like '{$_GET['k']}%' AND keyword != '{$_GET['k']}' ORDER BY `count` DESC LIMIT 10");
    header('Content-type:text/json;charset:utf-8');
    echo json_encode($data);
?>
