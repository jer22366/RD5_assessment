<?php
    require_once ("config.php");
    require_once ("Balance.php");

    session_start();
    $name=$_SESSION["user"];
    if(isset($_POST["value"])){
       $deposit=$_POST["value"];
       if(is_numeric($deposit)){
        if($deposit<=30000 && $deposit>=1000){
          $getdate = <<<sqlcommand
            select now() as date;
          sqlcommand;
          $result = mysqli_query ( $link, $getdate );
          $gdate= mysqli_fetch_assoc($result);
          
          $commandText = <<<sqlcommand
            INSERT INTO `money`(`account`, `dpmoney`,`Ddate`,balance) VALUES ("$name",$deposit,"$gdate[date]",($Balance+$deposit));
          sqlcommand;
          $result = mysqli_query ( $link, $commandText );
        }
      }
      echo "存款成功";
    }
    if(isset($_POST["withdrawalvalue"])){
      if($_POST["radio0"] && $_POST["radio0"]==1000 && empty($_POST["withdrawalvalue"])){
          $withdrawal=$_POST["radio0"];
      }else if($_POST["radio1"] && $_POST["radio1"]==2000 && empty($_POST["withdrawalvalue"])){
          $withdrawal=$_POST["radio1"];
      }else if($_POST["radio2"] && $_POST["radio2"]==5000 && empty($_POST["withdrawalvalue"])){
          $withdrawal=$_POST["radio2"];
      }else{
          $withdrawal=$_POST["withdrawalvalue"];
      }  
      if(is_numeric($withdrawal)){
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
              }else{
                  echo "存款不足";
              }
      } 
      echo "取款成功";
  }
  if(isset($_POST["Accvalue"]) && isset($_POST["Passvalue"])){
        session_start();
        $username=$_POST["Accvalue"];
        $userpass=$_POST["Passvalue"];
        $commandText = <<<sqlcommand
          select * from member where account="$username";
        sqlcommand;
        
        $result = mysqli_query ( $link, $commandText );
        $row = mysqli_fetch_assoc ( $result );
        if($row["account"]!=$username){
          echo "帳號錯誤";
        }else{
            if($row["account"]!="" && $row["acpassword"]==$userpass){
              $_SESSION["user"]=$username;
              $_SESSION["pass"]=$userpass;
              $_SESSION["idcnum"]=$row["idCnum"];
              echo "登入成功";
            }
            else{
              echo "密碼錯誤";    
          }
        }
        
  }
?>


