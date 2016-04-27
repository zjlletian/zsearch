<?php
include_once(dirname(dirname(__FILE__)) . '/Config.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Zsearch</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="/style.css">
</head>

<body>
<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <form action="search.php" method="get" class="form form-inline" id="searchform" style="margin-top: 200px">
                <input style="width: 70%" name="keyword" type="text" placeholder="输入关键词" value="<?php echo $keyword?>" class="form-control input-sm">
                <input type="hidden" name="p" value="1">
                <button type="button" class="btn btn-default btn-sm" onclick="$('#searchform').submit()">
                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;&nbsp;搜 索
                </button>
            </form>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
</body>
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</html>
