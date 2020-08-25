<?php
    require_once ("config.php");
    session_start();
    $idcnum=$_SESSION["idcnum"];
    $name=$_SESSION["user"];

    $link=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname) or die(mysqli_connect_error());
    $result = mysqli_query ( $link, "set names utf8" );
    mysqli_select_db ( $link, $dbname );
    $dpdate=date("Y-m-d");
    
    $commandText = <<<sqlcommand
    select num ,e.account, wdmoney,dpmoney from money e join member f on e.account=f.account where e.account="$name"
    sqlcommand;
    $result = mysqli_query ( $link, $commandText );
    
    while($row = mysqli_fetch_assoc ( $result )){
        echo $row["account"],"  ",$row["wdmoney"],"  ",$row["dpmoney"],"<br> " ;
    
        }
    
?>