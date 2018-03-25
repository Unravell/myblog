<?php
	if(isset($_COOKIE['id'])){
		setcookie('id','');
		setcookie('name','');
		echo "<script>location='index.php'</script>";
	}

?>