<style>
	#div1{
		width:500px;
		height: 800px;
		float:left;
		margin-left:50px;
	}
	#div2{
		width:200px;
		height:300px;
		float:right;
		margin-top:80px;
		margin-right:80px;
		/*background:blue;*/
	}
</style>
<a href="index.php">主页</a>&nbsp;&nbsp;
<a href="add.php">添加文章</a>
<?php
	if(isset($_COOKIE['id'])){
		$name=$_COOKIE['name'];
		echo "<span>$name 已登录</span>";
		echo "<a href='unlog.php'>退出</a>";
	}else{
		echo "<span><a href='login.php'>未登录</a></span>";
	}

?>

<form action="index.php" method="get">
	<input type="text" name="search">
	<input type="submit" name="sub" value="搜索">
</form>

<div id="div1">
<?php
	include "conn.php";
	//substr切割英文 
	
	
	if(isset($_GET['sub'])){
		$s=$_GET['search'];
		//$sql="select * from blog where title like '%$se%'";
		//$query=mysqli_query($link,$sql);
		$se="blog.uid=user.uid and title like '%".$s."%'";
		$sql="select * from blog,user where $se order by bid desc";
		$query=mysqli_query($link,$sql);
	}else{
		$se="blog.uid=user.uid";
		$sql="select * from blog,user where $se order by bid desc";
		$query=mysqli_query($link,$sql);
	}
	
	if(isset($_GET['cid'])){
		$cid=$_GET['cid'];
		$se="blog.uid=user.uid and blog.cid=catalog.catalog_id and catalog.catalog_id=".$cid;
		$sql="select * from blog,user,catalog where $se order by bid desc";
		$query=mysqli_query($link,$sql);
	}
	
	//$sql="select * from blog where $se order by bid desc";
	//$query=mysqli_query($link,$sql);
	
	//var_dump($query);
	/*
	$arr=mysqli_fetch_array($query);
	$arr=mysqli_fetch_array($query);
	var_dump($arr);*/
	while($arr=mysqli_fetch_array($query)){
?>
<h3><a href="all.php?id=<?php echo $arr['bid']?>">标题:<?php echo $arr['title']?> </a>|<a href="del.php?id=<?php echo $arr['bid']?>">删除</a>|<a href="edit.php?id=<?php echo $arr['bid']?>">修改</a></h3>
<li>时间:<?php echo $arr['time']?></li>
<li>作者:<?php echo $arr['uname']?></li>
<p><?php echo iconv_substr($arr['content'], 0,3)?>...</p>
<hr />
<?php
	}
?>
</div>
<div id="div2">
	<?php 
		$sql="select * from catalog";
		$query=mysqli_query($link,$sql);
		while($rs=mysqli_fetch_array($query)){
	?>
	<a href="index.php?cid=<?php echo $rs['catalog_id']?>"><li><?php echo $rs['catalog_name']?></li></a>
	<?php
		}
	?>
</div>









