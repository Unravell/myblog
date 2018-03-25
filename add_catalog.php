<?php 
	include "conn.php";
	if(!isset($_COOKIE['id'])){
		
		$url=$_SERVER['REQUEST_URI'];
		$arr=explode('/',$url);
		$len=count($arr)-1;
		$surl=$arr[$len];
		//echo $surl;
		
		
		//header('location:login.php');
		echo "<script>location='login.php?url=$surl'</script>";
	}
	
	if(isset($_POST['sub'])){
		$cataname=$_POST['cataname'];
		$sql="select * from catalog where catalog_name='$cataname'";
		$query=mysqli_query($link,$sql);
		$rs=mysqli_fetch_array($query);
		if($rs){
			header('location:add_catalog.php');
		}else{
			$sql="insert into catalog(catalog_id,catalog_name) values(null,'$cataname')";
			$query=mysqli_query($link,$sql);
			if($query){
				echo "<script>alert('添加分类成功')</script>";
				echo "<script>location='add.php'</script>";
			}
		}
	}

?>

<meta charset='utf-8'>
<form action="add_catalog.php" method="post">
	添加分类:<input type="text" name="cataname">
	<input type="submit" name="sub" value="添加分类">
</form>