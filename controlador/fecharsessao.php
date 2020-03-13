<?php
	session_start();
	
	if(isset($_SESSION['Usuario'])) {
		unset($_SESSION['Usuario']);
		$array = array();
        $array[0] = "1";
        print json_encode($array, JSON_UNESCAPED_UNICODE);
	}
?>