<?php
	include "conn.php";
	if(isset($_GET['id'])){
		$id=$_GET['id'];
		//修改访问量
		$sql="update blog set hits=hits+1 where bid='$id'";
		$query=mysqli_query($link,$sql);
		if($query){
			$sql="select * from blog where bid='$id'";
			$query=mysqli_query($link,$sql);
			$rs=mysqli_fetch_array($query);
		}
	}	

?>

<h3>标题:<?php echo $rs['title']?></h3>
<li>时间:<?php echo $rs['time']?></li>
<li>访问量:<?php echo $rs['hits']?></li>
<p><?php echo $rs['content']?></p>
<hr />

<?php
	if(isset($_POST['sub'])){
		$pcon=$_POST['pcon'];
		$puid=$_COOKIE['id'];
		$pbid=$_POST['hbid'];
		$sql="insert into pl(plid,pcon,ptime,puid,pbid) values(null,'$pcon',now(),'$puid','$pbid')";
		$query=mysqli_query($link,$sql);
		if($query){
			echo "<script>location='all.php?id=$pbid'</script>";
		}else{
			echo "error";
		}
	}
?>

<form action="all.php" method="post">
	<input type="hidden" name="hbid" value="<?php echo $id?>">
	<textarea cols=20 rows=10 name='pcon'></textarea><br />
	<input type="submit" name="sub" value="评论">
</form>
<?php 
	$id=$_GET['id'];
	$sql="select * from pl,user,blog where pl.puid=user.uid and pl.pbid=blog.bid and pl.pbid='$id'";
	$query=mysqli_query($link,$sql);
	while($rs=mysqli_fetch_array($query)){
?>
<p><?php echo $rs['pcon']?></p>
<li><?php echo $rs['ptime']?></li>
<li><?php echo $rs['uname']?></li>
<hr />
<?php
	}
?>








