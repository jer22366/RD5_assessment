<?php
    require_once ("config.php");
    
    if(isset($_POST["btnlogin"])){
      header("location:login.php");
    }

    if(isset($_POST["btnback"])){
      header("location: index.php");
    }
?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
      <input id="password" name="password" type="password" class="form-control">
    </div>
  </div> 
  <div class="form-group row">
    <div class="offset-1 col-8">
      <button name="btnlogin" type="submit" class="btn btn-primary" >登入</button>
      <button name="button" type="submit" class="btn btn-primary" id="btnok">註冊</button>
      <button name="btnreset" type="reset" class="btn btn-primary">重設</button>
      <button name="btnback" type="submit" class="btn btn-primary">返回</button>
    </div>
  </div>
</form>
<script>
	$(document).ready(function(){
		$('#btnok').click(function(){
        let id=$("#id").val()
        let name=$("#name").val()
        let acc=$("#account").val()
        let pass=$("#password").val()
        if(!id || !name || !acc || !pass){
            alert("你有沒輸入的東西喔!!")
        }else{
            $.ajax({
              type:"POST",
              url:"moneyfunction.php",
              data:{
                "idvalue":id,
                "namevalue":name,
                "RAccvalue":acc,
                "RPassvalue":pass
              } 
            }).then(function(e){
              alert(e)
              window.location.href="index.php"; 
            })   
        }
		})     
  })	
</script>