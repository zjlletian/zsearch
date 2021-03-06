<?php
    include_once(dirname(dirname(__FILE__)) . '/Config.php');
    $page=isset($_GET['p'])?intval($_GET['p']):1;
    $keyword=isset($_GET['keyword'])?trim($_GET['keyword']):null;
    if(empty($keyword)){
        header('Location: /');
    }
    if(mb_strlen($keyword)>40){
        $keyword_bak=$keyword;
        $keyword=mb_substr($keyword,0,40);
    }
    if($page==1 && mb_strlen($keyword)<15){
        DB::query("UPDATE record SET `count`=`count`+1 WHERE keyword='".$keyword."'; INSERT INTO record VALUES(null, '".$keyword."' , 1); ",true);
    }
    $result=Search::searchByKeyWord($keyword,20*($page-1),20);
    $pages=intval($result['hits']['total']/20);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Zsearch</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
<div class="container">
    <div class="row" id="searchhearder">
        <div class="col-md-7">
            <form id="searchform" action="search.php" method="get" class="form form-inline">
                <input id="keyword" style="width: 65%" name="keyword" type="text" placeholder="输入关键词" value="<?php echo $keyword?>" class="form-control input-sm">
                <button id="searchbtn"  type="button" class="btn btn-sm btn-primary" onclick="$('#searchform').submit()" style="border-top-right-radius: 14px; border-bottom-right-radius: 14px;">
                    &nbsp;<span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;&nbsp;搜&nbsp;&nbsp;索&nbsp;&nbsp;
                </button>
                <div id="tip" class="tip" style="width: 62.2%;display: none;"></div>
            </form>
        </div>
    </div>
    <div class="row" id="searchcontent">
        <div class="col-md-8">
            <div class="resulttip">
                <?php
                    if(isset($keyword_bak)){
                        echo "<strong>关键词长度超过40字符限制，仅搜索以下部分：</strong> {$keyword}<br><br>";
                    }
                ?>
                <?php echo "共找到".$result['hits']['total']."个相关网页，用时".($result['took']/1000)."秒"?>
                <hr>
            </div>
            <?php foreach ($result['hits']['hits'] as $item):?>
                <?php
                    $title=isset($item['highlight']['title'])?implode('',$item['highlight']['title']):$item['_source']['title'];
                    if(isset($item['highlight']['url'])){
                        $url=implode('',$item['highlight']['url']);
                        if(mb_strlen($url,'utf-8')>50){
                            $url=mb_substr($url,0,50,'utf-8');
                            $url=rtrim($url,'<em');
                            $url=rtrim($url,'<e');
                            $url=rtrim($url,'</em');
                            $url=rtrim($url,'</e');
                            $url=rtrim($url,'</');
                            $url=rtrim($url,'<');
                            if(strripos($url,'</em>')<strripos($url,'<em>')){
                                $url=$url."</em>";
                            }
                            $url.="...";
                        }
                    }
                    else{
                        $url=mb_strlen($item['_source']['url'],'utf-8')>50?mb_substr($item['_source']['url'],0,50,'utf-8')."...":$item['_source']['url'];
                    }
                    if(isset($item['highlight']['text'])){
                        $text=implode('...',$item['highlight']['text']);
                        $text=mb_strlen($text,'utf-8')>200?mb_substr($text,0,200,'utf-8'):$text;
                        $text=rtrim($text,'<em');
                        $text=rtrim($text,'<e');
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
                    for($i=0;$i<3;$i++){
                        $text=trim($text);
                        $text=ltrim($text,'&nbsp;');
                        $text=ltrim($text,'>');
                        $text=ltrim($text,'》');
                        $text=ltrim($text,'。');
                    }
                ?>
                <div class="searchitem">
                    <a href="<?php echo $item['_source']['url'];?>" target="_blank"><?php echo $title;?></a>
                    <br>
                    <div class="itemcontent"><?php echo $text;?></div>
                    <div class="iteminfo">
                        <span class="itemurl"><?php echo $url;?></span>&nbsp;&nbsp;
                        <span class="updatetime"><?php echo substr($item['_source']['time'],0,16);?></span>
                    </div>
                    <hr>
                </div>
            <?php endforeach;?>
        </div>
    </div>
    <div class="row" id="searchpagger">
        <div class="col-md-12">
            <nav>
                <ul class="pagination pagination-sm">
                    <?php
                        $pageurl="/search.php?keyword={$keyword}&p=";
                        $from=1;
                        $to=$pages;
                        if($page>7){
                            $from=$page-7;
                        }
                        if($pages-$page>7){
                            $to=$page+7;
                        }
                        $from=$to-14>0?$to-14:1;
                        $to=$from+14>$pages?$pages:$from+14;
                    ?>
                    <!-- 首页 -->
                    <?php if($from>1): ?>
                        <li><a href="<?php echo  $pageurl."1" ?>">1</a></li>
                        <li class="disabled"><a>...</a></li>
                    <?php endif;?>

                    <!-- 所有分页，最多显示15个分页数目 -->
                    <?php for($i=$from;$i<=$to;$i++): ?>
                        <li <?php if($i== $page) echo "class='active'"; ?>><a href="<?php echo  $pageurl.$i ?>"><?php echo $i; ?></a></li>
                    <?php endfor; ?>

                    <!-- 尾页 -->
                    <?php if($pages-$page>15 || $pages!=0): ?>
                        <li class="disabled"><a>...</a></li>
                        <li><a href="<?php echo  $pageurl.$pages ?>"><?php echo  $pages?></a></li>
                    <?php endif;?>
                </ul>
            </nav>
        </div>
    </div>
    <div class="row" id="searchfooter">
        <div class="col-md12"></div>
    </div>
</div>
</body>
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="/script/index.js"></script>
</html>
