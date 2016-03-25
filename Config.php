<?php
define('APPROOT',dirname(__FILE__));

//设置include包含文件所在的所有目录
$include_path=get_include_path();
$include_path.=PATH_SEPARATOR.APPROOT."/lib";
$include_path.=PATH_SEPARATOR.APPROOT."/class";
set_include_path($include_path);

//默认时区
date_default_timezone_set('Asia/Shanghai');

require_once(APPROOT.'/db.inc.php');
