<?php
	//如何设定cookie 
	//setcookie('name','laoshan');
	//如何删除cookie
	setcookie('name','');
	//如何获取cookie
	if(isset($_COOKIE['name'])){
		echo 'success';
	}else{
		echo "error";
	}
	
	
	
	
	

?>