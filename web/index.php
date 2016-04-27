<?php
include_once(dirname(dirname(__FILE__)) . '/Config.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Zsearch</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>

<body>
<form action="search.php" method="get">
    <input name="keyword" type="text" placeholder="输入关键词"> <input type="submit" value="搜索">
</form>
</body>
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</html>
