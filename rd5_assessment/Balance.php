<?php
    require_once ("config.php");
    session_start();
    $idcnum=$_SESSION["idcnum"];
    $name=$_SESSION["user"];
    
    $commandText = <<<sqlcommand
    select e.account, wdmoney,dpmoney,tranmoney,balance from money e join member f on e.account=f.account where e.account="$name"
    sqlcommand;
    $result = mysqli_query ( $link, $commandText );
    
    $Balance = 0;
    while($row = mysqli_fetch_assoc ($result)){
        $Dmoney=$row["dpmoney"];
        $Wmoney=$row["wdmoney"];
        $Balance=$row["balance"];
    }

?>