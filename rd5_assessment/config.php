<?php
	$link=mysqli_connect('localhost','root','root','bankDB') or die(mysqli_connect_error());
	$result = mysqli_query ( $link, "set names utf8" );
	
	

?>