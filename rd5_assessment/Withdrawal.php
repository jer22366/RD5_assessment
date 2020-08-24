 <?php
    require_once ("config.php");
    session_start();
    $idcnum=$_SESSION["idcnum"];
    $name=$_SESSION["user"];

    if(isset($_POST["btnback"])){
        header("location: money.php");

    }
    if(isset($_POST["btnwithdrawal"])){
        $withdrawal=$_POST["withdrawal"];

        if(is_numeric($withdrawal)){

            $link=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname) or die(mysqli_connect_error());
            $result = mysqli_query ( $link, "set names utf8" );
            mysqli_select_db ( $link, $dbname );
            $wddate=date("Y-m-d");
            $commandText = <<<sqlcommand
            INSERT INTO `withdrawal`(`idCnum`, `name`, `wdmoney`,`wddate`) VALUES ("$idcnum","$name",$withdrawal,"$wddate");
            sqlcommand;
            $result = mysqli_query ( $link, $commandText );
            header("location: money.php");
        
        }
    } 
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<form id="form3" name="form3" method="post" action="Withdrawal.php">
<div class="form-group row">
    <label for="text" class="col-1 col-form-label">取出金額</label> 
    <div class="col-4">
    <div class="input-group">
        <div class="input-group-prepend">
        
        </div>
        </div> 
        <input id="text" name="withdrawal" type="text" class="form-control">
    </div>
    </div>
</div> 
<div class="form-group row">
    <div class="offset-1 col-8">
    <button name="btnwithdrawal" type="submit" class="btn btn-primary">取出</button>
    <button name="btnreset" type="reset" class="btn btn-primary">重設</button>
    <button name="btnback" type="submit" class="btn btn-primary">返回</button>
    </div>
</div>




