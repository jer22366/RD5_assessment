<?php
    require_once ("config.php");
    session_start();
    $idcnum=$_SESSION["idcnum"];
    $name=$_SESSION["user"];
    
    if(isset($_POST["btnback"])){
      header("location: money.php");
    }
    if(isset($_POST["submit"])){
       $deposit=$_POST["deposittext"];
       if(is_numeric($deposit)){

        $link=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname) or die(mysqli_connect_error());
        $result = mysqli_query ( $link, "set names utf8" );
        mysqli_select_db ( $link, $dbname );
        $dpdate=date("Y-m-d");
        
        $commandText = <<<sqlcommand
        INSERT INTO `deposit`(`idCnum`, `name`, `dpmoney`,`dpdate`) VALUES ("$idcnum","$name",$deposit,"$dpdate");
        sqlcommand;
        $result = mysqli_query ( $link, $commandText );
        header("location: money.php");

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