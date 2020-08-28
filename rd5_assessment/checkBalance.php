<?php
    require_once("Balance.php");
    if(isset($_POST["btnback"])){
        header("location: money.php");
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Lag - Member Page</title>
</head>
    <body>
        <form id="form2" name="form2" method="post" action="checkbalance.php">
            <table width="300" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">
            <tr>
                <td align="center" bgcolor="#CCCCCC"><font color="black">網銀系統 － 會員專用</font></td>
            </tr>
            <tr>
                <td align="center" valign="baseline">你的餘額:<?= $Balance;?>
            </tr>
            <tr>
                <td colspan="2" align="center" bgcolor="#CCCCCC">
                    <input type="submit" name="btnback" id="btnlogout" value="返回" />
                    
                </td>
            </tr>
            </table>
        </form>

    </body>
</html>