<?php
    require_once ("config.php");
    session_start();
    $idcnum=$_SESSION["idcnum"];
    $name=$_SESSION["user"];

    $dpdate=date("Y-m-d");
    
    $commandText = <<<sqlcommand
        SELECT * from money where date(Ddate) BETWEEN DATE_SUB(curdate(), INTERVAL 15 DAY) and DATE_SUB(curdate(), INTERVAL 0 DAY) order by Ddate desc
    sqlcommand;
    $result = mysqli_query ( $link, $commandText );
    if(isset($_POST["btnbackcheck"])){
      header("location: checkmymoney.php");
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
            <td></td>
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
<form method="POST" >
<div class="form-group col-12">

  <div class=text-center>
    <button name="btnbackcheck" type="submit" class="btn btn-primary">返回</button>
            
  </div>
</div>
</body>

</html>