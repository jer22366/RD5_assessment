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
				<td colspan="2" align="center" bgcolor="#CCCCCC"><input
					type="submit" name="btnOK" id="btnOK" value="登入" /> <input
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
				alert("帳號或密碼不能為空");
			}else{
				$.ajax({
                	type:"POST",
                    url:"moneyfunction.php",
                    data:{
                        "Accvalue":acc,
						"Passvalue":pass
                        }
                    }).then(function(e){
                        alert(e)
						window.location.href="index.php"; 
                    })   
			}
		})     
		$('#btnHome').click(function(){    
			window.location.href="index.php"; 
		}) 
    })	

</script>
</html>
