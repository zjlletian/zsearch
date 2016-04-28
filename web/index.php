<?php
    include_once(dirname(dirname(__FILE__)) . '/Config.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Zsearch</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
</head>

<body class="bg">
<div class="container">
    <div id="searchhearder" class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6" style="margin-top:15%; text-align: center">
            <img src="/img/logo.png"><br><br><br>
            <form id="searchform" action="search.php" method="get" class="form-inline" style="text-align: left">
                <input id="keyword" style="width: 80%" name="keyword" type="text" placeholder="输入关键词" class="form-control">
                <input type="hidden" name="p" value="1">
                <button id="searchbtn" type="button" class="btn btn-primary" onclick="$('#searchform').submit()" style="border-top-right-radius: 17px; border-bottom-right-radius: 17px;">
                    &nbsp;<span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;&nbsp;搜&nbsp;&nbsp;索&nbsp;&nbsp;
                </button>
                <div id="tip" class="tip" style="width: 76%;display: none;"></div>
            </form>
        </div>
    </div>
</div>
</body>
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="/script/index.js"></script>
</html>
