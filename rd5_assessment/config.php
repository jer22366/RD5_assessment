<?php
	$link=mysqli_connect('localhost','root','','bankdb',) or die(mysqli_connect_error());
	$result = mysqli_query ( $link, "set names utf8" );
	
	

?>