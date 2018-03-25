<?php
	include "conn.php";
	
	if(isset($_POST['sub'])){
		$uname=$_POST['uname'];
		$pass=$_POST['pass'];
		$sfile=$_FILES['sfile'];
		
		$arr=array('%','=','&');
		$flag=true;
		for($i=0;$i<strlen($uname);$i++){
			for($j=0;$j<count($arr);$j++){
				if($uname[$i]==$arr[$j]){
					$flag=false;
				}
			}
		}
		
		if($flag==false){
			echo "<script>alert('用户名非法')</script>";
			echo "<script>location='reg.php'</script>";
		}else{
			//判断注册用户名是不是重名
			$sql="select * from user where uname='$uname'";
			$query=mysqli_query($link,$sql);
			$rs=mysqli_fetch_array($query);
			if($rs){
				echo "<script>alert('用户名重名')</script>";
				echo "<script>location='reg.php'</script>";
			}else{
				//存储头像图片 并获取到新头像图片的路径
				$sarr=explode('.',$sfile['name']);
				$len=count($sarr)-1;
				$hou=$sarr[$len];
				//echo $hou;
				$yname=$uname.time();
				
				$des='./image/'.$yname.".".$hou;
				
				
				
				$dd=move_uploaded_file($sfile['tmp_name'], $des);
				if($dd){
					$imgurl=substr($des,1);
					$mpass=md5($pass);
					$sql="insert into user(uid,uname,pass,img) values(null,'$uname','$mpass','$imgurl')";
					$query=mysqli_query($link,$sql);
					if($query){
						header('location:login.php');
					}
				}else{
					echo "<script>alert('上传失败')</script>";
					echo "<script>location='reg.php'</script>";
				}
			}
			
			
			
		}
		//str1  m  str2 n m*n
		//str1 e r u i l  m
		//str2 m n b v c j k n  mlogm+nlogn+m+n
		//24
		//array(5) { ["name"]=> string(23) "11216943431d69da26o.jpg" 
		//["type"]=> string(10) "image/jpeg" 
		//["tmp_name"]=> string(24) "C:\xampp\tmp\php6D82.tmp" 
		//["error"]=> int(0) ["size"]=> int(144955) }
	}

?>


<meta charset="utf-8">
<form action="reg.php" method="post" enctype="multipart/form-data">
	用户名:<input type="text" name="uname"><br />
	密码:<input type="password" name="pass"><br />
	上传头像:<input type="file"  name="sfile"><br />
	<input type="submit" name="sub" value="注册">
</form>