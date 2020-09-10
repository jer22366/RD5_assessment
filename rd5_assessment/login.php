<?php 
	session_start();
	if(isset($_GET["login"])){
		session_destroy();	
		header("location: index.php");
	}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<title>登入</title>
<style>
body {
  background-color: lightblue;
}
form{
  position: relative;
  top: 180px;
  right: 0px;
  
}
</style>
</head>
<body>
	<form id="form1" name="form1" method="post">
		<table width="300" border="1" align="center" cellpadding="5"
			cellspacing="0" bgcolor="#F2F2F2">
			<tr>
				<td colspan="2" align="center" bgcolor="#CCCCCC"><font
					color="black">網銀銀行 - 登入</font></td>
			</tr>
			<tr>
				<td width="80" align="center" valign="baseline">帳號</td>
				<td valign="baseline"><input type="text" name="txtUserName"
					id="txtUserName" /></td>
			</tr>
			<tr>
				<td width="80" align="center" valign="baseline">密碼</td>
				<td valign="baseline"><input type="password" name="txtPassword"
					id="txtPassword" /></td>
			</tr>
			<tr>
				
				<td colspan="2" align="center" bgcolor="#CCCCCC">
					<div id='text' class="message"></div>	<input
					type="button" name="btnOK" id="btnOK" value="登入" /> <input
					type="reset" name="btnReset" id="btnReset" value="重設" /> <input
					type="button" name="btnHome" id="btnHome" value="回首頁" />
				</td>
			</tr>
		</table>
		
	</form>
</body>
<script>
	$(document).ready(function(){
		$('#btnOK').click(function(){
            let acc=$("#txtUserName").val()
			let pass=$("#txtPassword").val()
			if(!acc || !pass){
				$("#text").css("color","red")
				$("#text").html("帳號或密碼不能為空");
			}else{
				$.ajax({
                	type:"POST",
                    url:"moneyfunction.php",
                    data:{
                        "Accvalue":acc,
						"Passvalue":pass
                        }
                    }).then(function(login){
						if(login==0){
							$("#text").css("color","red")
							$("#text").html("帳號或密碼錯誤");
						}else if(login==1){
							$("#text").css("color","red")
							$("#text").html("登入成功即將跳轉頁面");
							setTimeout(function(){ window.location.href="index.php";  }, 1000);
						}else{
							$("#text").css("color","red")
							$("#text").html("帳號或密碼錯誤");
							
						}
                    })   
			}
		})     
		$('#btnHome').click(function(){    
			window.location.href="index.php"; 
		}) 
    })	

</script>
</html>
