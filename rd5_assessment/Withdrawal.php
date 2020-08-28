 <?php
    require_once ("config.php");
    require_once ("Balance.php");
    session_start();
    $name=$_SESSION["user"];

    if(isset($_POST["btnback"])){
        header("location: money.php");

    }
    
    if(isset($_POST["btnwithdrawal"])){
        if($_POST["radio"] && $_POST["radio"]==1000 && empty($_POST["withdrawal"])){
            $withdrawal=$_POST["radio"];
        }else if($_POST["radio"] && $_POST["radio"]==2000 && empty($_POST["withdrawal"])){
            $withdrawal=$_POST["radio"];
        }else if($_POST["radio"] && $_POST["radio"]==5000 && empty($_POST["withdrawal"])){
            $withdrawal=$_POST["radio"];
        }else{
            $withdrawal=$_POST["withdrawal"];
        }  
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
<script>
    $(function(){
	    $('input[type="radio"]').on('mousedown',function(evt){
		    evt.preventDefault();
		    this.checked=!this.checked;
	    }).on('mouseup',function(evt){
		    evt.preventDefault();
	    }).on('click',function(evt){
		    evt.preventDefault();
	});
});


</script>
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
<div class=" d-flex flex-row justify-content-center align-items-center col-12">
      <div class="custom-control custom-radio custom-control-inline col-2">
        <input name="radio" id="radio_0" type="radio" class="custom-control-input" value="1000"> 
        <label for="radio_0" class="custom-control-label">1000元</label>
      </div>
      <div class="custom-control custom-radio custom-control-inline col-2">
        <input name="radio" id="radio_1" type="radio" class="custom-control-input" value="2000"> 
        <label for="radio_1" class="custom-control-label">2000元</label>
      </div>
      <div class="custom-control custom-radio custom-control-inline col-2">
        <input name="radio" id="radio_2" type="radio" class="custom-control-input" value="5000"> 
        <label for="radio_2" class="custom-control-label">5000元</label>
      </div>
    </div> 
<div class="form-group d-flex flex-row justify-content-center align-items-center" style="height: 100px;">
    <div class="offset-1 col-5">
    <button name="btnwithdrawal" type="submit" class="btn btn-primary">取出</button>
    <button name="btnreset" type="reset" class="btn btn-primary">重設</button>
    <button name="btnback" type="submit" class="btn btn-primary">返回</button>
    </div>
</div>




