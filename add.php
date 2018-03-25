<?php
	include "conn.php";
	if(!isset($_COOKIE['id'])){
		header('location:login.php');
	}
	if(isset($_POST['sub'])){
		$title=$_POST['title'];
		$con=$_POST['con'];
		$cid=$_POST['fenlei'];
		$uid=$_COOKIE['id'];
		//操作数据库 
		/*
		$time=time();
		$date=date('Y-m-d',$time);
		
		echo $date;
		die();*/
		
		$sql="insert into blog(bid,title,content,time,uid,cid) values(null,'$title','$con',now(),'$uid','$cid')";
		$query=mysqli_query($link,$sql);
		if($query){
			//echo "success";
			echo "<script>location='index.php'</script>";
		}else{
			echo "error";
		}
	}

?>

<meta charset="utf-8">
<form action="add.php" method="post">
	标题:<input type="text" name="title">
	<select name="fenlei">
		<?php
			$sql="select * from catalog";
			$query=mysqli_query($link,$sql);
			while($rs=mysqli_fetch_array($query)){
		?>
		<option value="<?php echo $rs['catalog_id']?>"><?php echo $rs['catalog_name']?></option>
		<?php
			}
		?>
	</select><br />
	内容:<textarea cols=20 rows=10 name="con"></textarea><br />
	<input type="submit" name="sub" value="添加留言">
</form>




