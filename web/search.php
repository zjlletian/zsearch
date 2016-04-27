<?php
include_once(dirname(dirname(__FILE__)) . '/Config.php');

$keyword=$_GET['keyword'];
$result=Search::searchByKeyWord($keyword,0,20);
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
        <div class="col-md-12">
            <br>
            <form action="search.php" method="get" class="form form-inline" id="searchform">
                <input name="keyword" type="text" placeholder="输入关键词" value="<?php echo $keyword?>" class="form-control input-sm">
                <button type="button" class="btn btn-default btn-sm">
                    <span class="glyphicon glyphicon-search" aria-hidden="true" onclick="$('#searchform').submit()"></span>&nbsp;&nbsp;搜 索
                </button>
                <?php echo "共找到".$result['hits']['total']."个相关网页，用时".($result['took']/1000)."秒"?>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-9">
            <?php foreach ($result['hits']['hits'] as $item):?>
                <?php
                $title=isset($item['highlight']['title'])?implode('',$item['highlight']['title']):$item['_source']['title'];
                if(isset($item['highlight']['text'])){
                    $text=implode('...',$item['highlight']['text']);
                    $text=mb_strlen($text,'utf-8')>200?mb_substr($text,0,200,'utf-8'):$text;
                    $text=rtrim($text,'</em');
                    $text=rtrim($text,'</e');
                    $text=rtrim($text,'</');
                    $text=rtrim($text,'<');
                    if(strripos($text,'</em>')<strripos($text,'<em>')){
                        $text=$text."</em>";
                    }
                    $text=$text."...";
                }
                else{
                    $text=mb_strlen($item['_source']['text'],'utf-8')>200?mb_substr($item['_source']['text'],0,200,'utf-8')."...":$item['_source']['text'];
                }
                ?>
                <div class="searchitem">
                    <a href="<?php echo $item['_source']['url'];?>" target="_blank"><?php echo $title;?></a>
                    <br>
                    <?php echo $text;?>
                </div>
            <?php endforeach;?>
        </div>
    </div>
</div>
</body>
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</html>
