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
    if(isset($_POST["btncheckbalance"])){
        header("location: checkbalance.php");
    }
    require_once ("config.php");
    require_once ("Balance.php");


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Lag - Member Page</title>
</head>
    <body>
        <form id="form2" name="form2" method="post" action="money.php">
            <table width="350" border="1" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">
            <tr>
                <td align="center" bgcolor="#CCCCCC"><font color="black">網銀系統 － 會員專用</font></td>
            </tr>
            <tr>
                <td align="center" valign="baseline">你的餘額:
                <?php 
                    if(isset($_POST["btnhide"])){
                        echo "******";  ?>
                        <input type="submit" name="btnshow" id="btndeposit" value="開啟" /></td>
                    <?php }else{
                       echo $Balance;
                    ?>
                        <input type="submit" name="btnhide" id="btndeposit" value="隱藏" /></td>
                    <?php }?> 
                
            </tr>
            <tr>
                <td colspan="2" align="center" bgcolor="#CCCCCC">
                    <input type="submit" name="btndeposit" id="btndeposit" value="存款" /> 
                    <input type="submit" name="btnWithdrawal" id="btnWithdrawal" value="提款" /> 
                    <input type="submit" name="btncheckmymoney" id="btncheckmymoney" value="查詢明細" />
                    <input type="submit" name="btncheckbalance" id="btncheckmymoney" value="查詢餘額" />
                    <input type="submit" name="btnlogout" id="btnlogout" value="登出" />
                    
                </td>
            </tr>
            </table>
        </form>

    </body>
</html>