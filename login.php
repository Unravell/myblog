<?php
	include "conn.php";
	if(isset($_GET['url'])){
		$url=$_GET['url'];
	}
	
	
	if(isset($_POST['sub'])){
		$uname=$_POST['uname'];
		$pass=$_POST['pass'];
		$url=$_POST['url'];
		$mpass=md5($pass);
		$sql="select * from user where uname='$uname' and pass='$mpass'";
		$query=mysqli_query($link,$sql);
		$rs=mysqli_fetch_array($query);
		if($rs){
			//header('location:index.php');
			setcookie('id',$rs['uid']);
			setcookie('name',$rs['uname']);
			if($url){
				echo "<script>location='$url'</script>";
			}else{
				echo "<script>location='index.php'</script>";
			}
			
		}
	}


?>

<meta charset="utf-8">
<form action="login.php" method="post">
	<input type="hidden" name="url" value="<?php echo $url?>">
	用户名:<input type="text" name="uname"><br />
	密码:<input type="password" name="pass"><br />
	<input type="submit" name="sub" value="登录">
</form>