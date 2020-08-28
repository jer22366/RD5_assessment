<?php
    session_start();
    if(isset($_POST["btnlogout"])){
        session_destroy();
        header("location: index.php");
    }
    if(isset($_POST["btndeposit"])){
        header("location: deposit.php");
    }
    if(isset($_POST["btnWithdrawal"])){
        header("location: Withdrawal.php");
    }
    if(isset($_POST["btncheckmymoney"])){
        header("location: checkmymoney.php");
    }
    if(isset($_POST["btnbalance"])){
        header("location: checkBalance.php");
    }
    require_once ("config.php");
    require_once ("checkBalance.php");


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Lag - Member Page</title>
</head>
    <body>
        <form id="form2" name="form2" method="post" action="money.php">
            <table width="300" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">
            <tr>
                <td align="center" bgcolor="#CCCCCC"><font color="#FFFFFF">會員系統 － 會員專用</font></td>
            </tr>
            <tr>
                <td align="center" valign="baseline">餘額:<?= $Balance ?></td>
            </tr>
            <tr>
                <td colspan="2" align="center" bgcolor="#CCCCCC">
                    <input type="submit" name="btndeposit" id="btndeposit" value="存款" /> 
                    <input type="submit" name="btnWithdrawal" id="btnWithdrawal" value="提款" /> 
                    <input type="submit" name="btncheckmymoney" id="btncheckmymoney" value="查詢明細" />
                    <input type="submit" name="btnlogout" id="btnlogout" value="登出" />
                    
                </td>
            </tr>
            </table>
        </form>

    </body>
</html>