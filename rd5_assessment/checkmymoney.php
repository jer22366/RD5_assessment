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
      select num ,e.account, wdmoney,dpmoney,Ddate from money e join member f on e.account=f.account where e.account="$name"
    sqlcommand;
    $result = mysqli_query ( $link, $commandText );
    if(isset($_POST["btnback"])){
      header("location: money.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <!-- <script src="scripts/jquery-1.9.1.min.js"></script>
  <script src="scripts/jquery.mobile-1.3.2.min.js"></script> -->
</head>

<body>
<div class="container"> 
<form method="POST">
  <div class="form-inline col-12" >
      <h2 class=col-10>提款記錄</h2>
  </div>
</form>
  <table class="table table-hover">
    <thead>

      <tr>
        <th></th>
        <th>帳號</th>
        <th>存款</th>
        <th>提款</th>
        <th>日期</th>
      </tr>
    </thead>
    <tbody>
    <?php while($row = mysqli_fetch_assoc($result)){?>
        <tr>
            <td><?php echo $row["num"] ?></td>
            <td><?php echo $row["account"] ?></td>
            <td><?php echo $row["dpmoney"] ?></td>
            <td><?php echo $row["wdmoney"] ?></td>
            <td><?php echo $row["Ddate"]  ?></td>
        <td>
            <span class="float-right">      
            </span>
        </td>
      </tr>
   <?php }?>   
    </tbody>
  </table>
  
</div>
<form method="POST" action="checkmymoney.php">
<div class="form-group col-12">

  <div class=text-center>
    <button name="btnback" type="submit" class="btn btn-primary">返回</button>
            
  </div>
</div>
</body>
</html>