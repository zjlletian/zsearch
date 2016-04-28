<?php
define('APPROOT',dirname(__FILE__));

//默认时区
date_default_timezone_set('Asia/Shanghai');

//设置include包含文件所在的所有目录
$include_path=get_include_path();
$include_path.=PATH_SEPARATOR.APPROOT."/lib";
set_include_path($include_path);

require_once(APPROOT.'/db.inc.php');

//包含class文件夹中的所有.class.php文件
foreach(new FilesystemIterator(APPROOT."/class", FilesystemIterator::SKIP_DOTS ) as $classfile) {
    require_once($classfile);
}
