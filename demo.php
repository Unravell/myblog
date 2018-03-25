<?php
	$url=123;
	if(isset($_POST['sub'])){
		$name=$_GET['name'];
		echo $name;
	}

?>

<form action="demo.php?name=<?php echo $url?>" method="post">
	ss:<input type="text" name="ss">
	<input type="submit" name="sub" value="tijiao">
</form>
