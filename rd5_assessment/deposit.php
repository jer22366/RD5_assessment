<?php
    require_once ("config.php");
    session_start();
    
    $name=$_SESSION["user"];
    
    if(isset($_POST["btnback"])){
      header("location: money.php");
    }
    if(isset($_POST["submit"])){
       $deposit=$_POST["deposittext"];
       if(is_numeric($deposit)){
        if($deposit<=30000 && $deposit>=1000){
          $getdate = <<<sqlcommand
          select now() as date;
          sqlcommand;
          $result = mysqli_query ( $link, $getdate );
          $gdate= mysqli_fetch_assoc($result);
          
          $commandText = <<<sqlcommand
            INSERT INTO `money`(`account`, `dpmoney`,`Ddate`) VALUES ("$name",$deposit,"$gdate[date]");
          sqlcommand;
          $result = mysqli_query ( $link, $commandText );
          header("location: money.php");
        }else if($deposit>30000){?>
          <script language="javascript">
              alert("輸入的金額不可大於30000");
          </script>
        <?php }
          else if($deposit<1000){?>
          <script language="javascript">
              alert("輸入的金額不可小於1000");
          </script>
        <?php }
      }
    }

?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<form id="form3" name="form3" method="post" action="deposit.php">
  <div class="form-group row">
    <label for="text" class="col-1 col-form-label">存入金額</label> 
    <div class="col-3">
      <div class="input-group">
        <div class="input-group-prepend">
          </div>
        </div> 
        <input id="text" name="deposittext" type="text" class="form-control">
      </div>
    </div>
  </div> 
  
  <div class="form-group row">
    <div class="offset-1 col-8">
      <button name="submit" type="submit" class="btn btn-primary">存入</button>
      <button name="btnreset" type="reset" class="btn btn-primary">重設</button>
      <button name="btnback" type="submit" class="btn btn-primary">返回</button>
    </div>
  </div>
</form>