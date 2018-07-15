<?php

	session_start();
	//unset and delete session
	session_unset(); 
	session_destroy();

  header("Location: login.php");

?>
