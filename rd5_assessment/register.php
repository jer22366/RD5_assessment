<?php
    require_once ("config.php");
    $patternid="/[A-Z][12]\d{8}/";
    $checkid=$_POST["id"]; $Name=$_POST["name"]; $Account=$_POST["account"]; $Password=$_POST["password"];
    if(isset($_POST["submit"])){
        if(!empty($checkid) && !empty($Name) && !empty($Account) && !empty($Password)){
            if(preg_match($patternid, $checkid, $matches)){
                $cID=$checkid; 
            }
            $link=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname) or die(mysqli_connect_error());
            $result = mysqli_query ( $link, "set names utf8" );
            mysqli_select_db ( $link, $dbname );
            $commandText = <<<sqlcommand
                INSERT INTO `member`(`Mid`, `name`, `account`, `acpassword`) VALUES ("$cID","$Name","$Account","$Password");
            sqlcommand;
            $result = mysqli_query ( $link, $commandText );
            
        }
        
    }
    
?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<form id="form3" name="form3" method="post" action="register.php" >
  <div class="form-group row">
    <label for="id" class="col-1 col-form-label">身分證字號</label> 
    <div class="col-3">
      <div class="input-group">
        <div class="input-group-prepend">
          </div>
        </div> 
        <input id="id" name="id" type="text" class="form-control">
      </div>
    </div>
  </div>
  <div class="form-group row">
    <label for="name" class="col-1 col-form-label">姓名</label> 
    <div class="col-3">
      <input id="name" name="name" type="text" class="form-control">
    </div>
  </div>
  <div class="form-group row">
    <label for="account" class="col-1 col-form-label">帳號</label> 
    <div class="col-3">
      <input id="account" name="account" type="text" class="form-control">
    </div>
  </div>
  <div class="form-group row">
    <label for="password" class="col-1 col-form-label">密碼</label> 
    <div class="col-3">
      <input id="password" name="password" type="text" class="form-control">
    </div>
  </div> 
  <div class="form-group row">
    <div class="offset-1 col-8">
      <button name="submit" type="submit" class="btn btn-primary">註冊</button>
      <button name="btnreset" type="reset" class="btn btn-primary">重設</button>
    </div>
  </div>
</form>
