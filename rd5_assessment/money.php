<?php
    session_start();
    if(isset($_POST["btnlogout"])){
        session_destroy();
        header("location: index.php");
    }
    require_once ("config.php");
    require_once ("Balance.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<title>Lag - Member Page</title>
</head>
    <body>
        <form id="form2" name="form2" method="POST">
            <table width="350" border="1" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">
            <tr>
                <td align="center" bgcolor="#CCCCCC"><font color="black">網銀系統 － 會員專用</font></td>
            </tr>
            <tr>
                <td align="center" valign="baseline">你的餘額:
                <?php 
                    if(isset($_POST["btnhide"])){
                        echo "******";  ?>
                        <input type="submit" name="btnshow" id="btndeposithide" value="開啟" /></td>
                    <?php }else{
                       echo $Balance;
                    ?>
                        <input type="submit" name="btnhide" id="btndepositshow" value="隱藏" /></td>
                    <?php }?> 
                
            </tr>
            <tr>
                <td colspan="2" align="center" bgcolor="#CCCCCC">
                    <button type="button" class="" data-toggle="modal" data-target="#exampleModal">存款</button>
                    <button type="button" class="" data-toggle="modal" data-target="#withdrawalmodal">提款</button>
                    <button type="button" name="btncheckmymoney" id="btncheckmymoney" >查詢明細</button>
                    <!-- <button type="submit" name="btncheckbalance" id="btncheckbalance"> 查詢餘額 </button> -->
                    <button type="submit" name="btnlogout" id="btnlogout"> 登出 </button>
                    
                    
                </td>
            </tr>
            </table>
        </form> 
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">存款</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    存入多少錢：<input type="text" name="欄位名稱" id="save">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">關閉</button>
                <button type="button" class="btn btn-primary" id="savemoney">確定</button>
            </div>
            </div>
        </div>
        </div>

        <div class="modal fade" id="withdrawalmodal" tabindex="-1" role="dialog" aria-labelledby="withdrawalmodalLabel" aria-hidden="true"  data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="withdrawalmodalLabel">提款</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form>
                    取出多少錢：<input type="text" name="欄位名稱" id="withdrawl">
                </form>
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
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">關閉</button>
                <button type="button" class="btn btn-primary" id="withdrawalmoney">確定</button>
            </div>
            </div>
        </div>
        </div>            
    </body>
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
    $(document).ready(function(){
		$('#savemoney').click(function(){
            let money=$("#save").val()
                if(money<1000){
                    alert("存款金額需超過1000元")
                }else if(money>30000){
                    alert("存款金額不能超過30000元")
                }else{
                    $.ajax({
                    type:"POST",
                    url:"moneyfunction.php",
                    data:{
                        "value":money
                        }
                    }).then(function(e){
                        alert(e)
                        window.location.reload(); 
                    })   
                }      
        })
        $('#withdrawalmoney').click(function(){
           let withdrawalmoney=$("#withdrawl").val()
               if(withdrawalmoney<1000){
                   alert("取出金額需超過1000元")
               }else if(withdrawalmoney>30000){
                   alert("取出金額不能超過30000元")
               }else{
                   $.ajax({
                   type:"POST",
                   url:"moneyfunction.php",
                   data:{
                       "withdrawalvalue":withdrawalmoney,
                       }
                   }).then(function(e){
                       alert(e)
                       window.location.reload(); 
                   })  
               }      
       })
       $('#btncheckmymoney').click(function(){
            window.location.href="checkmymoney.php"
       })
       $('#btndeposithide').click(function(){
            document.getElementById()
       })
	})
</script>
</html>