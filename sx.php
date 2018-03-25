<?php
	include "conn.php";
	$arr=array();
	$sql="select * from user";
	$query=mysqli_query($link,$sql);
	while($rs=mysqli_fetch_array($query)){
		$arr[]=array('uid'=>$rs['uid'],'uname'=>$rs['uname']);
	}
	
	
	$delid="";
	foreach($arr as $k=>$v){
		if($v['uid']==$_COOKIE['id']){
			$delid=$k;
		}
	}
	
	unset($arr[$delid]);
	
		
	
	
	
?>

<form action="sx.php" method="post">
	<select name="rid">
	<?php
		foreach($arr as $k=>$v){
	?>
	<option value="<?php echo $v['uid']?>"><?php echo $v['uname']?></option>
	<?php
		}
	?>
	</select><br />
	<input type="text" name="sxcon"><br />
	<input type="submit" name="sub" value="私信">

</form>

<?php 
	if(isset($_POST['sub'])){
		$rid=$_POST['rid'];
		$sid=$_COOKIE['id'];
		$sxcon=$_POST['sxcon'];
		$sql="insert into sx(sxid,sxcon,sxtime,sid,rid) values(null,'$sxcon',now(),'$sid','$rid')";
		$query=mysqli_query($link,$sql);
		if($query){
			header('location:index.php');
		}
	}
?>





