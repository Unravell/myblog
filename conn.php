<?php
	//phpinfo();
	//双击sword 打开数据库连接（数据库引擎->操作数据库的API函数）
	$link=@mysqli_connect("localhost","root","") or die('打开数据库失败');
	
	//选中数据库
	mysqli_select_db($link,"newblog2") or die('选择数据库失败');
	
	//设置传输编码
	mysqli_set_charset($link,"UTF8");
?>
