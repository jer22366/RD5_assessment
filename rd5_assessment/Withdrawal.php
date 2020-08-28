 <?php
    require_once ("config.php");
    require_once ("checkBalance.php");
    session_start();
    $name=$_SESSION["user"];

    if(isset($_POST["btnback"])){
        header("location: money.php");

    }
    if(isset($_POST["btnwithdrawal"])){
        $withdrawal=$_POST["withdrawal"];
        
        if(is_numeric($withdrawal)){
            if($withdrawal<=30000 && $withdrawal>=1000){
                if($Balance>$withdrawal){
                    $getdate = <<<sqlcommand
                        select now() as date;
                    sqlcommand;
                    $result = mysqli_query ( $link, $getdate );
                    $gdate= mysqli_fetch_assoc($result);
                  
                    $commandText = <<<sqlcommand
                        INSERT INTO `money`(`account`, `wdmoney`,`Ddate`,`balance`) VALUES ("$name",$withdrawal,"$gdate[date]",($Balance-$withdrawal));
                    sqlcommand;
                    $result = mysqli_query ( $link, $commandText );
                    header("location: money.php");
                }else{?>
                    <script language="javascript">
                        alert("親 你沒有那麼多存款喔!!");
                    </script>
                <?php }   
            }else if($withdrawal>30000){?>
                <script language="javascript">
                    alert("輸入的金額不可大於30000");
                </script>
            <?php }
              else if($withdrawal<1000){?>
                <script language="javascript">
                    alert("輸入的金額不可小於1000");
                </script>
            <?php }
            
        } 
    }
        
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<form id="form3" name="form3" method="post" action="Withdrawal.php">
<div class="form-group d-flex flex-row justify-content-center align-items-center col-12" style="height: 100px;">
    <label for="text" class="col-1 col-form-label col-2">取出金額</label> 
    <div class="col-5">
        <input id="text" name="withdrawal" type="text" class="form-control">
    </div>
</div>
</div> 
<div class="form-group d-flex flex-row justify-content-center align-items-center" style="height: 100px;">
    <div class="offset-1 col-5">
    <button name="btnwithdrawal" type="submit" class="btn btn-primary">取出</button>
    <button name="btnreset" type="reset" class="btn btn-primary">重設</button>
    <button name="btnback" type="submit" class="btn btn-primary">返回</button>
    </div>
</div>




