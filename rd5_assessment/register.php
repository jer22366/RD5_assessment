<?php
    
    if(isset($_POST["btnlogin"])){
      header("location:login.php");
    }

    if(isset($_POST["btnback"])){
      header("location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <title>Document</title>
<style>
  body {
  background-color: lightblue;
}
form{
  position: relative;
  top: 20px;
  right: -450px;
}
</style>
</head>
<body>
<form id="form3" name="form3" method="post">
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
      <button name="button" type="button" class="btn btn-primary" id="btnok">註冊</button>
      <button name="btnreset" type="reset" class="btn btn-primary">重設</button>
      <button name="btnback" type="submit" class="btn btn-primary">返回</button>
      <div id='registertext'></div>
    </div>
  </div>
</form>
</body>
</html>
<script>
	$(document).ready(function(){
		$('#btnok').click(function(){
        let id=$("#id").val()
        let name=$("#name").val()
        let acc=$("#account").val()
        let pass=$("#password").val()
        if(!id || !name || !acc || !pass){
            $("#registertext").css("color","red")
            $("#registertext").html("你有沒輸入的東西喔!!")
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
            }).then(function(register){
              if(register==0){
                  $("#registertext").css("color","red")
                  $("#registertext").html("帳號相同")
              }else if(register==1){
                  $("#registertext").css("color","red")
                  $("#registertext").html("密碼相同")
              }
              else if(register==2){
                  $("#registertext").css("color","red")
                  $("#registertext").html("註冊成功")
                  setTimeout(function(){ window.location.href="index.php";  }, 1000);
              }else{
                  $("#registertext").css("color","red")
                  $("#registertext").html("身分證字號有錯")
              }
              
            })   
        }
		})     
  })	
</script>