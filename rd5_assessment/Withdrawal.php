 <?php
    if(isset($_POST["submit"])){
        $withdrawal=$_POST["withdrawal"];
        if(is_numeric($withdrawal)){
         echo "ok" ;
        }
    } 
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<form id="form3" name="form3" method="post" action="depoist.php">
<div class="form-group row">
    <label for="text" class="col-1 col-form-label">取出金額</label> 
    <div class="col-4">
    <div class="input-group">
        <div class="input-group-prepend">
        <div class="input-group-text">
            <i class="fa fa-address-card"></i>
        </div>
        </div> 
        <input id="text" name="withdrawal" type="text" class="form-control">
    </div>
    </div>
</div> 
<div class="form-group row">
    <div class="offset-1 col-8">
    <button name="btnwithdrawal" type="submit" class="btn btn-primary">取出</button>
    <button name="btnreset" type="reset" class="btn btn-primary">重設</button>
    </div>
</div>




