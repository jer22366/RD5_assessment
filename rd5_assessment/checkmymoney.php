<?php
    require_once ("config.php");
    session_start();
    $idcnum=$_SESSION["idcnum"];
    $name=$_SESSION["user"];

    $dpdate=date("Y-m-d");
    
    $commandText = <<<sqlcommand
      select account, wdmoney,dpmoney,type,tranmoney,Ddate from money  where account="$name"  order by Ddate desc limit 15
    sqlcommand;
    $result = mysqli_query ( $link, $commandText );
    if(isset($_POST["btnback"])){
      header("location: money.php");
    }
    if(isset($_POST["halfmon"])){
      header("location: checkhalf.php");
    }
    if(isset($_POST["onemon"])){
      header("location: checkmon.php");
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
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
  <style>
body {
  background-color: lightblue;
}
</style>
</head>

<body>
<div class="container"> 
<form method="POST">
  <div class="form-inline col-12" >
      <h2 class=col-9>帳戶記錄</h2>
      <button name="halfmon" type="submit" class="btn btn-primary  btn-warning col-1.5">半個月紀錄</button>
      <button name="onemon" type="submit" class="btn btn-primary  btn-warning col-1.5">1個月紀錄</button>
      
  </div>
</form>
  <table class="table table-hover">
    <thead>

      <tr>
        
        <th>帳號</th>
        <th>存款</th>
        <th>提款</th>
        <th>轉帳</th>
        <th>轉帳金額</th>
        <th>日期</th>
      </tr>
    </thead>
    <tbody>
    <?php while($row = mysqli_fetch_assoc($result)){?>
        <tr>
            
            <td><?php echo $row["account"] ?></td>
            <td><?php echo $row["dpmoney"] ?></td>
            <td><?php echo $row["wdmoney"] ?></td>
            <td><?php echo $row["type"]?></td>
            <td><?php echo $row["tranmoney"]?></td>
            <td><?php echo $row["Ddate"]  ?></td>
        
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