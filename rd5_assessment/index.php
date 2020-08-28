<?php
    session_start();
    $user=$_SESSION["user"];
    if(empty($user)){
        $user="guest";
    }
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Lab - index</title>
</head>
<body>

<table width="300" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">
  <tr>
    <td align="center" bgcolor="#CCCCCC"><font color="#FFFFFF">網銀系統 - 首頁</font></td>
  </tr>
  <tr>
  <?php if($user=="guest"){?>
    <td align="center" valign="baseline"><a href="login.php">登入 </a>
    ｜<a href="register.php">註冊 </a>
  <?php }else {?>
    <td align="center" valign="baseline"><a href="login.php?login=1">登出 </a>| <a href="money.php">會員資訊</a></td>
  <?php }?> 
    
  </tr>
  <tr>
    <td align="center" bgcolor="#CCCCCC">welcome <?= $user;?></td>
  </tr>
</table>


</body>
</html>