<?php
	session_start();
	session_destroy();
	header("Location:".$Include_Path."index.php?act=logout");
?>